<?php
	// put your Twilio API credentials here
	$accountSid = 'AC2fa75607a89bc98e3a6ac3a52e9ba5e2';
	$authToken  = 'e686702e693f52e8c1ed3bf72c95d164';
	
	// put your Twilio Application Sid here
	$appSid     = 'APab48cb0611d3afff341bd151827462be';//'AP53af85ef2b4887e8f103aa31089fe849';//
	
	$capability = new Services_Twilio_Capability($accountSid, $authToken);
	$capability->allowClientOutgoing($appSid);
	//$capability->allowClientIncoming('jenny');
	$token = $capability->generateToken();
	
?>
