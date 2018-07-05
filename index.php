<?php

require_once('./controllers/AppController.php');

use controllers\AppController as AppController;

$appController = new AppController;

if (!empty($_GET['search'])) {
  $appController->setParams(strip_tags($_GET['search']));
}

echo $appController->index();
