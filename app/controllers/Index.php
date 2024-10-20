<?php

class Index extends Controller
{

  public function index()
  {
    $arrayName = array("Use Api From Official Authorize");
    http_response_code(401);
    $this->api($arrayName, true);
  }
}
