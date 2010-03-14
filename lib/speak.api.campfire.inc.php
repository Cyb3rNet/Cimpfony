<?php


/**
 *	Speak
 *
 *	Allows the authenticated user to send different types of messages to a room.
 *
 *	@author Serafim Junior Dos Santos Fagundes <serafim@cyb3r.ca>
 *	@copyright Copyright (c) 2010 Serafim Junior Dos Santos Fagundes Cyb3r Networks
 *	@license MIT License
 *
 *	@package Rooms
 */
 
 
/**
 *	Speak - POST /room/#{id}/speak.xml
 *
 *	Sends a new message with the currently authenticated user as the sender. The XML for the new message is returned on a successful request.
 *	
 *	The valid types are:
 *	
 *	* TextMessage (regular chat message)
 *	* PasteMassage (pre-formatted message, rendered in a fixed-width font)
 *	* TweetMessage (a Twitter status URL to be fetched and inserted into the chat)
 *	* SoundMessage (plays a sound as determined by the message, either “rimshot”, “crickets”, or “trombone”)
 *	
 *	If an explicit type is omitted, it will be inferred from the content (e.g., if the content contains new line characters, it will be considered a paste).
 *
 *	Request
 *
 *	<code>
 *		<message>
 *			<type>TextMessage</type>
 *			<body>Hello</body>
 *		</message>
 *	</code>
 *
 *	Response
 *	Status: 201 Created
 *
 *	<code>
 *		<message>
 *			<id type="integer">1</id>
 *			<body>Hello</body>
 *			<room-id type="integer">1</room-id>
 *			<user-id type="integer">2</user-id>
 *			<created-at type="datetime">2009-11-22T19:11:41Z</created-at>
 *			<type>TextMessage</type>
 *		</message>
 *	</code>
 *
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