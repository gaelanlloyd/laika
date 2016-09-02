<?php

function doReport($reportItem) {

	$reportData = getData($reportItem);
	echo writeReport($reportData);

}

?>