<?php
define('WP_CACHE', false);
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
include_once ('pinconfig.php');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'bgtzgyk9cqkfvl6egctdw08zvqzwa6znaaq8yj07gipknocjfufwnyzyxxycczy2' );
define( 'SECURE_AUTH_KEY',  'tid8nw20xpao3byg8dbdttlialcwgg8btl6asnql7wjl7gbidv2457ggfdcn7ck6' );
define( 'LOGGED_IN_KEY',    'c6ocr9ap5zserpx47zqjxrmpdjtn62yaymokjsvhfl5plyebomsxgftp4kdifzpa' );
define( 'NONCE_KEY',        'ncmeqrcpjmexbyqt7ccrswopzgoqtw9clpt4jw5mjwdv9pecoesadcsfr4axa0g7' );
define( 'AUTH_SALT',        'dr3xkd3zhzimv8l8asoiwbamu0lnwonecmevdeewt1mxapeifweyfjvdrsi3ymk8' );
define( 'SECURE_AUTH_SALT', 'nc1exxfgvyvk2bn1tmwknkserfetzp5pdfkvondoqusmkcjq6ndr2jbhxtgdph1t' );
define( 'LOGGED_IN_SALT',   'y2luwpvcqo2hkga5r3hdorwjqhnoyuuiri81irln5bybhso3i0lbezbkhikc7n3f' );
define( 'NONCE_SALT',       'r9dr2gdu6pqnbzqebfoo22mqadnzrroizc5u6x5mgd92fjre3zh9yfwtkxbf6yym' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpat_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
