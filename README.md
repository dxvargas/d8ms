Overview
===============
Drupal 8 multisite platform with composer.

:bell: This tool is under heavy construction, there are no releases at all.

d8ms is a multisite platform intended to use as a base for several subsites that
share most of the code. By using composer with "wikimedia/composer-merge-plugin",
all the composer.json files living in configuration and profile directories are
merged with the main composer.json file to generate a unique composer.lock file
that will be shared by all subsites.
 
This platform works with three layers:
1. This repository which is the base for all subsites sharing most of the code;
1. The profile repository which is defines common themes and modules for all
subsites;
1. The subsites repositories that have the custom themes, modules and
configuration files unique for each subsite.

Getting Started
===============
1. Clone this repo
1. Run `composer install`
1. Configure settings files
  * Create the file `drush/aliases.drushrc.local.php` based in `drush/aliases.drushrc.php`
  * Create the file `web/sites/sites.local.php` based in `web/sites/sites.php`
  * Create the file `web/sites/settings.allsites.local.php` based in `web/sites/settings.allsites.php`
1. Setup subsite configuration structure
  * Run `git clone git@github.com:dxvargas/d8ms-subsite.git subsite/default`
  * Make symlinks for the subsite directories
    * Run `cd config`
    * Run `ln -s ../subsite/default/config default`
1. Install Drupal
    * Run `cd ../web` and `drush @default site-install -vy --account-name=admin --account-pass=admin --config-dir=../config/default/sync`
    * Verify that sites are working: `drush @default status`


Creating a new Subite (e.g. `foo`)
===============

1. Follow the instructions in Getting Started
1. Configure settings files
  * Run `cp -r web/sites/default web/sites/foo && rm -rf web/sites/foo/files/*`
  * Add entry for `foo` in `drush/aliases.drushrc.local.php`
  * Add entry for `foo` in `web/sites/sites.local.php`
  * Probably you'll need to add a new entry to "trusted_host_patterns" in `settings.allsites.local.php`
1. Setup subsite configuration structure
  * Run `git clone git@github.com:dxvargas/d8ms-subsite.git subsite/foo` for an
example how configuration directories should be, in a final step you will change
the repository info
  * Make symlinks for the subsite directories
    * Run `cd config`
    * Run `ln -s ../subsite/foo/config foo`
1. Install Drupal
    * Run `cd ../web` and `drush @foo site-install -vy --account-name=admin --account-pass=admin --config-dir=../config/foo/sync`
    * Verify that sites are working: `drush @foo status`
1. Configure subsite/foo to have it's own repository
1. Usually you will also want to have custom themes and modules, you can store
them in `subsite/foo` and add symlinks in usual directories

Creating a new Subite (e.g. `foo`) with specific profile (e.g. d8mspro)
===============

1. Follow the instructions in Getting Started
1. Configure settings files
  * Run `cp -r web/sites/default web/sites/foo && rm -rf web/sites/foo/files/*`
  * Add entry for `foo` in `drush/aliases.drushrc.local.php`
  * Add entry for `foo` in `web/sites/sites.local.php`
  * Probably you'll need to add a new entry to "trusted_host_patterns" in `settings.allsites.local.php`
1. Setup subsite configuration structure
  * Run `git clone git@github.com:dxvargas/d8ms-subsite.git subsite/foo` for an
example how configuration directories should be, in a final step you will change
the repository info
  * Make symlinks for the subsite directories
    * Run `cd config`
    * Run `ln -s ../subsite/foo/config foo`
    * Run `cd ..`
1. Put a Drupal profile in place
    * Run `git clone git@github.com:dxvargas/d8mspro.git web/profiles/d8mspro`
    * Run `composer install`
1. Install Drupal
    * Run `cd web` and `drush @foo site-install d8mspro -vy --account-name=admin --account-pass=admin`
    * Verify that sites are working: `drush @foo status`
1. Configure subsite/foo to have it's own repository
1. Export configuration, run `drush @foo cex`
1. Usually you will also want to have custom themes and modules, you can store
them in `subsite/foo` and add symlinks in usual directories

ToDos
===============

1. Many of the steps for first install and creating a new subsite should be
automated with scripts;
1. Packages that come from a secondary composer.json (via "wikimedia/composer-merge-plugin")
should be downloaded into a path relative to that composer.json;
1. Implement a deployment strategy;

Notes
================

1. If subsite configuration structure is only for sync files, the repository
can be cloned directly there. If so, you it is not needed to use symlinks;
1. Thanks for the inspiration of [multiplesite](https://github.com/weitzman/multiplesite)
project from [Moshe Weitzman](https://github.com/weitzman).
