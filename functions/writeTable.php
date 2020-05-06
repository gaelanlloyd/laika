<?php

function writeTable( $atts ) {

    $defaults = array(
        "reportData" => NULL,
        "reportDataYOY" => NULL,
        "chartSeriesLabels" => NULL,
        "chartAxisLabels" => NULL
    );

    extract( array_merge( $defaults, $atts ) );

    ob_start();

    // EXPECTS DATA IN THIS FORMAT

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

    if ( count($chartSeriesLabels) > $GLOBALS['MAX_SERIES'] ) {
        $error = TRUE;
        $errorList[] = __t('ErrorTooMuchData');
    }

    // -------------------------------------------------------------------------

    if ( $error ) {
        echo writeError( __FUNCTION__ , $errorList );
        $out = ob_get_clean();
        return $out;
    }

    // -------------------------------------------------------------------------

    // Was YOY data provided?

    if ( !empty( $reportDataYOY ) ) {
        $showYOY = TRUE;
    } else {
        $showYOY = FALSE;
    }

    // WRITE THE DATA TABLE

    if ( empty($reportData) ) {

    	?><p><?php echo __t('NoDataWasProvided'); ?></p><?php

    } else {

        // --- Write legend ----------------------------------------------------

        /*
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
        */

        // --- Write table toggler button --------------------------------------

        ?>
        <p class="text-center">
        <a href="javascript:void(0)" class="toggler btn btn-default">
        <?php echo __t('ViewDataTable'); ?>
        </a>
        </p>
        <?php

        // --- Write table -----------------------------------------------------

        // DEBUG
        /*
        echo "<pre>\$reportData = \n";
        echo print_r( $reportData );
        echo "</pre>";
        */

        if ( $showYOY ) {
            $class_td = "addBorderLeft";
            $class_th = "addBorderLeft";
        } else {
            $class_td = "";
            $class_th = "";
        } ?>

        <div class="dataTable addMarginTop" style="display: none;">

        <div class="table-responsive addMarginBottom">
        <table class="table table-striped addBorder">
        <thead>
        <tr>
            <th></th>

        <?php
        foreach ($chartSeriesLabels as $key => $dataLabelItem) { ?>

            <?php if ( $showYOY ) { ?>
                <th colspan="2" class="text-center <?php echo $class_th; ?>">
            <?php } else { ?>
                <th>
            <?php } ?>

            <div style="width: 100%;">
                <div class="indicator" style="background-color: <?php echo getColor("strokeColor", $key); ?>"></div>
            </div>

            <?php echo $dataLabelItem; ?>

            </th>
        <?php } ?>

        </tr>



        <tr>
            <th></th>
        <?php
        foreach ($chartSeriesLabels as $key => $dataLabelItem) { ?>

            <th class="<?php echo $class_th; ?>">Data</th>

            <?php if ( $showYOY ) { ?>
                <th>YoY &Delta;%</th>
            <?php } ?>

        <?php } ?>
        </tr>



        </thead>
	    <tbody>

        <?php
        foreach ($chartAxisLabels as $keyAxisLabel => $itemAxisLabel) { ?>

            <tr>
            <th><?php echo $itemAxisLabel; ?></th>

            <?php
            // For each reportData item, which are measurements
            foreach ($reportData as $keyreportData => $reportDataItem) { ?>

                <td class="<?php echo $class_td; ?>"><?php echo $reportData[$keyreportData][$itemAxisLabel]; ?></td>

                <?php

                    if ( $showYOY ) {

                        $YOY = $reportDataYOY[$keyreportData][$itemAxisLabel];

                        $YOYNice = round( $YOY * 100, 1 );
                        $YOYNice = number_format( $YOYNice, 1 );

                        if ( $YOY < 0 ) {
                            $cellClass = "negative";
                        } else {
                            $cellClass = "";
                        }
                ?>
                <td class="<?php echo $cellClass; ?>"><?php echo $YOYNice; ?>%</td>
                <?php } ?>

            <?php } ?>

            </tr>

        <?php } ?>

        </tbody>
        </table>
        </div>

        <?php
        // --- CSV -------------------------------------------------------------

        $h_csv = __t('Date') . ",";

        foreach ($chartSeriesLabels as $key => $dataLabelItem) {
            $h_csv .= $dataLabelItem . ",";
        }

        // Strip off the trailing comma
        $h_csv = substr( $h_csv, 0, -1 );

        ?>

        <div class="row addMarginTop2x">
        <div class="col-md-6">

        <h3 class="mt0"><?php echo __t('CSVHeader'); ?></h3>
        <p><?php echo __t('CSVInstructions'); ?></p>

        <pre class="addMarginBottom limitHeight"><?php echo $h_csv;

        echo "\n";

        foreach ($chartAxisLabels as $keyAxisLabel => $itemAxisLabel) {

            echo $itemAxisLabel . ",";

            $i = 0;
            $maxreportDataItems = count( $reportData ) - 1;

            // For each reportData item, which are measurements
            foreach ($reportData as $keyreportData => $reportDataItem) {
                echo $reportData[$keyreportData][$itemAxisLabel];

                // if this isn't the last item, add a comma
                if ($i != $maxreportDataItems) {
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

        <h3 class="mt0"><?php echo __t('PivotHeader'); ?></h3>
        <p><?php echo __t('PivotInstructions'); ?></p>

        <pre class="addMarginBottom limitHeight"><?php

        echo __t('Date') . "\t";
        echo __t('Site') . "\t";
        echo __t('Sessions') . "\n";

        $temp = array();

        $cd = 0;
        foreach ( $reportData as $siteData ) {
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