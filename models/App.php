<?php

namespace Models;

class App {

  protected $data = Array();
  protected $url = 'https://en.wikipedia.org/w/api.php';
  protected $aParams = array(
    'action' => 'query',
    'format' => 'json'
  );
  protected $userAgent = 'MyTestApiScript';
  protected $contentType = 'application/json';

  public function __construct($params) {
    if (!empty($params)) {
      $this->aParams['list'] = 'search';
      $this->aParams['utf8'] = '1';
      $this->aParams['srsearch'] = $params;
    } else {
      $page = 'Portugal';
      $this->aParams['prop'] = 'extracts';
      $this->aParams['titles'] = $page;
      $this->aParams['explaintext'] = '1';
    }
  }

  public function makeCall() {

    $ch = curl_init($this->url . '?' . http_build_query($this->aParams));
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

    $this->data = json_decode($response);
  }

  public function getData() {
    return $this->data;
  }

}
