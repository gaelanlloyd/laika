<?php include('includes/header.php');

// If URL parameter [r] is not specified, forward to the first report item so a blank page
// doesn't show up

if ( empty($REPORT_ID) ) { ?>

	<script type="text/javascript">
		window.location.href = "/?r=1";
	</script>

<?php }

// Get the report item from the database using the URL parameter [r]

$report = $DATABASE->select($TBL_MENU_ITEMS, "*",
    array("id" => $REPORT_ID)
);

$reportData = $report[0]["report_layout"];
$reportHeader = $report[0]["report_header"];
$reportDescription = $report[0]["report_description"];

// DEBUG
/*
echo "<pre>";
echo print_r($report);
echo "</pre>";
*/

/*
$reportData = htmlentities($reportData);
echo "<pre>";
echo $reportData;
echo "</pre>";
*/

/*
echo "<pre>";
echo print_r($metric);
echo "</pre>";
*/

// Write the report header
if ( !empty($reportHeader) ) { ?>
	<h1 class="page-header"><?php echo $reportHeader; ?></h1>

	<?php if ( !empty($reportDescription) ) { ?>
		<p><?php echo $reportDescription; ?></p>
	<?php } ?>

	<hr>
<?php }

/* eval(' ?>'. $reportData .'<?php '); */
eval($reportData);

include('includes/footer.php');

?>