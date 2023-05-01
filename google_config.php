<?php

//Include Google Client Library for PHP autoload file
require_once './google-api/vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client
$google_client->setClientId('587243604422-9gtu67220vcelpidlabj37fs7nh1lt2v.apps.googleusercontent.com');
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/CourseUp/login.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');
