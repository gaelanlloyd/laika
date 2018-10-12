<?php

// Loop through each [menu_group] in the DB
$navGroups = $DATABASE->select($TBL_MENU_GROUPS, "*", array( "ORDER" => "id" ));

foreach ($navGroups as $navGroup) {

	?>
	<ul class="nav nav-sidebar">
	<?php

	// If a group doesn't have a name, don't make a header for it.
	// Useful for the first item (Overview) and possibly other instances.

	if ( empty($navGroup["group_name"]) == FALSE ) { ?>
		<li class="disabled"><a href="javascript:void(0)"><?php echo $navGroup["group_name"]; ?></a></li>
	<?php }

	$navItems = $DATABASE->select($TBL_MENU_ITEMS, "*",
		array( "group_id" => $navGroup["id"] )
	);

	foreach ($navItems as $navItem) {
		if ( 1 != $navItem['hidden'] ) {
			echo writeSidebarNavItem( $navItem["menu_item_title"], "/?r=" . $navItem["id"] );
		}
	}

	?>
	</ul>
	<?php

}