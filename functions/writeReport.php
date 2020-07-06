<?php
/**
 * Writes report output to the page.
 *
 * @param array  $reportData    The actual data you're charting.
 * @param string $chartTitle    (optional), otherwise title = site's name.
 * @param string $chartCaption  (optional), appears under the chart title.
 * @param string $sitesAsSeries (optional), transposes data.
 * @param string $chartType     (optional), line, bar, pie, doughnut, scatter.
 *
 */

function writeReport( $atts ) {

    $defaults = array(
        "reportData" => NULL,
        "chartTitle" => NULL,
        "chartCaption" => NULL,
        "sitesAsSeries" => NULL,
        "chartType" => "line",
        "axisYMaxValue" => NULL,
        "backgroundColor" => NULL,
    );

    extract( array_merge( $defaults, $atts ) );

    $chartTitleOrig = $chartTitle;

    global $DATABASE;
    global $TBL_METRICS;

	// for each site's data returned
	foreach ($reportData as $siteName => $reportItem) {

        // initialize variables
        $chartAxisLabels = array();
        $chartData = array();
        $chartSeriesLabels = array();

        // DEBUG
        /*
        echo "<pre>ReportItem = \n";
        echo print_r( $reportItem );
        echo "</pre>";
        */

        $keepWritingAxisLabels = TRUE;

        // For each site's data
        foreach ($reportItem as $key => $item) {

            if ($sitesAsSeries) {

                $chartSeriesLabels[] = $key;

            } else {

                // Look up and store the name of the measurement
                $measurementName = $DATABASE->select($TBL_METRICS, "*", ["id" => $key]);
                $chartSeriesLabels[] = $measurementName[0]['name'];

                // DEBUG
                /*
                echo "<pre>measurementName[] = \n";
                echo print_r( $measurementName );
                echo "</pre>";
                */

            }


            // For each measurement we have data for
            foreach ($item as $k => $i) {

                // Store that data in the chartData array
                $chartData[$key][$k] = $i['actual'];
                $dataYOY[$key][$k] = $i['yoychg'];

                // These only need to be written once, not for every series
                if ($keepWritingAxisLabels) {
                    $chartAxisLabels[] = $k;
                }

            }

            $keepWritingAxisLabels = FALSE;

        }

        // DEBUG
        /*
        echo "<pre>chartSeriesLabels[] = \n";
        echo print_r( $chartSeriesLabels );
        echo "</pre>";

        echo "<pre>writeReport/\$chartData\n";
        echo print_r( $chartData );
        echo "</pre>";

        echo "<pre>writeReport/\$dataYOY\n";
        echo print_r( $dataYOY );
        echo "</pre>";
        */

        // if a custom chart title is not specified, use the site's name
        if ( empty($chartTitleOrig) ) {
            $chartTitle = $siteName;
        }

        $args = array(
            'title' => $chartTitle,
            'caption' => $chartCaption,
            'type' => $chartType,
            'data' => $chartData,
            'dataYOY' => $dataYOY,
            'chartSeriesLabels' => $chartSeriesLabels,
            'chartAxisLabels' => $chartAxisLabels,
            'axisYMaxValue' => $axisYMaxValue,
            'backgroundColor' => $backgroundColor,
        );

        // write the chart data
        echo writeReportItem( $args );

    }

}