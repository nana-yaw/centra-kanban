<?php
use KanbanBoard\Authentication;
use KanbanBoard\GithubActual;
use KanbanBoard\Utilities;

require '../classes/KanbanBoard/Github.php';
require '../classes/Utilities.php';
require '../classes/KanbanBoard/Authentication.php';

$variables = [
	'GH_CLIENT_ID' => 'deebdfd727072c1e2b9e',
	'GH_CLIENT_SECRET' => 'b0bb9190af19a8602efdcdd13050025eea1a7f1c',
	'GH_ACCOUNT' => 'nana-yaw',
	'GH_REPOSITORIES' => 'imageShrink|centra-kanban',
];

foreach ($variables as $key => $value) {

	putenv("$key=$value");
}

$repositories = explode('|', Utilities::env('GH_REPOSITORIES'));
$authentication = new \KanbanBoard\Login();
$token = $authentication->login();
$github = new GithubClient($token, Utilities::env('GH_ACCOUNT'));
$board = new \KanbanBoard\Application($github, $repositories, array('waiting-for-feedback'));
$data = $board->board();
$m = new Mustache_Engine(array(
	'loader' => new Mustache_Loader_FilesystemLoader('../views'),
));
echo $m->render('index', array('milestones' => $data));
