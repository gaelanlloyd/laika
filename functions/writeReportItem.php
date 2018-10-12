<?php

function writeReportItem($chartTitle, $chartType, $chartData, $chartSeriesLabels, $chartAxisLabels, $chartCaption) {

	$out = '';

	// generate a unique name for the canvas

	// remove any html tags that may be in the chart title
	$canvasName = strip_tags($chartTitle);

	// remove any special characters that may remain
	$canvasName = preg_replace('/[^A-Za-z0-9\-]/', '', $canvasName);

	$canvasName = str_replace(' ', '', $canvasName);		// remove spaces
	$canvasName = strtolower($canvasName);					// make lowercase
	$canvasName = $canvasName . '-' . rand(1000,9999);		// add random numbers
	$canvasName = $canvasName . '-' . uniqid();				// add a uniqid to help avoid collisions

	$out .= '<h2 class="chartTitle">';
	$out .= $chartTitle;
	$out .= '</h2>';

	// if there is a report caption, write it
	if ( !empty($chartCaption) ) {
		$out .= '<p>';
		$out .= $chartCaption;
		$out .= '</p>';
	}

	// DEBUG
	// $out .= '<pre>Canvas name = [' . $canvasName . ']</pre>';

	$out .= '<div class="reportItem">';

	$out .= writeChart($canvasName, $chartType, $chartData, $chartSeriesLabels, $chartAxisLabels);
	$out .= writeTable($chartData, $chartSeriesLabels, $chartAxisLabels);

	$out .= '</div>';

	$out .= '<hr>';

	return $out;

}