<?php
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
define('DB_NAME', 'blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '1q2w3e4rA');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '${y^%v_*}_f#*WKu7P{U>O9qCIT7a=/0cb52t9H/cd[ZTOCF6Vwh]ebu+dh~<+@W');
define('SECURE_AUTH_KEY',  ' ^w<w6Tkb-Xdy.h=LK~uHsIrs3dXhh8Nf-~q=zuLc*>qYS`a#^KL[iE|kmu!Ir$ ');
define('LOGGED_IN_KEY',    ' `/cm6qi@1#rT.(!7X*7^KYNW~]LQZseHazUU Cg{&~;FOp2MZjh+[a2&==F;.1p');
define('NONCE_KEY',        'nPqC9z`qAXoqVI 8q,e@TD_Ga~Sn^}Ikc_#mbCC)38apV?Tk8(hLJpN8..8ykh+c');
define('AUTH_SALT',        'CP.5S_Buy$vH`W,~!T*#Xmd,bz;Mc?zN@vsT}U/55u%bkVy5t?wmG{70;=%d5|!k');
define('SECURE_AUTH_SALT', '?Q8u,uQ}!{Y$9S=}cJUMJ%A^uCSiS}PS?i~`zb0@f#!m-!=hV2}2X6Uz{2jES#bF');
define('LOGGED_IN_SALT',   'j|16Nx>5T3zFJEbj/@1%~:aLF.nD)+JidmQ$GV+Ow-aZ82ftW_yK&{SLHk(XZ&fr');
define('NONCE_SALT',       'om.n:lnku KY_KnjY>_#AbD[AmFvdeBr<VjjlBUCP;h&!4$&O{X (i2`ceKTil^ ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
