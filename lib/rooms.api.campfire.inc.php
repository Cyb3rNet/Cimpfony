<?php

/**
 *	Rooms
 *
 *	The rooms API allows you to access information about any room under the account and lock/unlock the rooms.
 *
 *	@author Serafim Junior Dos Santos Fagundes <serafim@cyb3r.ca>
 *	@copyright Copyright (c) 2010 Serafim Junior Dos Santos Fagundes Cyb3r Networks
 *	@license MIT License
 *
 *	@package Rooms
 */

 
include("connection.inc.php");
 
 
/**
 *
 *	List all - GET /rooms.xml
 *
 *	Returns a collection of the rooms that are visible to the authenticated user.
 *
 *	Response
 *
 *	<code>
 *		<room>
 *			<id type="integer">1</id>
 *			<name>North May St.</name>
 *			<topic>37signals HQ</topic>
 *			<membership-limit type="integer">60</membership-limit>
 *			<full type="boolean">false</full>
 *			<open-to-guests type="boolean">true</open-to-guests>
 *			<active-token-value>#{ 4c8fb -- requires open-to-guests is true}</active-token-value>
 *			<updated-at type="datetime">2009-11-17T19:41:38Z</updated-at>
 *			<created-at type="datetime">2009-11-17T19:41:38Z</created-at>
 *			<users type="array">
 *			...
 *			</users>
 *		</room>
 *	</code>
 */
class CCampfireListAllRooms extends CCampfireCurlGetConnection
{
	public function __construct()
	{
		$this->_sURLPostfix = "/rooms.xml";
		
		parent::__construct();
	}
}


/**
 *
 *	Show - GET /room/#{id}.xml
 *
 *	Returns an existing room. Also includes all the users currently inside the room.
 *
 *	Response
 *	Status: 200 OK
 *	
 *	<code>
 *		<room>
 *			<created-at type="datetime">2009-11-17T19:41:38Z</created-at>
 *			<id type="integer">1</id>
 *			<membership-limit type="integer">60</membership-limit>
 *			<name>North May St.</name>
 *			<topic>37signals HQ</topic>
 *			<updated-at type="datetime">2009-11-17T19:41:38Z</updated-at>
 *			<open-to-guests type="boolean">true</open-to-guests>
 *			<full type="boolean">false</full>
 *			<active-token-value>4c8fb</active-token-value>
 *			<users type="array">
 *				<user>
 *				<admin type="boolean">true</admin>
 *				<created-at type="datetime">2009-11-20T16:41:39Z</created-at>
 *				<email-address>jason@37signals.com</email-address>
 *					<id type="integer">1</id>
 *				<name>Jason Fried</name>
 *				<type>Member</type>
 *				</user>
 *				...
 *			</users>
 *		</room>
 *	</code>
 *
 */
class CCampfireShowRoom extends CCampfireCurlGetConnection
{
	public function __construct($iRoomId)
	{
		$this->_sURLPostfix = "/room/".$iRoomId.".xml";
		
		parent::__construct();
	}
}


?>