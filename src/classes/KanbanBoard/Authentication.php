<?php
namespace KanbanBoard;
use KanbanBoard\IOAuth;
use KanbanBoard\Utilities;

class Authentication {

	private $ioAuth;	

	public function __construct(IOAuth $_ioAuth)
	{
		$this->ioAuth = $_ioAuth;	
	}

	public function logout()
	{
		unset($_SESSION['gh-token']);
	}

	public function login()
	{
		session_start();
		$token = NULL;
		if(array_key_exists('gh-token', $_SESSION)) {
			$token = $_SESSION['gh-token'];
		}
		else if(Utilities::hasValue($_GET, 'code')
			&& Utilities::hasValue($_GET, 'state')
			&& $_SESSION['redirected'])
		{
			$_SESSION['redirected'] = false;
			$token = $this->ioAuth->getAccessToken($_GET['code']);
		}
		else
		{
			$_SESSION['redirected'] = true;
			$this->ioAuth->authorize();
		}
		$this->logout();
		$_SESSION['gh-token'] = $token;
		return $token;
	}
}
