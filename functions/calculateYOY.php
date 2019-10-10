<?php

function calculateYOY( $reportData ) {

	$out = array();

	// This requires data to be looked up from the database
	// as incoming $reportData will only contain enough data for the current chart
	// and we might need to look back further than that to generate YoY figures

    foreach ( $reportData as $siteName => $siteData ) {

    	$temp = array();

        foreach ( $siteData as $siteMonth => $siteMonthData ) {

	        // echo "siteData = $siteName / siteMonthData = [$siteMonthData]\n";

        	$lastYear = date('Y-m-d', strtotime('-1 years', strtotime($siteMonth) ) );

        	if ( array_key_exists( $lastYear, $siteData ) ) {

        		if ( $siteData[$lastYear] == 0 ) {
        			$temp[$siteMonth] = 0;
        		} else {

        			$new = $siteMonthData;
        			$old = $siteData[$lastYear];

        			$temp[$siteMonth] = ( ( $new - $old ) / $old ) * 100;
        		}

        	} else {

        		$temp[$siteMonth] = 0;

        	}

        }

        $out[$siteName] = $temp;
    }

	/*
	// DEBUG
	?><pre><?php print_r( $out ); ?></pre><?php
	*/

	return $out;

}
