<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Autoload
 * 
 * Load all classes here
 */

// Require files instead of using an autoloader (more stable)
require_once('../../../class/RailTime/AccountUtility.class.php');
require_once('../../../class/RailTime/Customer.class.php');
require_once('../../../class/RailTime/Station.class.php');
require_once('../../../class/RailTime/Session.class.php');

// Create an instance/object for all classes in camCase
$customer = new RailTime\Customer($mysqli);
$station = new RailTime\Station($mysqli);
$session = new RailTime\Session($mysqli);
?>