<<<<<<< HEAD:src/api/v1/autoload.php
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

// Require files instead of using an autoloader (more stable than auto, for now)
require_once('../../../class/RailTime/AccountUtility.class.php');
require_once('../../../class/RailTime/Session.class.php');
require_once('../../../class/RailTime/Customer.class.php');
require_once('../../../class/RailTime/Admin.class.php');
require_once('../../../class/RailTime/Station.class.php');
require_once('../../../class/RailTime/Chatroom.class.php');
require_once('../../../class/RailTime/ChatMessage.class.php');


// Create an instance/object for all classes in camCase
$session = new RailTime\Session($mysqli);
$customer = new RailTime\Customer($mysqli);
$admin = new RailTime\Admin($mysqli);
$station = new RailTime\Station($mysqli);
$chatroom = new RailTime\Chatroom($mysqli);
$chatmessage = new RailTime\ChatMessage($mysqli);


=======
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

// Require files instead of using an autoloader (more stable than auto, for now)
require_once('../../../class/RailTime/AccountUtility.class.php');
require_once('../../../class/RailTime/Session.class.php');
require_once('../../../class/RailTime/Customer.class.php');
require_once('../../../class/RailTime/Admin.class.php');
require_once('../../../class/RailTime/Station.class.php');
require_once('../../../class/RailTime/Chatroom.class.php');
require_once('../../../class/RailTime/ChatMessage.class.php');
require_once('../../../class/RailTime/Announcement.class.php');
require_once('../../../class/RailTime/Forum.class.php');
require_once('../../../class/RailTime/Survey.class.php');

// Create an instance/object for all classes in camCase
$session = new RailTime\Session($mysqli);
$customer = new RailTime\Customer($mysqli);
$admin = new RailTime\Admin($mysqli);
$station = new RailTime\Station($mysqli);
$chatroom = new RailTime\Chatroom($mysqli);
$chatmessage = new RailTime\ChatMessage($mysqli);
$announcement = new RailTime\Announcement($mysqli);
$forum = new RailTime\Forum($mysqli);
$survey = new RailTime\Survey($mysqli);

>>>>>>> 97abbe19e8a7027d7d50f3d506d3d9cc87fdf0f6:backend_src/api/v1/autoload.php
?>