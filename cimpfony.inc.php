<?php


################################################################################
##	EDIT THE FOLLOWING CONSTANTS
####


##	THE CAMPFIRE DOMAIN AND SUBDOMAIN OF THE ACCOUNT
##
define('S_URL_CAMPFIRE_BASE', '');


##	THE USER TOKEN YOU WILL USE FOR THE API REGISTERED
##  TO THE PREVIOUS URL ACCOUT
##
define('S_LOGIN_CAMPFIRE_USERTOKEN', '');


####
##	END OF API USER EDITING
################################################################################


################################################################################
##	START INCLUDES
####


require_once("lib/campfire.confs.inc.php");


require_once("lib/xml.campfire.inc.php");


require_once("lib/rooms.api.campfire.inc.php");
#require_once("lib/search.api.campfire.inc.php");
#require_once("lib/speak.api.campfire.inc.php");
#require_once("lib/transcripts.api.campfire.inc.php");
#require_once("lib/users.api.campfire.inc.php");
#require_once("lib/streaming.api.campfire.inc.php");


####
##	END INCLUDES
################################################################################


?>