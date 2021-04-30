<?php
use KanbanBoard\Authentication;
use KanbanBoard\GithubActual;
use KanbanBoard\Utilities;

require '../classes/KanbanBoard/Github.php';
require '../classes/Utilities.php';
require '../classes/KanbanBoard/Authentication.php';

$variables = [
	'GH_CLIENT_ID' => 'deebdfd727072c1e2b9e',
	'GH_CLIENT_SECRET' => '624c19fb7bce91d71628b061647f8b6c183646f5',
	'GH_ACCOUNT' => 'nana-yaw',
	'GH_REPOSITORIES' => 'imageShrink|centrakanban',
];

foreach ($variables as $key => $value) {

	putenv("$key=$value");
}

try {
	$repositories = explode('|', Utilities::env('GH_REPOSITORIES'));
	$authentication = new \KanbanBoard\Login();
	$token = $authentication->login();
	$github = new GithubClient($token, Utilities::env('GH_ACCOUNT'));
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

	echo 'One of the repo returns empty! Please check the value GH_REPOSITORIES.';

}


