<?php

function writeChart($chartID, $chartType, $chartData, $chartSeriesLabels, $chartAxisLabels) {

    // EXPECTS DATA IN THIS FORMAT

    // $chartID = "UniqueIDForChart"

    // $chartData = array(
    //     array(65,59,80,81,56,55,40),
    //     array(28,48,40,19,86,27,90)
    // );

    // $chartSeriesLabels = array( "Series 1", "Series 2");

    // $chartAxisLabels = array( "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" );

    $out = "";

    // -------------------------------------------------------------------------
    // CHECK FOR ERRORS

    $error = FALSE;
    $errorList = array();

    // Ensure too much data isn't passed in
    if ( count( $chartSeriesLabels ) > $GLOBALS['MAX_SERIES'] ) {
        $error = TRUE;
        $errorList[] = $GLOBALS['txtErrorTooMuchData'];
    }

    // Ensure chart type is one of the valid choices
    switch ($chartType) {
        case "bar";
        case "line";
        break;

        default;
            $error = TRUE;
            $errorList[] = $GLOBALS['txtInvalidChartType'];
        break;
    }

    // -------------------------------------------------------------------------

    if ($error) {
        $out .= writeError( __FUNCTION__ , $errorList );
        return $out;
    }

    // -------------------------------------------------------------------------

    $out .= "<div class=\"reportChart\">";
    $out .= "<canvas id=\"" . $chartID . "\"></canvas>";
    $out .= "</div>";

    $out .= "<script>";
    $out .= writeChartDefaults();

    $out .= "var ctx = document.getElementById(\"" . $chartID . "\").getContext(\"2d\");";

    // WRITE CHART DATA
    $out .= "var data = {";
    $out .= "labels: [\"" . implode("\",\"", $chartAxisLabels) . "\"],";
    $out .= "datasets: [";

    // DEBUG
    /*
    echo "<pre>WRITE CHART DATA:\n";
    echo print_r( $chartData );
    echo "</pre>";

    echo "<pre>CHART SERIES LABELS:\n";
    echo print_r( $chartSeriesLabels );
    echo "</pre>";
    */

    // For each series
    // foreach ( $chartSeriesLabels as $key => $dataLabel ) {
    $i = 0;

    foreach ($chartData as $key => $chartDataItem) {

        // DEBUG
        /*
        echo "<pre>\$chartData[\$key] = (\$key = $key)\n";
        echo print_r ( $chartData[$key] );
        echo "</pre>";
        */

        $out .= "{";
        $out .= "label: \""                . $chartSeriesLabels[$i]              . "\",";
        $out .= "fillColor: \""            . getColor("fillColor",$i)            . "\",";
        $out .= "strokeColor: \""          . getColor("strokeColor",$i)          . "\",";
        $out .= "pointColor: \""           . getColor("pointColor",$i)           . "\",";
        $out .= "pointStrokeColor: \""     . getColor("pointStrokeColor",$i)     . "\",";
        $out .= "pointHighlightFill: \""   . getColor("pointHighlightFill",$i)   . "\",";
        $out .= "pointHighlightStroke: \"" . getColor("pointHighlightStroke",$i) . "\",";
        $out .= "data: ["                  . implode( ",", $chartData[$key])     . "]";
        $out .= "},";

        $i++;

    }

    $out .= "]";
    $out .= "};";

    switch ($chartType) {
        case "bar";
            $out .= writeChartDefaultsBar();
            $out .= "var myLineChart = new Chart(ctx).Bar(data, options);";
        break;

        case "line";
            $out .= writeChartDefaultsLine();
            $out .= "var myLineChart = new Chart(ctx).Line(data, options);";
        break;
    }

    $out .= "</script>";

    return $out;

}

?>