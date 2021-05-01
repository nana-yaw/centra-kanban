<?php

use KanbanBoard\Utilities;
use KanbanBoard\DotEnv;
use KanbanBoard\GithubOAuth;

require '../classes/KanbanBoard/GithubClient.php';
require '../classes/Utilities.php';
require '../classes/KanbanBoard/Authentication.php';

try {
	require '../../vendor/autoload.php';

	try {

		(new DotEnv('../../.env'))->safeLoad();

	} catch (\InvalidArgumentException $th) {

		// echo 'The .env file was not found.';

	}

	$client_id = Utilities::env('GH_CLIENT_ID');
	$client_secret = Utilities::env('GH_CLIENT_SECRET');
	$reposource = Utilities::env('GH_REPOSITORIES');
	$repoacc = Utilities::env('GH_ACCOUNT');

	$repositories = explode('|', $reposource);
	$authentication = new \KanbanBoard\Authentication(new GithubOAuth($client_id, $client_secret));
	$token = $authentication->login();
	$githubClient = new GithubClient($token, $repoacc);
	$application = new \KanbanBoard\Application($githubClient, $repositories, array('waiting-for-feedback'));
	$data = $application->board();

	if ($data != NULL) {

			$m = new Mustache_Engine(array(
				'loader' => new Mustache_Loader_FilesystemLoader('../views'),
			));
		
			echo $m->render('index', array('milestones' => $data));
		
			return;

	}

	echo '<pre><strong>Warning!</strong> Server did not return data on repo(s).</pre>';

} catch (\Github\Exception\RuntimeException $e) {

	throw 'One of the repo returns empty! Please check the spelling of the value of GH_REPOSITORIES.';

}


