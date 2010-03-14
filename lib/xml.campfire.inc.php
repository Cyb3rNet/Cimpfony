<?php

////
//// CLASS - XML OBJECT
////
//
class CXMLObject
{
	private $_sStartNode;
	private $_sEndNode;

	private $_sContent;

	private $_aAttrs;
	
	public function __construct($sTagName)
	{
		$this->_sTagName = $sTagName;
	
		$this->_sStartNode = "";
		$this->_sEndNode = "";
		
		$this->_sContent = "";
		
		$this->_aAttrs = array();
	}
	
	public function AddAttr($sName, $sValue)
	{
		$this->_aAttrs[$sName] = $sValue;
	}
	
	public function AppendContent($sContent)
	{
		$this->_sContent .= $sContent;
	}
	
	public function ReplaceContent($sContent)
	{
		$this->_sContent = $sContent;
	}
	
	private function _ComposeStartNode()
	{
		$sAttrs = "";
	
		foreach ($this->_aAttrs as $k => $v)
		{
			$sAttrs .= $k.'="'.$v.'" ';
		}
	
		return "<".$this->_sTagName." ".$sAttrs.">";
	}
	
	public function __toString()
	{
		$this->_sStartNode = $this->_ComposeStartNode();
		$this->_sEndNode = "</".$this->_sTagName.">";
	
		return $this->_sStartNode.$this->_sContent.$this->_sEndNode;
	}
}


////
//// CLASS - CAMPFIRE XML MESSAGE
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
class CCampfireXMLMessage extends CXMLObject
{
	const sMsgTypeTextMsg = 'TextMessage';
	const sMsgTypePasteMsg = 'PasteMessage';
	const sMsgTypeSoundMsg = 'SoundMessage';
	const sMsgTypeAdvetisementMsg = 'AdvertisementMessage';
	const sMsgTypeAllowGuestMsg = 'AllowGuestsMessage';
	const sMsgTypeDisallowGuestMsg = 'DisallowGuestsMessage';
	const sMsgTypeIdleMsg = 'IdleMessage';
	const sMsgTypeKickMsg = 'KickMessage';
	const sMsgTypeLeaveMsg = 'LeaveMessage';
	const sMsgTypeSystemMsg = 'SystemMessage';
	const sMsgTypeTimestampMsg = 'TimestampMessage';
	const sMsgTypeTopicChangeMsg = 'TopicChangeMessage';
	const sMsgTypeUnidleMsg = 'UnidleMessage';
	const sMsgTypeUnlockMsg = 'UnlockMessage';
	const sMsgTypeUploadMsg = 'UploadMessage';

	public function __construct()
	{
		parent::__construct("message");
		
		$this->_oXMLNodeBody = new CXMLObject("body");
		$this->_oXMLNodeType = new CXMLObject("type");
	}
	
	public function SetMessage($sContent, $cType)
	{
		$this->_oXMLNodeBody->AppendContent($sContent);
		$this->_oXMLNodeType->AppendContent($cType);
	}
	
	public function __toString()
	{
		parent::AppendContent($this->_oXMLNodeBody);
		parent::AppendContent($this->_oXMLNodeType);
	
		return parent::__toString();
	}
}


?>