<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="/"><img src="/images/logo-laika-100h-white.png" width="142" height="50"></a>

            <?php if ( isDevSite() ) { ?>
                <span class="demoMarker">DEMO</span>
            <?php } ?>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php /*
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Profile</a></li>
                */ ?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Help <span class="caret"></span></a>
                	<ul class="dropdown-menu">
                		<li><a href="https://github.com/gaelanlloyd/laika/wiki" target="_blank">Documentation</a></li>
                		<li role="separator" class="divider"></li>
                		<li><a href="/about.php">About</a></li>
                	</ul>
                </li>
            </ul>

            <?php
                global $CURRENT_URL;
                global $REPORT_ID;
                global $NUM_MONTHS;
                global $FILTER_MONTHS;
            ?>

            <form class="navbar-form navbar-right" action="<?php echo $CURRENT_URL; ?>">
                <?php // <input type="text" class="form-control" placeholder="Search..."> ?>

                <?php // This hidden field will keep the currently-selected report shown while the filters are adjusted ?>
                <input name="r" type="hidden" value="<?php echo $REPORT_ID; ?>">

                <label for="controlNumberMonths"><?php echo __t('Show'); ?>:</label>

                <select name="m" class="form-control" id="controlNumberMonths">

                    <?php

                        foreach ( $FILTER_MONTHS as $item ) {

                            // is this the currently selected value?
                            if ( $NUM_MONTHS == $item ) {
                                $selected = 'selected="selected"';
                            } else {
                                $selected = '';
                            }

                            ?><option <?php echo $selected; ?> value="<?php echo $item; ?>"><?php echo $item . " " . strtolower(__t('Months')); ?></option>
                        <?php } ?>

                </select>
                <input type="submit" class="form-control" value="<?php echo __t('Go'); ?>">
            </form>

        </div>
    </div>
</nav>
