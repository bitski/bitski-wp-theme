<?php

wp_nav_menu( array(
	'theme_location' => 'main-menu',
	'container'      => false,
	'menu_class'     => '',
	'fallback_cb'    => '__return_false',
	'items_wrap'     => '',
	'depth'          => 2,
	'walker'         => new \BitskiWPTheme\walkers\NavWalker(),
) );
