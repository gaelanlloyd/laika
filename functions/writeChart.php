<?php

function writeChart( $atts ) {

    $defaults = array(
        "chartID" => NULL,
        "chartType" => NULL,
        "reportData" => NULL,
        "chartSeriesLabels" => NULL,
        "chartAxisLabels" => NULL,
        "axisYMaxValue" => NULL,
        "chartTitle" => NULL,
    );

    extract( array_merge( $defaults, $atts ) );

    ob_start();

    // EXPECTS DATA IN THIS FORMAT

    // $chartID = "UniqueIDForChart"

    // $reportData = array(
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

    <?php if ( !empty( $chartTitle ) ) { ?>
    <h4 class="reportChartTitle"><?php echo $chartTitle; ?></h4>
    <?php } ?>

    <div class="reportChart">
        <canvas id="<?php echo $chartID; ?>"></canvas>
    </div>

    <?php

    // DEBUG
    /*
    echo "<pre>WRITE CHART DATA:\n";
    echo print_r( $reportData );
    echo "</pre>";

    echo "<pre>CHART SERIES LABELS:\n";
    echo print_r( $chartSeriesLabels );
    echo "</pre>";
    */

    // Write simpler YYYY-MM chart labels (instead of the full YYYY-MM-DD ones)
    $cal = array();

    foreach ( $chartAxisLabels as $c ) {
        $cal[] = substr( $c, 0, 7 );
    }

    $labels = '"' . implode('", "', $cal) . '"';

    $ds = "";

    // For each series
    // foreach ( $chartSeriesLabels as $key => $dataLabel ) {
    $i = 0;

    foreach ($reportData as $key => $reportDataItem) {

        // DEBUG
        /*
        echo "<pre>\$reportData[\$key] = (\$key = $key)\n";
        echo print_r ( $reportData[$key] );
        echo "</pre>";
        */

        $ds .= "{";

        // $ds .= "repsonsive: true,";
        // $ds .= "maintainAspectRatio: true,";

        $ds .= "label: \"" . $chartSeriesLabels[$i] . "\",";

        $ds .= "data: [" . implode( ",", $reportData[$key]) . "],";

        switch ( $chartType ) {

            case "bar";
                $ds .= "backgroundColor: '" . getColor("fillColorSolid", $i) . "',";
            break;

            case "line";
                $ds .= "backgroundColor: '" . getColor("fillColorTransparent", $i) . "',";
            break;

        }

        $ds .= "borderColor: '" . getColor("strokeColor", $i) . "',";

        $ds .= "pointBackgroundColor: '" . getColor("strokeColor", $i) . "',";
        $ds .= "pointBorderColor: 'rgba(255,255,255,1)',";
        $ds .= "pointBorderWidth: 2,";
        $ds .= "pointRadius: 5,";

        $ds .= "pointHitRadius: 20,";

        $ds .= "pointHoverRadius: 5,";
        $ds .= "pointHoverBorderWidth: 2,";
        $ds .= "pointHoverBorderColor: \"" . getColor("pointHighlightStroke",$i) . "\",";
        $ds .= "pointHoverBackgroundColor: \""   . getColor("pointHighlightFill",$i)   . "\",";

        $ds .= "},";

        $i++;

    }

    switch ($chartType) {

        case "bar";

            $defaults = writeChartDefaults( array(
                "chartType" => "bar",
                "axisYMaxValue" => $axisYMaxValue,
            ) );

            $chart = "var myLineChart = new Chart(ctx, { type: 'bar', data, options });";


        break;

        case "line";

            $defaults = writeChartDefaults( array(
                "chartType" => "line",
            ) );

            $chart = "var myLineChart = new Chart(ctx, { type: 'line', data, options });";

        break;

    }

    ?>

    <script>

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