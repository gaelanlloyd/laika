<?php

function writeChartDefaults( $atts ) {

	// --- Handle options ---

    $defaults = array(
    	"chartType" => NULL,
        "axisYMaxValue" => NULL,
    );

    extract( array_merge( $defaults, $atts ) );

    // --- Process max axis value ---

    $modifyYAxisMaxValue = FALSE;

    if ( !empty( $axisYMaxValue ) ) {

        $modifyYAxisMaxValue = TRUE;
        $suggestedMax = roundUpToNearest( $axisYMaxValue, 100 );

    }

    // --- Write output ---

	ob_start();

	?>

	var options = {

	    legend: {
	        display: true,
	        position: 'bottom',
	    },

	    animation: {
	        duration: 500,
	    },

	    tooltips: {
	        mode: 'index',
	        displayColors: false,
	        position: 'nearest',
	        bodyFontFamily: 'Consolas, Courier New, monospace',
	    },

        scales: {

            yAxes: [{
                ticks: {
                    <?php if ( $modifyYAxisMaxValue ) { ?>
                    suggestedMax: <?php echo $suggestedMax; ?>,
                    <?php } ?>
                    suggestedMin: 0,
                }
            }]

        },

	    responsive: true,
	    maintainAspectRatio: false,

	};

    <?php

    return ob_get_clean();
}