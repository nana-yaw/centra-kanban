<?php

require '../classes/KanbanBoard/Github.php';
require '../classes/Utilities.php';
require '../classes/KanbanBoard/Authentication.php';

try {
	require '../../vendor/autoload.php';
	
	$reposource = (GH_REPOSITORIES != NULL && GH_REPOSITORIES != '') ? GH_REPOSITORIES : getenv('GH_REPOSITORIES');
	$repoacc = (GH_ACCOUNT != NULL && GH_ACCOUNT != '') ? GH_ACCOUNT : getenv('GH_ACCOUNT');

	$repositories = explode('|', $reposource);
	$authentication = new \KanbanBoard\Login();
	$token = $authentication->login();
	$github = new GithubClient($token, $repoacc);
	$board = new \KanbanBoard\Application($github, $repositories, array('all'));
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


