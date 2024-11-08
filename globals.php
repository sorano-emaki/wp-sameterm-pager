<?php
if(!defined('ABSPATH')) { exit; }
define( 'SMTRM_DIR_URL', plugin_dir_url(__FILE__) );
define( 'SMTRM_DIR_PATH', plugin_dir_path( __FILE__ ) );
$plugin_data = get_file_data( SMTRM_PLUGIN_FILE, array(
    'Version' => 'Version',
));
define( 'SMTRM_VERSION', $plugin_data['Version'] );