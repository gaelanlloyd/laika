<?php

function writeChartDefaultsBar() {

    ob_start();

    ?>

    var options = {

        <?php /*
        // Manually set Y-Axis;
        $out .= "scaleOverride : true,";
        $out .= "scaleSteps : 3,";
        $out .= "scaleStepWidth : 50,";
        $out .= "scaleStartValue : 0,";
        */
        ?>

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