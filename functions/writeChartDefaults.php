<?php

function writeChartDefaults() {

	ob_start();

	?>
    Chart.defaults.global.animation = false;
    Chart.defaults.global.animationSteps = 60;
    Chart.defaults.global.responsive = true;
    Chart.defaults.global.maintainAspectRatio = false;
    <?php

    $out = ob_get_clean();
    return $out;
}