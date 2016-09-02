<html>

<head>

	<title>Laika - Automated Web Reporting</title>

	<!-- JQUERY -->
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<!-- BOOTSTRAP 3 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<!-- STYLE -->
	<link href="css/style.css" rel="stylesheet">

	<!-- GOOGLE FONT -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<!-- CHART.JS -->
	<script src="js/Chart.min.js"></script>

	<!-- FASTCLICK.JS -->
	<script src="js/fastclick.js"></script>

	<!-- LAIKA JS -->
	<script src="js/functions.js"></script>

	<!-- GOOGLE ANALYTICS via GOOGLE TAG MANAGER -->
	<?php
		// If no GTM ID is provided
		if ( empty($GTM_ID) ) {
			// And if we are on the demo site
			if ( isDemoSite() ) {
				// Set the GTM ID to be for the Demo site (GTM-PVG9NR)
				$GTM_ID = "GTM-PVG9NR";
			} else {
				// Set the GTM ID to be for generic new installs (GTM-T9WP8X)
				$GTM_ID = "GTM-T9WP8X";
			}
		}
	?>
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=<?php echo $GTM_ID; ?>"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?php echo $GTM_ID; ?>');</script>

</head>

<body>

	<?php include('nav-top.php'); ?>

	<div class="container-fluid">
	    <div class="row">

	    	<!-- LHS SIDEBAR NAV -->

	        <div id="sidebar" class="col-sm-3 col-md-2 sidebar">
	        	<?php include('nav-left.php'); ?>
	        </div><!--/#sidebar-->

	        <!-- BODY -->
	        <div id="body" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
