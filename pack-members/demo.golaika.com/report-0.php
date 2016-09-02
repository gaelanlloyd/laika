<div class="row">
    <div class="col-md-12">
        <?php
            $reportData = getData("1", NULL, TRUE, TRUE);
            echo writeReport($reportData, "<a href=\"/?r=1\">Overall traffic</a>", "The total number of page views to each website.", TRUE);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php
            $reportData = getData("2");
            echo writeReport($reportData, "<a href=\"/?r=2\">New sessions</a>", "Number of new visits.", TRUE);
        ?>
    </div>

    <div class="col-md-6">
        <?php
            $reportData = getData("3", NULL, TRUE, TRUE);
            echo writeReport($reportData, "<a href=\"/?r=3\">Session duration</a>", "Average time spent on site.", TRUE);
        ?>
    </div>
</div>