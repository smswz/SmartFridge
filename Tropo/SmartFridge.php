<?php
// Do not edit this token!
$token = '08c7389cddb1c249bad8d2542935141ffafc29d416c7c458e0bb5a359edb2a8e804477926100ae80ce66b389';

// This is the number to txt
$number = '4049392627';

// Include the Tropo library and create a Tropo object
include_once 'tropo.class.php';
$tropo = new Tropo();

// When the the session object is created, it tries
// to load the json that Tropo posts when reciving or
// making a call. If the json doesn't exist, the 
// Session object throws a TropoException.
// This try/catch block checks to see if this code is
// being run as part of a session or being run directly.
try {
  
  // this next line throws an exception if the code isn't
  // being run by Tropo. If that happens, the catch block
  // below will run.
  $session = new Session();
  
  if ($session->getParameters("action") == "create") {  
    // A token-launched session (an outgoing call) will
    // have a parameter called "action" that is set to
    // "create". If this is true, we're trying to make an
    // outgoing call. The next two lines make that call
    // and say something.
    $tropo->call($session->getParameters("dial"), array("network" => "SMS"));
    $tropo->say('WARNING: The fridge is too hot. You may want to check it!');
  } else {
    
    $caller = $session->getFrom();
    $tropo->say('Thank you for calling SMARTFRIDGE.  ');
	$tropo->say("Your phone number is " . $caller['id']);

	$called = $session->getTo();

	// $called now has a hash containing the keys: id, name, channel, and network
	$tropo->say("You called " . $called['id'] . " but you probably already knew that.");
	
	if ($called['channel'] == "TEXT") {
  // This is a text message
  $tropo->say("You contacted me via text.");
  
  // The first text of the session is going to be queued and applied to the first
  // ask statement you include...
  $tropo->ask("This will catch the first text", array('choices' => '[ANY]'));

  // ... or, you can grab that first text like this straight from the session.
  //$messsage = $tropo->getInitialText();

  //$tropo->say("You said " . $message);
} else {
  // This is a phone call
  $tropo->say("Awww. How nice. You cared enough to call.");
}
  }
  $tropo->renderJSON();
} catch (TropoException $e) {
  if ($e->getCode() == '1') {
    
    // The session object threw an exception, so this file wasn't
    // loaded as part of a Tropo session. Use the session API to 
    // launch a new session.
    if ($tropo->createSession($token, array('dial' => $number))) {
      print 'SMS launched to ' . $number;
    } else {
      print "SMS failed! Try it again with the Tropo debugger running to see what the error is.";
    }
  }
}
?>