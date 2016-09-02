<?php

function writeError($procedure, $errorList) {

    $out = "";

    if (empty($errorList)) {
        $errorList = "<li>" . $GLOBALS['txtErrorListNotDefined'] . "</li>";
    }

    $out .= "<pre class=\"error\"><strong>ERROR: ". $procedure . "</strong>";
    $out .= "\n";
    $out .= "<ul>";

    foreach ($errorList as $errorListItem) {
        $out .= "<li>" . $errorListItem . "</li>";
    }

    $out .= "</ul>";
    $out .= "</pre>";

    return $out;

}

?>