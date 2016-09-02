<?php

function writeTable($chartData, $chartSeriesLabels, $chartAxisLabels) {

    // EXPECTS DATA IN THIS FORMAT

    // $chartData = array(
    //     array(65,59,80,81,56,55,40),
    //     array(28,48,40,19,86,27,90)
    // );

    // $chartSeriesLabels = array( "Series 1", "Series 2");

    // $chartAxisLabels = array( "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" );

    // -------------------------------------------------------------------------
    // CHECK FOR ERRORS

    $error = FALSE;
    $errorList = array();

    if ( count($chartSeriesLabels) > $GLOBALS['MAX_SERIES'] ) {
        $error = TRUE;
        $errorList[] = $GLOBALS['txtErrorTooMuchData'];
    }

    // -------------------------------------------------------------------------

    if ( $error ) {
        $out .= writeError( __FUNCTION__ , $errorList );
        return $out;
    }

    // -------------------------------------------------------------------------

    // WRITE THE DATA TABLE

    $out = "";

    if ( empty($chartData) ) {

    	$out .= "<p>" . $GLOBALS['txtNoDataWasProvided'] . "</p>";

    } else {

        // --- Write legend ----------------------------------------------------

        $out .= "<div class=\"legend clearfix\">";
        $out .= "<table><tbody><tr>";

        foreach ($chartSeriesLabels as $key => $dataLabelItem) {
            $out .= "<td class=\"series\">";
            $out .= "<div class=\"indicator\" style=\"background-color: " . getColor("strokeColor", $key) . ";\"></div>";
            $out .= $dataLabelItem;
            $out .= "</td>";
        }

        $out .= "</tr></tbody></table>";
        $out .= "</div>";

        // --- Write table toggler button --------------------------------------

        $out .= "<p class=\"text-center\">";
        $out .= "<a href=\"javascript:void(0)\" class=\"toggler btn btn-default\">";
        $out .= $GLOBALS['txtViewDataTable'];
        $out .= "</a>";
        $out .= "</p>";

        // --- Write table -----------------------------------------------------

        // DEBUG
        /*
        echo "<pre>\$chartData = \n";
        echo print_r( $chartData );
        echo "</pre>";
        */

        $out .= "<div class=\"dataTable\" style=\"display: none;\">";

        $out .= "<div class=\"table-responsive addMarginBottom\">";
        $out .= "<table class=\"table table-striped\">";
        $out .= "<thead>";
        $out .= "<tr>";
        $out .= "<th></th>";

        foreach ($chartSeriesLabels as $key => $dataLabelItem) {
            $out .= "<th>";
            $out .= "<div class=\"indicator\" style=\"background-color: " . getColor("strokeColor", $key) . ";\"></div>";
            $out .= $dataLabelItem;
            $out .= "</th>";
        }

        $out .= "</tr>";
        $out .= "</thead>";
	    $out .= "<tbody>";

        foreach ($chartAxisLabels as $keyAxisLabel => $itemAxisLabel) {

            $out .= "<tr>";
            $out .= "<th>" . $itemAxisLabel . "</th>";

            // For each chartData item, which are measurements
            foreach ($chartData as $keyChartData => $chartDataItem) {
                $out .= "<td>" . $chartData[$keyChartData][$itemAxisLabel] . "</td>";
            }

            $out .= "</tr>";
        }

        $out .= "</tbody>";
        $out .= "</table>";
        $out .= "</div>";

        $out .= "<h3>" . $GLOBALS['txtCSVHeader'] . "</h3>";
        $out .= "<p>" . $GLOBALS['txtCSVInstructions'] . "</p>";

        $out .= "<pre class=\"addMarginBottom\">";

        $out .= "date,";

        foreach ($chartSeriesLabels as $key => $dataLabelItem) {
            $out .= $dataLabelItem . ',';
        }

        $out .= "\n";

        foreach ($chartAxisLabels as $keyAxisLabel => $itemAxisLabel) {

            $out .= $itemAxisLabel . ",";

            $i = 0;
            $maxChartDataItems = count( $chartData ) - 1;

            // For each chartData item, which are measurements
            foreach ($chartData as $keyChartData => $chartDataItem) {
                $out .= $chartData[$keyChartData][$itemAxisLabel];

                // if this isn't the last item, add a comma
                if ($i != $maxChartDataItems) {
                    $out .= ",";
                }

                $i++;
            }

            $out .= "\n";
        }

        $out .= "</pre>";
        $out .= "</div>";

    }

    return $out;

}

?>