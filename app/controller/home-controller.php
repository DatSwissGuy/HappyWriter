<?php

class HomeController extends Controller
{

    public function index() 
    {
         $metadata = $this->loadModel('MetadataModel')->getMetadata();

         require 'app/views/home/index.php';
     }

    public function edit()
    {
         require 'app/views/home/edit.php';
    }

}
