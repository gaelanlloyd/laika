<?php

function writeReportItem( $args ) {

	/**
	 * Write the report item to the screen using the data passed to it.
	 *
	 * @param string $title             Chart title.
	 * @param string $caption           Chart caption.
	 * @param string $type              Chart type ('line', default, or 'bar').
	 * @param array  $data              Array with chart data.
	 * @param array  $chartSeriesLabels Array with chart series labels.
	 * @param array  $chartAxisLabels   Array with x-axis labels.
	 * @param int    $axisYMaxValue     Sets the y-axis maximum value.
	 */

	extract( $args );

	ob_start();

	// generate a unique name for the canvas

	// remove any html tags that may be in the chart title
	$canvasName = strip_tags($title);

	// remove any special characters that may remain
	$canvasName = preg_replace('/[^A-Za-z0-9\-]/', '', $canvasName);

	$canvasName = str_replace(' ', '', $canvasName);		// remove spaces
	$canvasName = strtolower($canvasName);					// make lowercase
	$canvasName = $canvasName . '-' . rand(1000,9999);		// add random numbers
	$canvasName = $canvasName . '-' . uniqid();				// add a uniqid to help avoid collisions

	?><h2 class="chartTitle"><?php echo $title; ?></h2><?php

	// if there is a report caption, write it
	if ( !empty($caption) ) {
		?><p><?php echo $caption; ?></p><?php
	}

	// DEBUG
	// echo '<pre>Canvas name = [' . $canvasName . ']</pre>';

	?>


	<div class="reportItem">

	<?php

	echo writeChart( array(
		// "chartTitle" => "Actual data",
		"chartID" => $canvasName,
		"chartType" => $type,
		"reportData" => $data,
		"chartSeriesLabels" => $chartSeriesLabels,
		"chartAxisLabels" => $chartAxisLabels,
		"axisYMaxValue" => $axisYMaxValue,
	) );

	echo writeTable( array(
		"reportData" => $data,
		"chartSeriesLabels" => $chartSeriesLabels,
		"chartAxisLabels" => $chartAxisLabels,
	) );

	?>
	</div>

	<hr>

	<?php

	$out = ob_get_clean();
	return $out;

}