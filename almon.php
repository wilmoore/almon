<?php

require 'bootstrap.php';

#############################################
# configuration
#############################################

// look for configuration in current and home directory

$local_config = realpath(__DIR__        . DIRECTORY_SEPARATOR . '.almon.ini');
$users_config = realpath(getenv('HOME') . DIRECTORY_SEPARATOR . '.almon.ini');

$config_file  = $local_config ?: $users_config;

// parse configuration 

if (!$config_file) {
  die(sprintf('[ABORTING]: Unable to read configuration file: "%s"', $config_file) . PHP_EOL);
}

$config = parse_ini_file($config_file, true);

#############################################
# main
#############################################

// bail out if we were not called with `-R or -F`

if (empty($argn)) { return; }

// parse input

$line = new Line($argn);
$ip   = $line->ip;

// bail out if there is nothing to process

if (!$ip) { return; }

// configure store

$store = new Store();

// bail out if we've already processed this IP

if ($store->exists($ip)) {
  fwrite(STDERR, sprintf('%s previously logged...SKIPPING!%s', $ip, PHP_EOL));
  return;
}

// store IP address

$store->insert($ip);

// configure mailer

$mail = new Mailer($config['smtp']);

// send

$mail($line->ip, $config['send']['to']);

