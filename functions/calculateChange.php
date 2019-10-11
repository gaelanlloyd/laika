<?php

function calculateChange( $old, $new ) {

	if ( $old == 0 ) {
		return 0;
	} else {
		return ( $new - $old ) / $old;
	}

}
