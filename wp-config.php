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
define('AUTH_KEY',         '.)gDFv?J8!->]1-,UKf|tQ1D3sUF,%c;)3@iNI3uuNM{%Q.Bl+8V4Nb|EMI.Q2^C');
define('SECURE_AUTH_KEY',  '#QN1De{B.B*)AVRZ2#+Lmrz+ZYS)B11PF]C6@t8NBe/[bi%${0{I!B4y}q3,$M-T');
define('LOGGED_IN_KEY',    'gI1wT5gesq=Q%v@9dF2-xXfLk`dlY%R3*y%bNmS,Sy0w*Vng}Yjs%cyp]eQV;[^u');
define('NONCE_KEY',        'DNd?|Zx(nW8D;I+|PJ2RH8-S5.S`/y,_Gb~<L0:-j=i8<6`q#oh]^ijd6{90@Urz');
define('AUTH_SALT',        ':;#WCm|&:!G@XFoc)?eD%{Icwt1[%Z|cyNp1)BF@2Js[q;->sdE/=zYnt,n!i=}B');
define('SECURE_AUTH_SALT', 'S(n{7Pg8u(TL>GP?{^wC@Y-=?|`Gga*FIa]TS2_v)Pfj9c)#A|Ut<IP{0:iyQ]S-');
define('LOGGED_IN_SALT',   ',rbEfJTrCv;H*vfQ=OlOmChG*P>^SO{o|Yn+CJzL6F,0:(0o[T|u}kLWSE$GL5[]');
define('NONCE_SALT',       '[G QF~;Iw8_vXk~i[2I+~z+knV=c23!|t^/tc3BT`rQa%s3Y|jj{L+Pgr3eP?y7,');

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
