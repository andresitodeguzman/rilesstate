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
require_once('../../class/RailTime/AccountUtility.class.php');
require_once('../../class/RailTime/Customer.class.php');

// Create an instance/object for all classes in camCase
$customer = new RailTime\Customer($mysqli);

?>