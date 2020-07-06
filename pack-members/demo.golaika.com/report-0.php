<div class="row">
    <div class="col-md-12">
        <?php
            $reportData = getData("1", NULL, TRUE, TRUE);
            echo writeReport( array(
                "reportData" => $reportData,
                "chartTitle" => "<a href=\"/?r=1\">Overall traffic</a>",
                "chartCaption" => "The total number of page views to each website.",
                "sitesAsSeries" => TRUE,
                // "backgroundColor" => "fillColorNone",
            ));
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php
            $reportData = getData("2", NULL, TRUE, TRUE);
            echo writeReport( array(
                "reportData" => $reportData,
                "chartTitle" => "<a href=\"/?r=2\">New sessions</a>",
                "chartCaption" => "Number of new visits.",
                "sitesAsSeries" => TRUE,
            ));
        ?>
    </div>

    <div class="col-md-6">
        <?php
            $reportData = getData("3", NULL, TRUE, TRUE);
            echo writeReport( array(
                "reportData" => $reportData,
                "chartTitle" => "<a href=\"/?r=3\">Session duration</a>",
                "chartCaption" => "Average time spent on site.",
                "sitesAsSeries" => TRUE,
            ));
        ?>
    </div>
</div>