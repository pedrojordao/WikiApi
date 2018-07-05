<?php
namespace Views;

class View {

  public static function render($data) {
      return json_encode($data);
  }

}
