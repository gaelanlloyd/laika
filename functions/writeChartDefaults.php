<?php

function writeChartDefaults() {

    $out = "";

    $out .= "Chart.defaults.global.animation = false;";
    $out .= "Chart.defaults.global.animationSteps = 60;";
    $out .= "Chart.defaults.global.responsive = true;";
    $out .= "Chart.defaults.global.maintainAspectRatio = false;";

    return $out;
}

?>