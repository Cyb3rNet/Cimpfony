<?php


/**
 *	The Campfire connection classes
 *
 *	This file contains the classes that make the API requests.
 *
 *	@author Serafim Junior Dos Santos Fagundes <serafim@cyb3r.ca>
 *	@copyright Copyright (c) 2010 Serafim Junior Dos Santos Fagundes Cyb3r Networks
 *	@license MIT License
 *
 *	@package Connections
 */
 
 
require_once("curl.inc.php");


/**
 *	Creates an instance of a Campfire GET requester
 */
class CCampfireCurlGetConnection extends CCurlGetAuth
{
	/**
	 *	@todo To Document
	 */
	private $_sURLBase;


	/**
	 *	@todo To Document
	 */
	private $_sURL;


	/**
	 *	@todo To Document
	 */
	private $_sUserName;


	/**
	 *	@todo To Document
	 */
	private $_sPassword;
	

	/**
	 *	@todo To Document
	 */
	protected $_sURLPostfix;


	/**
	 *	@todo To Document
	 */
	public function __construct()
	{
		$this->_sURLBase = S_URL_CAMPFIRE_BASE;
		
		$this->_sURL = $this->_sURLBase.$this->_sURLPostfix;
		$this->_sUserName = S_LOGIN_CAMPFIRE_USERTOKEN;
		$this->_sPassword = S_LOGIN_CAMPFIRE_PASSWORD;
	
		parent::__construct($this->_sURL, $this->_sUserName, $this->_sPassword);
	}
}


/**
 *	Creates an instance of a Campfire POST requester
 */
class CCampfireCurlPostConnection extends CCurlPostAuth
{
	/**
	 *	@todo To Document
	 */
	private $_sURLBase;


	/**
	 *	@todo To Document
	 */
	private $_sURL;


	/**
	 *	@todo To Document
	 */
	private $_sUserName;


	/**
	 *	@todo To Document
	 */
	private $_sPassword;
	

	/**
	 *	@todo To Document
	 */
	protected $_sURLPostfix;


	/**
	 *	@todo To Document
	 */
	public function __construct()
	{
		$this->_sURLBase = S_URL_CAMPFIRE_BASE;
		
		$this->_sURL = $this->_sURLBase.$this->_sURLPostfix;
		$this->_sUserName = S_LOGIN_CAMPFIRE_USERTOKEN;
		$this->_sPassword = S_LOGIN_CAMPFIRE_PASSWORD;
	
		parent::__construct($this->_sURL, $this->_sUserName, $this->_sPassword);
	}
	
	/**
	 *	@todo To Document
	 */
	public function PrepareOptions()
	{
		parent::PrepareOptions();
		
		curl_setopt($this->_ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml'));
	}
}

?>