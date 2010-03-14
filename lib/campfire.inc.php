<?php


require_once("lib/curl.inc.php");
require_once("lib/xml.campfire.inc.php");

require_once("lib/campfire.confs.inc.php");


////
//// CLASS - CAMPFIRE CURL CONNECTION FOR GET METHOD
////
//
class CCampfireCurlGetConnection extends CCurlGetAuth
{
	private $_sURLBase;
	private $_sURL;
	private $_sUserName;
	private $_sPassword;
	
	protected $_sURLPostfix;

	public function __construct()
	{
		$this->_sURLBase = S_URL_CAMPFIRE_BASE;
		
		$this->_sURL = $this->_sURLBase.$this->_sURLPostfix;
		$this->_sUserName = S_LOGIN_CAMPFIRE_USERTOKEN;
		$this->_sPassword = S_LOGIN_CAMPFIRE_PASSWORD;
	
		parent::__construct($this->_sURL, $this->_sUserName, $this->_sPassword);
	}
}


////
//// CLASS - CAMPFIRE CURL CONNECTION FOR POST METHOD
////
//
class CCampfireCurlPostConnection extends CCurlPostAuth
{
	private $_sURLBase;
	private $_sURL;
	private $_sUserName;
	private $_sPassword;
	
	protected $_sURLPostfix;

	public function __construct()
	{
		$this->_sURLBase = S_URL_CAMPFIRE_BASE;
		
		$this->_sURL = $this->_sURLBase.$this->_sURLPostfix;
		$this->_sUserName = S_LOGIN_CAMPFIRE_USERTOKEN;
		$this->_sPassword = S_LOGIN_CAMPFIRE_PASSWORD;
	
		parent::__construct($this->_sURL, $this->_sUserName, $this->_sPassword);
	}
	
	public function PrepareOptions()
	{
		parent::PrepareOptions();
		
		curl_setopt($this->_ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml'));
	}
}


////
//// CLASS - CAMPFIRE GET - LIST ALL ROOMS
////
//
/*
<rooms type="array">
  <room>
    <id type="integer">1</id>
    <name>North May St.</name>
    <topic>37signals HQ</topic>
    <membership-limit type="integer">60</membership-limit>
    <full type="boolean">false</full>
    <open-to-guests type="boolean">true</open-to-guests>
    <active-token-value>#{ 4c8fb -- requires open-to-guests is true}</active-token-value>
    <updated-at type="datetime">2009-11-17T19:41:38Z</updated-at>
    <created-at type="datetime">2009-11-17T19:41:38Z</created-at>
  </room>
  ...
</rooms>
*/
class CCampfireListAllRooms extends CCampfireCurlGetConnection
{
	public function __construct()
	{
		$this->_sURLPostfix = "/rooms.xml";
		
		parent::__construct();
	}
}


////
//// CLASS - CAMPFIRE GET - SHOW ROOM AND USERS WITHIN IT
////
//
/*
<room>
  <id type="integer">1</id>
  <name>North May St.</name>
  <topic>37signals HQ</topic>
  <membership-limit type="integer">60</membership-limit>
  <full type="boolean">false</full>
  <open-to-guests type="boolean">true</open-to-guests>
  <active-token-value>#{ 4c8fb -- requires open-to-guests is true}</active-token-value>
  <updated-at type="datetime">2009-11-17T19:41:38Z</updated-at>
  <created-at type="datetime">2009-11-17T19:41:38Z</created-at>
  <users type="array">
    <user>
      <id type="integer">1</id>
      <name>Jason Fried</name>
      <email-address>jason@37signals.com</email-address>
      <admin type="boolean">#{true || false}</admin>
      <created-at type="datetime">2009-11-20T16:41:39Z</created-at>
      <type>#{Member || Guest}</type>
    </user>
	...
  </users>
</room>
*/
class CCampfireShowRoom extends CCampfireCurlGetConnection
{
	public function __construct($iRoomId)
	{
		$this->_sURLPostfix = "/room/".$iRoomId.".xml";
		
		parent::__construct();
	}
}


////
//// CLASS - CAMPFIRE POST - SPEAK WITHIN A ROOM
////
//
/*
<message>
  <id type="integer">1</id>
  <room-id type="integer">1</room-id>
  <user-id type="integer">2</user-id>
  <body>Hello Room</body>
  <created-at type="datetime">2009-11-22T23:46:58Z</created-at>
  <type>#{TextMessage || PasteMessage || SoundMessage || AdvertisementMessage ||
          AllowGuestsMessage || DisallowGuestsMessage || IdleMessage || KickMessage ||
          LeaveMessage || SystemMessage || TimestampMessage || TopicChangeMessage ||
          UnidleMessage || UnlockMessage || UploadMessage}</type>
</message>
*/
class CCampfireSpeak extends CCampfireCurlPostConnection
{
	public function __construct($iRoomId)
	{
		$this->_sURLPostfix = "/room/".$iRoomId."/speak.xml";
		
		parent::__construct();
	}
}

?>