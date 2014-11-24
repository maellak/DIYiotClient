<?php

//system
require_once('system/config.php');

//exceptions
require_once('exceptions/ExceptionCodes.php');
require_once('exceptions/ExceptionMessages.php');
require_once('exceptions/ExceptionManager.php');

//api
require_once('../api/post/diy_writesketch.php');
require_once('../api/get/reboot.php');
require_once('../api/get/reload.php');
require_once('../api/get/showall.php');
require_once('../api/get/ps.php');
require_once('../api/get/isAlive.php');
require_once('../api/get/isAlivelocal.php');

?>