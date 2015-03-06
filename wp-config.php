<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('FS_METHOD', 'direct');

define('DB_NAME', 'campcoders');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'camp@coders');

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
define('AUTH_KEY',         'mP-Kzo~DvCO8+[gQ(%^A$3lqs,9n;7!kqZo-YMq>e=|rm<IX{RiraQQ*P{ 5wv)|');
define('SECURE_AUTH_KEY',  'pqeU+]cr(ANwLf7~ynw#dWG:]p6.m-ctMJthUl{gLa-rjp6g:YSJmul1>[WS$4iN');
define('LOGGED_IN_KEY',    'NkPhT5-s!u,?<>]-@+p]Io-1h?3?~)mq!1,:quy8V-)T~JGH/k1P7N#A7v@X!Ih[');
define('NONCE_KEY',        '^%{%f$=D+@7?Z!)Q8ro?~*JZRu8+V+oN=:|=y@e=7;V8FCKG+b1-=C~EsY4KiLN}');
define('AUTH_SALT',        'LYhK<u}!)sy@fX+U`Ong:BjwXI]xqEky!~9y}}O;Fbr%Q6G:igguiKA[;-)~%#86');
define('SECURE_AUTH_SALT', 'l,N_[xKVxx^=y4sa-ewL3-<[.mOa&aT|2+#IgS]+;,m*El0bof_& <xEh>/gD9b)');
define('LOGGED_IN_SALT',   '_NSf|rsPW~5-V,-R:|K))sMV(]FFU-k9X~}%ydVr_ dgRH-7U7dVn#]-9|*iI@pK');
define('NONCE_SALT',       '1ix*VI|y+Y$y=su{ve3xSR704L|}CIWLjYq!Nf-)/Y_e-;Q:F!a_U>8B|f(%[eE5');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
