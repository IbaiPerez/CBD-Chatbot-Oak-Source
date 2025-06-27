<?php


// create transcript
$intentName = getIntent();


if($intentName != "basics_welcome"){

  $source = 'Functionality';
  $userResponse = getUserInput();
  $sessionId = getContextParameter("auto")['config']['sessionId'];

  $userInput = getUserInput();

  $createTranscript = Transcripts::createTranscript($sessionId,$source,$userResponse,$intentName,$input);


}


?>
