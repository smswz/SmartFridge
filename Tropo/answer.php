<?php
require 'tropo.class.php';

$tropo = new Tropo();
$tropo->ask('What is your favorite programming language?', array(
  'choices'=>'PHP, Ruby(Ruby, Rails, Ruby on Rails), Python, Java(Groovy, Java), Perl',
  'event'=> array(
    'nomatch' => 'Never heard of it.',
    'timeout' => 'Speak up!',
    )
  ));
// Tell Tropo how to continue if a successful choice was made
$tropo->on(array('event' => 'continue', 'say'=> 'Fantastic! I love that, too!'));
// Render the JSON back to Tropo    
$tropo->renderJSON();
?>