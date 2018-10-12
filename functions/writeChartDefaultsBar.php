<?php

function writeChartDefaultsBar() {

    $out = "";

    $out .= "var options = {";

    // Manually set Y-Axis;
    /*
    $out .= "scaleOverride : true,";
    $out .= "scaleSteps : 3,";
    $out .= "scaleStepWidth : 50,";
    $out .= "scaleStartValue : 0,";
    */
    $out .= "scaleBeginAtZero : true,";

    $out .= "scaleShowGridLines : true,";
    $out .= "scaleGridLineColor : \"rgba(0,0,0,.05)\",";
    $out .= "scaleGridLineWidth : 1,";
    $out .= "scaleShowHorizontalLines: true,";
    $out .= "scaleShowVerticalLines: true,";

    $out .= "barShowStroke : true,";
    $out .= "barStrokeWidth : 2,";
    $out .= "barValueSpacing : 20,";
    $out .= "barDatasetSpacing : 10,";

    $out .= "legendTemplate : \"<ul class=\\\"<%=name.toLowerCase()%>-legend\\\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\\\"background-color:<%=datasets[i].strokeColor%>\\\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>\"";
    $out .= "};";

    return $out;

}