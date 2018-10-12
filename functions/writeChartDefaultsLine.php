<?php

function writeChartDefaultsLine() {

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
    $out .= "bezierCurve : true,";
    $out .= "bezierCurveTension : 0.4,";
    $out .= "pointDot : true,";
    $out .= "pointDotRadius : 6,";
    $out .= "pointDotStrokeWidth : 1,";
    $out .= "pointHitDetectionRadius : 20,";
    $out .= "datasetStroke : true,";
    $out .= "datasetStrokeWidth : 2,";
    $out .= "datasetFill : false,";
    $out .= "legendTemplate : \"<ul class=\\\"<%=name.toLowerCase()%>-legend\\\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\\\"background-color:<%=datasets[i].strokeColor%>\\\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>\"";
    $out .= "};";

    return $out;

}