<?php

function writeTable($chartData, $chartSeriesLabels, $chartAxisLabels) {

    ob_start();

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
        echo writeError( __FUNCTION__ , $errorList );
        $out = ob_get_clean();
        return $out;
    }

    // -------------------------------------------------------------------------

    // WRITE THE DATA TABLE

    if ( empty($chartData) ) {

    	?><p><?php echo $GLOBALS['txtNoDataWasProvided']; ?></p><?php

    } else {

        // --- Write legend ----------------------------------------------------

        ?>
        <div class="legend clearfix">
        <table><tbody><tr>

        <?php
        foreach ($chartSeriesLabels as $key => $dataLabelItem) { ?>
            <td class="series">
                <div class="indicator" style="background-color: <?php echo getColor("strokeColor", $key); ?>;"></div>
                <?php echo $dataLabelItem; ?>
            </td>
        <?php } ?>

        </tr></tbody></table>
        </div>

        <?php

        // --- Write table toggler button --------------------------------------

        ?>
        <p class="text-center">
        <a href="javascript:void(0)" class="toggler btn btn-default">
        <?php echo $GLOBALS['txtViewDataTable']; ?>
        </a>
        </p>
        <?php

        // --- Write table -----------------------------------------------------

        // DEBUG
        /*
        echo "<pre>\$chartData = \n";
        echo print_r( $chartData );
        echo "</pre>";
        */
        ?>

        <div class="dataTable" style="display: none;">

        <div class="table-responsive addMarginBottom">
        <table class="table table-striped">
        <thead>
        <tr>
        <th></th>

        <?php
        foreach ($chartSeriesLabels as $key => $dataLabelItem) { ?>
            <th>
            <div class="indicator" style="background-color: <?php echo getColor("strokeColor", $key); ?>"></div>
            <?php echo $dataLabelItem; ?>
            </th>
        <?php } ?>

        </tr>
        </thead>
	    <tbody>

        <?php
        foreach ($chartAxisLabels as $keyAxisLabel => $itemAxisLabel) { ?>

            <tr>
            <th><?php echo $itemAxisLabel; ?></th>

            <?php
            // For each chartData item, which are measurements
            foreach ($chartData as $keyChartData => $chartDataItem) { ?>
                <td><?php echo $chartData[$keyChartData][$itemAxisLabel]; ?></td>
            <?php } ?>

            </tr>

        <?php } ?>

        </tbody>
        </table>
        </div>

        <?php
        // --- CSV -------------------------------------------------------------

        $h_csv = $GLOBALS['txtDate'] . ",";

        foreach ($chartSeriesLabels as $key => $dataLabelItem) {
            $h_csv .= $dataLabelItem . ",";
        }

        // Strip off the trailing comma
        $h_csv = substr( $h_csv, 0, -1 );

        ?>

        <div class="row">
        <div class="col-md-6">

        <h3><?php echo $GLOBALS['txtCSVHeader']; ?></h3>
        <p><?php echo $GLOBALS['txtCSVInstructions']; ?></p>

        <pre class="addMarginBottom"><?php echo $h_csv;

        echo "\n";

        foreach ($chartAxisLabels as $keyAxisLabel => $itemAxisLabel) {

            echo $itemAxisLabel . ",";

            $i = 0;
            $maxChartDataItems = count( $chartData ) - 1;

            // For each chartData item, which are measurements
            foreach ($chartData as $keyChartData => $chartDataItem) {
                echo $chartData[$keyChartData][$itemAxisLabel];

                // if this isn't the last item, add a comma
                if ($i != $maxChartDataItems) {
                    echo ",";
                }

                $i++;
            }

            echo "\n";
        }
        ?></pre>
        </div>

        <?php
        // --- Pivot -----------------------------------------------------------
        ?>

        <div class="col-md-6">

        <h3><?php echo $GLOBALS['txtPivotHeader']; ?></h3>
        <p><?php echo $GLOBALS['txtPivotInstructions']; ?></p>

        <pre class="addMarginBottom"><?php

        echo $GLOBALS['txtDate'] . "\t";
        echo $GLOBALS['txtSite'] . "\t";
        echo $GLOBALS['txtSessions'] . "\n";

        $temp = array();

        $cd = 0;
        foreach ( $chartData as $siteData ) {
            $sd = 0;
            foreach ( $siteData as $siteMonthData ) {
                $temp[] = $chartAxisLabels[$sd] . "\t" . $chartSeriesLabels[$cd] . "\t" . $siteMonthData . "\n";
                $sd++;
            }
            $cd++;
        }

        asort( $temp );

        foreach ( $temp as $t ) {
            echo $t;
        }
        ?></pre>
        </div>

        </div>

        <?php
        // ---------------------------------------------------------------------
        ?>

        </div>

    <?php }

    $out = ob_get_clean();
    return $out;

}