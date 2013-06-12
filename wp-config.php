<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'acctla');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'galaxy1');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'QzgAr?MZP2<uN.L*hf&eTF%lG21(u9R%D->yNj^x7v[00n8v*wC$-+FO/|YKEuZK');
define('SECURE_AUTH_KEY',  'h_hjV7)2U4^vj9{2fBS^!$U1`!%gy^Y=fw3JwE+y.`:RvjA%!9=});oM&@&u+uS-');
define('LOGGED_IN_KEY',    '%n+%w;ItqX{XejV9HjG@en8d0phDBT?}]qlD]/1nEC-aUFh!vOLoxtyZ7+8%+HxX');
define('NONCE_KEY',        'lR@)mzH9!-(9m(Gs2*f6dfe]Yaxn*]6y$+$^YjL CD[F,Y@gERg,tA;i4TsrW86S');
define('AUTH_SALT',        '6|R#&/pJ(E2-aN08LUcNkFCbtS0;ZNGh$?|AM;+V[d+IJ+eQJE=6Z67:?^~kHW./');
define('SECURE_AUTH_SALT', '2@ryj5Ulq(H9?zw5r(0Aa-EtsWArm/aEfmS4)tKx(8_71%|`X j(R8;0,sK;9{T8');
define('LOGGED_IN_SALT',   'evzf 8l)E}`L.0S8WA}SNJx/<[F*]>~Up_KM?ShaJ|TJ*Ga+|+v(yXrQ*Q!bIxX2');
define('NONCE_SALT',       'rfGr2y}W,pz!(=,t*ejJ^W{bnq*z]-Qzg{(?s-B;[YnqcYm]m}0=%6mV|3{i(0mw');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
