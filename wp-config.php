<?php
define('WP_CACHE', true);

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
define( 'WP_AUTO_UPDATE_CORE', false ); //For disabling wordpress update
define('DISALLOW_FILE_MODS',false);      //For disabling plugin updates
define('DISALLOW_FILE_EDIT',false);      //For disabling theme file edit
define('WP_MEMORY_LIMIT', '256M');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wisaki' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '3:jfT-+g76-b3n8<{0Hr`o`s$@M8M6>G7bai||,]Hg=)x}]) Xi2-_06f8Mn@pm(');
define('SECURE_AUTH_KEY',  '?MRjF-)k%@4(}U|#^`?E0ypMIc2C^ =s&f7g+370S&pN^0*i]jCsBjog>Ae,?i}@');
define('LOGGED_IN_KEY',    'F|i[v}k++GtAA(TkafG-ZHW.Ox2{k!1rfc*+*T8Du=-]x:XO:S2E^%-M#I2.tz|_');
define('NONCE_KEY',        'Fd84V1L|e_ 0({}ZC0RC1[(YaDAigrdwg]-GoGtQBaRR6Ot:NXD.-;$yH$l^PSHR');
define('AUTH_SALT',        '0gW|[9p0yr.o6+>(^s2M<P~ww~x+-U|!wK<[vB<freI$%@3w,$u+k%c9O<E*-;)t');
define('SECURE_AUTH_SALT', '4O|NtVwGrR7P3MOG%K:3Ijzn8}Njt6PEfB.,$CoM}Z1DJ)um.XN5aBIi#yc=%x>[');
define('LOGGED_IN_SALT',   'U1~U}+L]hG?BbB=d1G-%qAkSu.!JRj_NZ}QyaW=`>_:Y/-E8&4cplST~)Z)54T3:');
define('NONCE_SALT',       'fc`z bz_)8.4[k&wED<LbIea]=Jku#8k0d/W]|$[p>?<j<EdD-6a~Z>0PM3uv|BR');

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
