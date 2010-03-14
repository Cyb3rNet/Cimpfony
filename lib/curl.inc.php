<?php


/**
 *	The Curl classes
 *
 *	This file contains the classes that wraps the Curl connection calls.
 *
 *	@author Serafim Junior Dos Santos Fagundes <serafim@cyb3r.ca>
 *	@copyright Copyright (c) 2010 Serafim Junior Dos Santos Fagundes Cyb3r Networks
 *	@license MIT License
 *
 *	@package Connections
 */
 
 
/**
 *	Creates an instanciation of the Curl GET requester
 */
class CCurlBaseGet
{
	/**
	 *	@todo To document
	 */
	protected $_ch;
	

	/**
	 *	@todo To document
	 */
	private $_sURL;


	/**
	 *	@todo To document
	 */
	public function __construct($sURL)
	{
		$this->_ch = curl_init();
		
		$this->_sURL = $sURL;
	}


	/**
	 *	@todo To document
	 */
	public function __destruct()
	{
		//closing the curl
		curl_close($this->_ch);
	}
	

	/**
	 *	@todo To document
	 */
	public function PrepareOptions()
	{
		curl_setopt($this->_ch, CURLOPT_URL, $this->_sURL);
	}


	/**
	 *	@todo To document
	 */
	public function Execute()
	{
		//getting response from server
		$sResponse = curl_exec($this->_ch);
		
		echo curl_error($this->_ch);
		
		return $sResponse;
	}
}


/**
 *	Creates an instance of a GET Curl request authentificator
 */
class CCurlPostAuth extends CCurlBaseGet
{
	/**
	 *	@todo To document
	 */
	private $_sUserName;


	/**
	 *	@todo To document
	 */
	private $_sPassword;
	

	/**
	 *	@todo To document
	 */
	private $_sPost;


	/**
	 *	@todo To document
	 */
	public function __construct($sURL, $sUser, $sPwd)
	{
		parent::__construct($sURL);
		
		$this->_sUserName = $sUser;
		$this->_sPassword = $sPwd;
		
		$this->_sPost = "";
	}


	/**
	 *	@todo To document
	 */
	public function PrepareOptions()
	{
		parent::PrepareOptions();
		
		//curl_setopt($this->_ch, CURLOPT_VERBOSE, true);
		
		curl_setopt($this->_ch, CURLOPT_USERPWD, $this->_sUserName.":".$this->_sPassword);
		curl_setopt($this->_ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	
		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($this->_ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->_ch, CURLOPT_SSL_VERIFYHOST, false);
	
		curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->_ch, CURLOPT_POST, true);
	}
	

	/**
	 *	@todo To document
	 */
	public function SetPostString($sPost)
	{
		$this->_sPost = $sPost;
	}


	/**
	 *	@todo To document
	 */
	public function Execute()
	{
		curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $this->_sPost);

		return parent::Execute();
	}
}


/**
 *	Creates an instance of a GET Curl request authentificator
 */
class CCurlGetAuth extends CCurlBaseGet
{
	/**
	 *	@todo To document
	 */
	private $_sUserName;


	/**
	 *	@todo To document
	 */
	private $_sPassword;


	/**
	 *	@todo To document
	 */
	public function __construct($sURL, $sUser, $sPwd)
	{
		parent::__construct($sURL);
		
		$this->_sUserName = $sUser;
		$this->_sPassword = $sPwd;
	}


	/**
	 *	@todo To document
	 */
	public function PrepareOptions()
	{
		parent::PrepareOptions();
		
		//curl_setopt($this->_ch, CURLOPT_VERBOSE, true);
		
		curl_setopt($this->_ch, CURLOPT_USERPWD, $this->_sUserName.":".$this->_sPassword);
		curl_setopt($this->_ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	
		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($this->_ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->_ch, CURLOPT_SSL_VERIFYHOST, false);
	
		curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, true);
	}
}


?>