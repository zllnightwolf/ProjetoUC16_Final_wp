<?php

foreach ( glob( QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/*/include.php' ) as $module ) {
	include_once $module;
}
