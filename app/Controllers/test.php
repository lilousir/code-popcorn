<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class test extends BaseController
{
 public function getindex(){

     return $this->view('test');
 }
}