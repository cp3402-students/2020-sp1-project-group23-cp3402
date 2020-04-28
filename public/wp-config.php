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
define( 'DB_NAME', 'scotchbox' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '*%r^,&U!r1NufC~|V5.6xwv^- =bl[1(^<$-ZZ9Bxd!37qca2quuP/waiSf2=(t5' );
define( 'SECURE_AUTH_KEY',   'loB;tpy:{/od!`dKA9VKOE6GP<MF(5J>xBF.=m7,zV<CP#w_ZPNz+?<[&]8#G<D|' );
define( 'LOGGED_IN_KEY',     'Om_/C6#kDf[+7S|vr[J;{<Lq1]>TZpe$Z`6C4ixw(%-0:7nP]fh[d/oBO)fh[WZi' );
define( 'NONCE_KEY',         'RCU@CVZ6P$sGU6jlZ}&U<K5h9VPb6nQ%fh/&lp8s;XEAyr8Eh1CzPt*eN}s-!dWT' );
define( 'AUTH_SALT',         'um9wO)xWULD+*yKc:K^7Lzg,f|gQ|& )P[aFk2?m/SLq@TT#rL-kRVoVsKIC5qb/' );
define( 'SECURE_AUTH_SALT',  'Riz&SE2~v/3=h]AH>6*ih=S5Sh*{4CK>4V2c4`<[KWWal;dYHwr1PDH9$R?Ae<y&' );
define( 'LOGGED_IN_SALT',    '(mC+VA&1@ZG%zT&PgJmhT@@yydyyyykS*Nty;8db<#Lg<n>P-)/I@_jPy.jytcxN' );
define( 'NONCE_SALT',        ',d;qmLQYai X=#!Kl*@tVNEwG@P@V9}+?7Q1=8pTA^yD&Dc%G<!/2V/hG~C?a!}b' );
define( 'WP_CACHE_KEY_SALT', 'ItWR*~s)Q]-~gEICHtA}} )5*)(ZtLSxR.iDSC,?AJ6|SZCW]6rX3,gmS>DopeWc' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
