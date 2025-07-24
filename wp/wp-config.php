<?php

define( 'DB_NAME', 'anantatechtest' );
define( 'DB_USER', 'wpuser' );
define( 'DB_PASSWORD', 'wppass' );
define( 'DB_HOST', 'db' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// ... (keys and salts omitted for brevity)

$table_prefix = 'wp_';
define( 'WP_DEBUG', false );

// Fix redirect issue
define( 'WP_HOME', 'http://localhost:8080' );
define( 'WP_SITEURL', 'http://localhost:8080' );

/* That's all, stop editing! Happy publishing. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'wp-settings.php';

