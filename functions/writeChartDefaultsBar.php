<?php

function writeChartDefaultsBar( $atts ) {

    $defaults = array(
        "axisYMaxValue" => NULL,
    );

    extract( array_merge( $defaults, $atts ) );

    // --- Process max axis value ---

    $modifyYAxisMaxValue = FALSE;

    if ( !empty( $axisYMaxValue ) ) {

        $modifyYAxisMaxValue = TRUE;
        $suggestedMax = roundUpToNearest( $axisYMaxValue, 100 );

    }

    ob_start();

    ?>

    var options = {

        <?php if ( $modifyYAxisMaxValue ) { ?>

        <?php // Scale for Chart.js v1 is (scale steps / scale step width) = max scale number ?>

        scaleOverride: true,
        scaleSteps: <?php echo $suggestedMax / 50; ?>,
        scaleStepWidth: 50,
        scaleStartValue: 0,

        <?php } ?>

        scaleBeginAtZero : true,

        scaleShowGridLines : true,
        scaleGridLineColor : "rgba(0,0,0,.05)",
        scaleGridLineWidth : 2,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,

        barShowStroke : false,
        barStrokeWidth : 0,
        barValueSpacing : 5,
        barDatasetSpacing : 0,

        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",

    };

    <?php

    $out = ob_get_clean();
    return $out;

}