<?php

// Trusted Host Settings
$settings['trusted_host_patterns'] = array(
  '^localhost$',
);

// $site_path is made available by Drupal core.
$sites_subdir = basename($site_path);

$databases['default']['default'] = array (
    'database' => 'd8ms_' . $sites_subdir,
    'username' => 'root',
    'password' => 'root',
    'host' => '127.0.0.1',
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
    'driver' => 'mysql',
);

$config_directories['sync'] = '../config/'. $sites_subdir . '/sync';

if (file_exists(__DIR__ . '/settings.allsites.local.php')) {
 include __DIR__ . '/settings.allsites.local.php';
}
