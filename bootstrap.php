<?php

require 'vendor/autoload.php';

#############################################
# environment
#############################################

// strict error reporting
error_reporting(-1);

// cli apps can log to STDOUT
ini_set('error_log',      'stdout');
ini_set('html_errors',    false);
ini_set('display_errors', true);

// UTC all the things
ini_set('date.timezone',  'UTC');
date_default_timezone_set('UTC');

