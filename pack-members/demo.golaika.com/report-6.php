<?php

    $reportData = getData("10", NULL, TRUE, TRUE);
    echo writeReport($reportData, "Website downtime", "The number minutes that a website was offline during the month.", TRUE);

    $reportData = getData("11", NULL, TRUE, TRUE);
    echo writeReport($reportData, "Website downtime events", "The number of times that a website was offline during the month.", TRUE);

?>