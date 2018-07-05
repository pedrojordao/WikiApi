<?php

require_once('./controllers/AppController.php');

use controllers\AppController as AppController;

$appController = new AppController;

echo $appController->call();
