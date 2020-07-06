<?php

	$reportData = getData("10", NULL, TRUE, TRUE);
	echo writeReport( array(
		"reportData" => $reportData,
		"chartTitle" => "Website downtime",
		"chartCaption" => "The number minutes that a website was offline during the month.",
		"sitesAsSeries" => TRUE,
		"chartType" => "bar",
	));

	$reportData = getData("11", NULL, TRUE, TRUE);
	echo writeReport( array(
		"reportData" => $reportData,
		"chartTitle" => "Website downtime events",
		"chartCaption" => "The number of times that a website was offline during the month.",
		"sitesAsSeries" => TRUE,
		"chartType" => "bar",
	));

?>