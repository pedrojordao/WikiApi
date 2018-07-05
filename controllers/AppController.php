<?php

namespace controllers;

require_once('./models/App.php');
require_once('./views/View.php');

use models\App as App;
use views\View as View;

class AppController {

  protected $data;

  public function __construct() {
    $app = new App();
    $this->data = $app->getData();
  }

  public function call() {
    $view = new View;
    return $view->render($this->data);
  }

}
