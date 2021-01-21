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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'alshorts' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '/9W=;+f0C;(yP< hK&t/C^}s-z*qf(!P(FJu1)!dG0mz5gY8VMM.C)Q>6a/e%S@F' );
define( 'SECURE_AUTH_KEY',  '9@~~54cON>]S#g<kR4}3L;^q&^`1G] Zqw8Q5MwIEtZ:HOreSiUms3gzLTm%Ini+' );
define( 'LOGGED_IN_KEY',    'V*}]4{InI7DRY_f.l5pW]:0_,UPUG%:#+pMd_YTre`CB:B!zH[=9l>rtYBh>)3Wd' );
define( 'NONCE_KEY',        'ejvYWWX]m,~9FyLvw&ONo.b[5CIlJPZE3C.DpEvkG{PV!r=,m&>ZL]T!^+A{xJMr' );
define( 'AUTH_SALT',        ')HUV%z><47WUA$sis?Rfr:~-z4y2GCr8mdR$A*9(Hh#A,{Mx,q~pL;#Q+9`L4:>O' );
define( 'SECURE_AUTH_SALT', 'OW1pnlQ^0Eutd+sox&+fJt?i&aPO5I[>dNwo:)O:.e,4`Ym[),;|BCX`#XbPn2uM' );
define( 'LOGGED_IN_SALT',   'BX+&E`3Z3yQnFpAE^x1z@Su0&0TOvI.s5QXKsJ2)%A!e$0P@aY7r*,9&S?.m|;rA' );
define( 'NONCE_SALT',       'k!80U?Jfl[4_M!AML@,^2wrKS jqoM$lv?6`U/k0:l&@^Ae0uvhaRF^Rg(l&ZZ^&' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );
define('WP_AUTO_UPDATE_CORE', false); //Stop AutoUpdate Wordpress Core.

/**
 * API baseurl define
 */
define('API_BASEURL','https://alshorts.herokuapp.com/');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
