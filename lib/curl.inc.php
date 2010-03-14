<?php


////
//// CLASS - BASE CURL
////
//
class CCurlBaseGet
{
	protected $_ch;
	
	private $_sURL;

	public function __construct($sURL)
	{
		$this->_ch = curl_init();
		
		$this->_sURL = $sURL;
	}

	public function __destruct()
	{
		//closing the curl
		curl_close($this->_ch);
	}
	
	public function PrepareOptions()
	{
		curl_setopt($this->_ch, CURLOPT_URL, $this->_sURL);
	}

	public function Execute()
	{
		//getting response from server
		$sResponse = curl_exec($this->_ch);
		
		echo curl_error($this->_ch);
		
		return $sResponse;
	}
}


////
//// CLASS - CURL POST-AUTH
////
//
class CCurlPostAuth extends CCurlBaseGet
{
	private $_sUserName;
	private $_sPassword;
	
	private $_sPost;

	public function __construct($sURL, $sUser, $sPwd)
	{
		parent::__construct($sURL);
		
		$this->_sUserName = $sUser;
		$this->_sPassword = $sPwd;
		
		$this->_sPost = "";
	}

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
	
	public function SetPostString($sPost)
	{
		$this->_sPost = $sPost;
	}

	public function Execute()
	{
		curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $this->_sPost);

		return parent::Execute();
	}
}


////
//// CLASS - CURL GET-AUTH
////
//
class CCurlGetAuth extends CCurlBaseGet
{
	private $_sUserName;
	private $_sPassword;

	public function __construct($sURL, $sUser, $sPwd)
	{
		parent::__construct($sURL);
		
		$this->_sUserName = $sUser;
		$this->_sPassword = $sPwd;
	}

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