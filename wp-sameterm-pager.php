<?php
/*
Plugin Name: WP Same Term Pager
Plugin URI: https://shokizerokara.com/
Description: Navigate between posts within the same term using pagination.
Version: 0.9.17
Author: Emaki Sorano
Author URI: https://shokizerokara.com/
License: GPLv2
Requires at least: 5.8
Requires PHP: 7.4
Text Domain: wp-sameterm-pager
*/
if(!defined('ABSPATH')) { exit; }
define( 'SMTRM_PLUGIN_FILE', __FILE__ );
require_once('class-smtrm-plugin-activation.php');
require_once('globals.php');
require_once('class-smtrm-plugin-setup.php');
require_once('interface-smtrm-pager-interface.php');
require_once('class-smtrm-adjacent-post.php');
require_once('class-smtrm-get-setting.php');
require_once('class-smtrm-enqueue.php');
require_once('class-smtrm-widget.php');
require_once('class-smtrm-widget-area.php');
require_once('class-smtrm-sanitize.php');
require_once('class-smtrm-admin-menu.php');
require_once('class-smtrm-get-link.php');
require_once('class-smtrm-add-param.php');
require_once('class-smtrm-pager.php');