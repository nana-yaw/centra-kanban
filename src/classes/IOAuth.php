<?php
namespace KanbanBoard;

interface IOAuth {
  public function authorize();
  public function getAccessToken(string $code) : string;
}

?>