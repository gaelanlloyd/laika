<?php

function dataFindMaxValue( $array ) {

	$m = arrayFlatten( $array );
    $maxValue = max( $m );

    // DEBUG
    /*
    ?><pre>Max value = [<?php echo $maxValue; ?>]</pre><?php
    ?><pre><?php print_r( $m ); ?></pre><?php
    */

    return $maxValue;

}