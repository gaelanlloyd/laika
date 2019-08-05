<?php

function doReport($reportItem) {

	$reportData = getData($reportItem);

	echo writeReport( array(
		"reportData" => $reportData,
	) );

}