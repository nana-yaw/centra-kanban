<?php
  $variables = [
      'GH_CLIENT_ID' => 'YOUR_CLIENT_ID',
      'GH_CLIENT_SECRET' => 'YOUR_CLIENT_SECRET',
      'GH_ACCOUNT' => 'YOUR_GITHUB_USERNAME',
      'GH_REPOSITORIES' => 'YOUR_GITHUB_REPOSITORY_NAME',
  ];

  foreach ($variables as $key => $value) {

      putenv("$key=$value");
  }
?>
