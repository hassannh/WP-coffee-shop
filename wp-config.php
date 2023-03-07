<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ecommerce' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '<>-FqZ0@fmi{%rLq)c?fXWTbkUK%A[91<@[yMCiluSg}T-LNmS6XZqjQq*+a(m11' );
define( 'SECURE_AUTH_KEY',  'qk4&QWdre=bp.-rWk`O|DOX*y.LHf:o^1]BC]uSyMONx`TW;Mc47w[gg:XzKofT&' );
define( 'LOGGED_IN_KEY',    '#x}]bXK~l~w+b_>C&{70AEaqYO+2C>$r8}TD[RHdBua<veJ|[GA._8%9-z{M$:4{' );
define( 'NONCE_KEY',        '_=+|aw )BEoZT`RB-hBL;}8<g~o%)y]V-OHs!Bn?y+4Wb#$J!5PdM0^e0)uUJ)) ' );
define( 'AUTH_SALT',        '{Vn2Y_q(7kQPY{{x,V5n$=!/;eSQgF9Rhc}44s]!sv9Ar}oHRf1c*-!n<EQ39!AF' );
define( 'SECURE_AUTH_SALT', '`,{3k.BBCZ;^gYfOvN8Pl$~[oyKq6Dl%(}z+Bro sW-rwwF_Sg/_QT@Mhv}Qb_~N' );
define( 'LOGGED_IN_SALT',   'QpujE=#R7g qz-3Tz2swlDQ`,;Q,P@nIxXKt^N%#p@h(%CuVQ=VbnAI[lULv?Bwd' );
define( 'NONCE_SALT',       'XGM0s^=*P1q%t[dX*?M3s*aXA>p}tcnA$!fFWlWPRsg:_9a?y&d#6TJyc#.VH-BU' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
