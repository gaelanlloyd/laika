<?php

function arrayFlatten( $array ) {

	$workingResults = array();

	$flatten = new RecursiveIteratorIterator( new RecursiveArrayIterator( $array ) );

	foreach ( $flatten as $f ) {
		$workingResults[] = $f;
	}

	return $workingResults;

}