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
define('DB_NAME', 'i4301252_wp2');

/** MySQL database username */
define('DB_USER', 'i4301252_wp2');

/** MySQL database password */
define('DB_PASSWORD', 'P#Prhsyr*KHSCM]ED@.65@.0');

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
define('AUTH_KEY',         'Ri0TqQHGvDIfxgIroC5lWdQaxav0bVIvD6cFViUQstcbpUqSmve1DSVwH75f0aAC');
define('SECURE_AUTH_KEY',  'jNfw6a4Gai4eDtaOrzIc2qVLfbspYxc4Pp9Z3TKcvxPDzVMyMsoxq0hJ055k0XQp');
define('LOGGED_IN_KEY',    'EUchRt0bdUfcI4vgMVU0NI7VVWFJ0GL9ueqnd7Q592sIOI0zraRcjluyUS4WWGXn');
define('NONCE_KEY',        'UqSudYDldQGbBsvPHIiM2vHcOfs6ZSjX5ouB9kCn6zf0ViXPpdwAnWQI594849XB');
define('AUTH_SALT',        'oO0Bx3GnoB0t5IZBmmFPxblt9MXcUI6aveegpimmPwtgrUr8vZBz2Vu9pDE0BQtE');
define('SECURE_AUTH_SALT', 'xQPQT59vxGXCuGa4zoKXv6o0Ag3V8g2345fS7XoWH2Ivx0RZr8DZucRbA7jWGNpD');
define('LOGGED_IN_SALT',   'iyVksmiGMh1tG4j8ZeNOPZevMQwapFASqsWWHuQaWmVo5OPtbVWXTcX9kLE0IYlT');
define('NONCE_SALT',       'gVa5jh2nu4f7X9rkfPkGn8l8HLWKF86IIla4oHcKC5jmxX3bu2N3VLPoOCzgfJfO');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
