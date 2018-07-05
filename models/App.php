<?php

namespace Models;

class App {

  protected $data = Array();
  protected $url = 'https://en.wikipedia.org/w/api.php?action=query&format=json&prop=extracts&titles=Portugal&explaintext=1';
  protected $userAgent = 'MyTestApiScript';
  protected $contentType = 'application/json';

  public function makeCall() {
    $ch = curl_init($this->url);
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_USERAGENT => $this->userAgent,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: ' . $this->contentType
        ),
    ));

    $response = curl_exec($ch);

    if($response === FALSE){
        die(curl_error($ch));
    }

    return json_decode($response);
  }

  public function getData() {
    $content = array();
    $response = $this->makeCall();

    $pages = (array) $response->query->pages;
    foreach ($pages as $id => $page) {
      $content = array(
        'title' => $page->title,
        'content' => $page->extract,
      );
    }

    return $content;
  }

}
