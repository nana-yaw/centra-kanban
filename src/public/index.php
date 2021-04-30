<?php

use KanbanBoard\Utilities;
use KanbanBoard\DotEnv;

require '../classes/KanbanBoard/Github.php';
require '../classes/Utilities.php';
require '../classes/KanbanBoard/Authentication.php';

try {
	require '../../vendor/autoload.php';

	try {

		(new DotEnv('../../.env'))->safeLoad();

	} catch (\InvalidArgumentException $th) {

		// echo 'The .env file was not found.';

	}

	$reposource = Utilities::env('GH_REPOSITORIES');
	$repoacc = Utilities::env('GH_ACCOUNT');

	$repositories = explode('|', $reposource);
	$authentication = new \KanbanBoard\Login();
	$token = $authentication->login();
	$github = new GithubClient($token, $repoacc);
	$board = new \KanbanBoard\Application($github, $repositories, array('waiting-for-feedback'));
	$data = $board->board();

	if ($data != NULL) {

			$m = new Mustache_Engine(array(
				'loader' => new Mustache_Loader_FilesystemLoader('../views'),
			));
		
			echo $m->render('index', array('milestones' => $data));
		
			return;

	}

	echo '<pre><strong>Warning!</strong> Server did not return data on repo(s).</pre>';

} catch (\Github\Exception\RuntimeException $e) {

	echo 'One of the repo returns empty! Please check the spelling of the value of GH_REPOSITORIES.';

}


