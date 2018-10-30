<?php

function writeChart($chartID, $chartType, $chartData, $chartSeriesLabels, $chartAxisLabels) {

    ob_start();

    // EXPECTS DATA IN THIS FORMAT

    // $chartID = "UniqueIDForChart"

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
        echo writeError( __FUNCTION__ , $errorList );
        $out = ob_get_clean();
        return $out;
    }

    // -------------------------------------------------------------------------

    ?>

    <div class="reportChart">
        <canvas id="<?php echo $chartID; ?>"></canvas>
    </div>

    <?php

    // DEBUG
    /*
    echo "<pre>WRITE CHART DATA:\n";
    echo print_r( $chartData );
    echo "</pre>";

    echo "<pre>CHART SERIES LABELS:\n";
    echo print_r( $chartSeriesLabels );
    echo "</pre>";
    */

    $labels = '"' . implode('", "', $chartAxisLabels) . '"';

    $ds = "";

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

        $ds .= "{";
        $ds .= "label: \""                . $chartSeriesLabels[$i]              . "\",";
        $ds .= "fillColor: \""            . getColor("fillColor",$i)            . "\",";
        $ds .= "strokeColor: \""          . getColor("strokeColor",$i)          . "\",";
        $ds .= "pointColor: \""           . getColor("pointColor",$i)           . "\",";
        $ds .= "pointStrokeColor: \""     . getColor("pointStrokeColor",$i)     . "\",";
        $ds .= "pointHighlightFill: \""   . getColor("pointHighlightFill",$i)   . "\",";
        $ds .= "pointHighlightStroke: \"" . getColor("pointHighlightStroke",$i) . "\",";
        $ds .= "data: ["                  . implode( ",", $chartData[$key])     . "]";
        $ds .= "},";

        $i++;

    }

    switch ($chartType) {

        case "bar";
            $defaults = writeChartDefaultsBar();
            $chart = "var myLineChart = new Chart(ctx).Bar(data, options);";
        break;

        case "line";
            $defaults = writeChartDefaultsLine();
            $chart = "var myLineChart = new Chart(ctx).Line(data, options);";
        break;

    }

    ?>

    <script>

        <?php echo writeChartDefaults(); ?>
        var ctx = document.getElementById("<?php echo $chartID; ?>").getContext("2d");

        // WRITE CHART DATA
        var data = {
            labels: [<?php echo $labels; ?>],
            datasets: [<?php echo $ds; ?>]
        };

        <?php
            echo $defaults;
            echo $chart;
        ?>

    </script>

    <?php

    $out = ob_get_clean();
    return $out;

}