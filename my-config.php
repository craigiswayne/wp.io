<?php
/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*
* For information on other constants that can be used for debugging,
* visit the documentation.
*
* @link https://wordpress.org/support/article/debugging-in-wordpress/
*/
/*$_SERVER['SERVER_NAME'] = isset( $_SERVER['SERVER_NAME'] ) ? $_SERVER['SERVER_NAME'] : 'localdev.co.za';
if( PHP_SAPI !== 'cli' ){
define( 'WP_HOME', 'http://'. $_SERVER['SERVER_NAME'] );
define( 'WP_SITEURL', 'http://'. $_SERVER['SERVER_NAME'] );
}

define( 'WP_SITEURL', 'http://' . $_SERVER[ 'HTTP_HOST' ] );
define('WP_HOME', 'http://' . $_SERVER[ 'HTTP_HOST' ] );*/
/**
ini_set('max_execution_time', '180' );
ini_set('memory_limit', '128M');
ini_set('post_max_size', '32M');
ini_set('upload_max_filesize','32M');
**/
$dev_mode = 'cli' === PHP_SAPI ? false : true;
$dev_mode = false;
ini_set( 'display_errors',$dev_mode );
error_reporting( $dev_mode ? -1 : E_ALL ^ E_DEPRECATED );
define( 'WP_DEBUG', $dev_mode );
define( 'WP_DEBUG_LOG', $dev_mode );
define( 'WP_DEBUG_DISPLAY', $dev_mode );
define( 'WP_MEMORY_LIMIT', '128MB' );
define( 'SAVEQUERIES', $dev_mode );
define( 'SCRIPT_DEBUG', $dev_mode );
define('COMPRESS_SCRIPTS', !$dev_mode);
define( 'WP_AUTO_UPDATE_CORE', !$dev_mode );
define( 'DISALLOW_FILE_EDIT', !$dev_mode );
/**
* Affects the following:
* 1. turns off notifications for plugin updates
* 1. Limits options when importing posts
*/
define( 'DISALLOW_FILE_MODS', $dev_mode );
define( 'CONCATENATE_SCRIPTS', $dev_mode );
define( 'COMPRESS_CSS', $dev_mode);
define( 'KIRKI_TEST', $dev_mode );
define( 'WP_POST_REVISIONS', !$dev_mode );
define( 'WP_CACHE', !$dev_mode );
define( 'AUTOSAVE_INTERVAL', 60*60*60*24*365 ); // Set autosave interval to 1x per year
define( 'EMPTY_TRASH_DAYS',  1 );
define( 'DISABLE_WP_CRON', true );
define( 'AUTOMATIC_UPDATER_DISABLED', !$dev_mode );
define( 'WP_HTTP_BLOCK_EXTERNAL', true );
