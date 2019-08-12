<?php

function roundUpToNearest( $i, $nearest ) {

	return ceil( $i / $nearest ) * $nearest;

}