<?php

namespace controllers;

require_once('./models/App.php');
require_once('./views/View.php');

use models\App as App;
use views\View as View;

class AppController {

  protected $params;

  public function setParams($params) {
    $this->params = $params;
  }

  public function index() {
    $view = new View;
    $app = new App($this->params);

    try {
      $app->makeCall();
    } catch(Exception $e) {
      throw new Exception("We were unable to return any results.");
      die();
    }

    if (!empty($app->getData()->error)) {
      echo 'An error occurred while the result was being generated, please try again later.';
      die();
    }

    return $view->render((array) $app->getData()->query);
  }

}
