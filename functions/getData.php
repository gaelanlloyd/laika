<?php

function getData($reportItem, $site = NULL, $sitesAsSeries = NULL, $useAlternateSiteNames = NULL) {

	global $DATABASE;
	global $NUM_MONTHS;
	global $TBL_DATA;
	global $TBL_SITES;
	global $TBL_METRICS;
	global $TBL_GOALS;

	// $reportItem could be:
	// - a single integer (report on one measurement)
	// - a comma-separated list of integers (report on several measurements)

	// $site is an optional array
	// - omit it and data for all non-ignored sites will be returned
	// - specify it as a comma-separated list of sites

	// $sitesAsSeries is optional
	// - transposes $reportItem for $site (like in the uptime report)

	// $useAlternateSiteNames is optional
	// - if specified, the altnames field is used for site titles
	// - useful in the uptime report when "EN" sitename doesn't make sense

    // -------------------------------------------------------------------------
    // CHECK FOR ERRORS

    $error = FALSE;
    $errorList = array();

    /*
    if ( !is_null( $site ) && !is_numeric( $site ) ) {
    	$error = TRUE;
    	$errorList[] = __t( 'InvalidSiteParameter' );
    }
    */

    // -------------------------------------------------------------------------

    if ($error) {
		ob_start();
        echo writeError( __FUNCTION__ , $errorList );
        $out = ob_get_clean();
        return $out;
    }

    // -------------------------------------------------------------------------

	$reportItems = explode(",", $reportItem);

	if (count($reportItems) == 1) {
		$isSingleReport = TRUE;
	} else {
		$isSingleReport = FALSE;
	}

	// -------------------------------------------------------------------------

	// Determine the latest month of data from the database
	// - Don't show any figures past this date, otherwise the charts will proceed off to zero
	// - Once the latest data is fetched and added, it will be shown on the chart
	// - Useful for the demo site, where the dummy data is limited to a fixed set from the past

	$maxDate = $DATABASE->max($TBL_DATA, "date");

	// DEBUG
	// echo "<pre>maxDate = " . $maxDate . "</pre>";

	$currentDate = strtotime($maxDate . ' 01:00:00');

	// Get the current month number
	$thisMonth = date("m", $currentDate);

	// Get the current year
	$thisYear = date("Y", $currentDate);

	// Create a string to represent the current YYYY-MM-01 notation
	// used to calculate the past months that need to be retreived
	$strStartTime = $thisYear . "-" . $thisMonth . "-01";


	// The report's end date (based on max TBL_DATA date)
	$dateToday = date("Y-m-d", $currentDate);

	// The report's starting date
	// - Subtract NUM_MONTHS from the first day of the current month
	// $dateStart = date("Y-m-d",strtotime("$thisMonth/1 -$NUM_MONTHS months"));

	$dateStart = date("Y-m-d",strtotime("$strStartTime -$NUM_MONTHS months"));

	// Get the list of months the data should be pulled for
	$theseMonths = array();

	for ( $i = $NUM_MONTHS - 1; $i >= 0; $i-- ) {
		$theseMonths[] = date("Y-m-d",strtotime("$strStartTime -$i months"));
	}

	// DEBUG
	/*
	echo "<pre>";
	echo "maxDate      = " . $maxDate . "\n";
	echo "NUM_MONTHS   = " . $NUM_MONTHS . "\n";
	echo "currentDate  = " . $currentDate . "\n";
	echo "strStartTime = " . $strStartTime . "\n";
	echo "thisMonth    = " . $thisMonth . "\n";
	echo "thisYear     = " . $thisYear . "\n";
	echo "dateToday    = " . $dateToday . "\n";
	echo "dateStart    = " . $dateStart . "\n";
	echo "dateEnd      = " . $dateToday;
	echo "</pre>";

	echo "<pre>theseMonths = \n";
	echo print_r( $theseMonths );
	echo "</pre>";
	*/

	// Prepare holder array
	$values = array();
	// $axisLabels = array();

	// get data from specified sites
	if ($site == NULL) {

		// get data for all sites except those with showData = FALSE
		$sites = $DATABASE->select($TBL_SITES, "*",
			array( "showData" => 1 )
		);

	} else {

		$siteItems = explode(",", $site);

		// get data for the specific sites passed
		$sites = $DATABASE->select($TBL_SITES, "*",
			array( "id" => $siteItems )
		);

	}

	// DEBUG
	/*
	echo "<pre>sites = \n";
	echo print_r( $sites );
	echo "</pre>";
	*/

	// - For each site returned
	foreach ($sites as $site) {

		// DEBUG
		/*
		echo "<pre>site[] = \n";
		echo print_r( $site, TRUE );
		echo "</pre>";
		*/

		// - For each item in the report
		foreach ($reportItems as $item) {

			/*
			// - Get the data for that item
			$siteData = $DATABASE->select($TBL_DATA, "*", [
				"AND" => [
					"data_id" => $item,
					"site" => $site["id"],
					"date[<>]" => [$dateStart,$dateToday]
				],
				"ORDER" => "date"
			]);
			*/

			// - For each month in the list of months to get data for

			// Loop through the requested months, not the available data, otherwise you'll
			// put data in places where it doesn't exist in the DB.  Put zeroes instead.

			foreach ($theseMonths as $theseMonthsItem) {

				$lastYear = date('Y-m-d', strtotime('-1 years', strtotime($theseMonthsItem) ) );

				// - Get the data for that item for that given month
				$siteData = $DATABASE->select($TBL_DATA, "*", [
					"AND" => [
						"data_id" => $item,
						"site" => $site["id"],
						"date" => $theseMonthsItem
					]
				]);

				// - Get the data for that item for that given month last year, for YoY calcs
				$siteDataLastYear = $DATABASE->select($TBL_DATA, "*", [
					"AND" => [
						"data_id" => $item,
						"site" => $site["id"],
						"date" => $lastYear
					]
				]);

				/*
				// DEBUG
				echo "<pre>siteData[] = \n";
				echo print_r( $siteData, TRUE );
				echo print_r( $siteDataLastYear, TRUE );
				echo "</pre>";
				*/

				// If there isn't any data for that given month, store a zero

				if (empty($siteData)) {
					$thisValue = 0;
				} else {
					$thisValue = $siteData[0]["value"];
				}

				if (empty($siteDataLastYear)) {
					$thisValueLastYear = 0;
				} else {
					$thisValueLastYear = $siteDataLastYear[0]["value"];
				}

				// Store each value

				if ($useAlternateSiteNames) {

					// Is an alternate site name provided?

					if (strlen($site["alt_name"]) > 0) {
						$thisSiteName = $site["alt_name"];
					} else {
						$thisSiteName = $site["name"];
					}

				} else {

					$thisSiteName = $site["name"];

				}

				// Do we need to flip sites as the series?

				if ($sitesAsSeries) {

					$values[$item][$thisSiteName][$theseMonthsItem]['actual'] = $thisValue;
					$values[$item][$thisSiteName][$theseMonthsItem]['yoychg'] = calculateChange( $thisValueLastYear, $thisValue );

				} else {

					$values[$thisSiteName][$item][$theseMonthsItem]['actual'] = $thisValue;
					$values[$thisSiteName][$item][$theseMonthsItem]['yoychg'] = calculateChange( $thisValueLastYear, $thisValue );

				}

			}  // end foreach theseMonthsItem
		}  // end foreach reportItem
	} // end foreach site

	// DEBUG
	/*
	echo "<pre>getData( \$values ) = \n";
	echo print_r( $values, TRUE );
	echo "</pre>";
	*/

	// echo "<pre>getData( \$axisLabels ) = \n";
	// echo print_r( $axisLabels, TRUE );
	// echo "</pre>";

	return $values;

}