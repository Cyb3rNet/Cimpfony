<?php


/**
 *	The XML Objects
 *
 *	The file containes the XML generator classes for the submissions to the API service.
 *
 *	@author Serafim Junior Dos Santos Fagundes <serafim@cyb3r.ca>
 *	@copyright Copyright (c) 2010 Serafim Junior Dos Santos Fagundes Cyb3r Networks
 *	@license MIT License
 *
 *	@package XML
 */
 
 
/**
 *	Generic XML Object for markup creation.
 */
class CXMLObject
{
	/**
	 *	@var string Holds the head of the node
	 */
	private $_sStartNode;


	/**
	 *	@var string Holds the tail of the node
	 */
	private $_sEndNode;


	/**
	 *	@var string Holds the content of the node
	 */
	private $_sContent;


	/**
	 *	@var array Hash holding the attributes
	 */
	private $_aAttrs;
	

	/**
	 *	@param string $sTagName Name of the node
	 */
	public function __construct($sTagName)
	{
		$this->_sTagName = $sTagName;
	
		$this->_sStartNode = "";
		$this->_sEndNode = "";
		
		$this->_sContent = "";
		
		$this->_aAttrs = array();
	}
	

	/**
	 *	Adds an attribute to the node
	 *
	 *	@param string $sName Name of the attribute
	 *	@param string $sValue Value of the attribute
	 */
	public function AddAttr($sName, $sValue)
	{
		$this->_aAttrs[$sName] = $sValue;
	}
	

	/**
	 *	Appends content to the node
	 *
	 *	@param string $sContent Content to be inserted in the node
	 */
	public function AppendContent($sContent)
	{
		$this->_sContent .= $sContent;
	}
	

	/**
	 *	Replaces the node content
	 */
	public function ReplaceContent($sContent)
	{
		$this->_sContent = $sContent;
	}
	

	/**
	 *	Generates the head of the node
	 *
	 *	@return string
	 */
	private function _ComposeStartNode()
	{
		$sAttrs = "";
	
		foreach ($this->_aAttrs as $k => $v)
		{
			$sAttrs .= $k.'="'.$v.'" ';
		}
	
		return "<".$this->_sTagName." ".$sAttrs.">";
	}
	

	/**
	 *	@return string
	 */
	public function __toString()
	{
		$this->_sStartNode = $this->_ComposeStartNode();
		$this->_sEndNode = "</".$this->_sTagName.">";
	
		return $this->_sStartNode.$this->_sContent.$this->_sEndNode;
	}
}


/**
 *	Creates an XML message object
 *	
 *	<code>
 *		<message>
 *		  <id type="integer">1</id>
 *		  <room-id type="integer">1</room-id>
 *		  <user-id type="integer">2</user-id>
 *		  <body>Hello Room</body>
 *		  <created-at type="datetime">2009-11-22T23:46:58Z</created-at>
 *		  <type>#{TextMessage || PasteMessage || SoundMessage || AdvertisementMessage ||
 *				  AllowGuestsMessage || DisallowGuestsMessage || IdleMessage || KickMessage ||
 *				  LeaveMessage || SystemMessage || TimestampMessage || TopicChangeMessage ||
 *				  UnidleMessage || UnlockMessage || UploadMessage}</type>
 *		</message>
 *	</code>
 */
class CCampfireXMLMessage extends CXMLObject
{
	/**
	 *	@var string Message type defining a regular text message
	 */
	const sMsgTypeTextMsg = 'TextMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypePasteMsg = 'PasteMessage';

	
	/**
	 *	@var string Message type defining a sound message
	 */
	const sMsgTypeSoundMsg = 'SoundMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeAdvetisementMsg = 'AdvertisementMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeAllowGuestMsg = 'AllowGuestsMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeDisallowGuestMsg = 'DisallowGuestsMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeIdleMsg = 'IdleMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeKickMsg = 'KickMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeLeaveMsg = 'LeaveMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeSystemMsg = 'SystemMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeTimestampMsg = 'TimestampMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeTopicChangeMsg = 'TopicChangeMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeUnidleMsg = 'UnidleMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeUnlockMsg = 'UnlockMessage';

	
	/**
	 *	@var string Message type
	 */
	const sMsgTypeUploadMsg = 'UploadMessage';


	public function __construct()
	{
		parent::__construct("message");
		
		$this->_oXMLNodeBody = new CXMLObject("body");
		$this->_oXMLNodeType = new CXMLObject("type");
	}
	
	
	/**
	 *	Sets the message for a chat submission
	 *
	 *	@param string $sContent The message
	 *	@param string $cType One of the message type constants
	 */
	public function SetMessage($sContent, $cType)
	{
		$this->_oXMLNodeBody->AppendContent($sContent);
		$this->_oXMLNodeType->AppendContent($cType);
	}
	
	
	/**
	 *	@return string
	 */
	public function __toString()
	{
		parent::AppendContent($this->_oXMLNodeBody);
		parent::AppendContent($this->_oXMLNodeType);
	
		return parent::__toString();
	}
}


?>