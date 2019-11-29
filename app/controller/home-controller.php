<?php

require 'app/models/Article.php';
require 'app/models/Content.php';

class HomeController extends Controller
{

    public function index() {
        // load models first
        $metadata = $this->loadModel('MetadataModel')->getMetadata();
        $articles = $this->loadModel('ArticleModel')->getArticles();

        // the view to load
        require 'app/views/home/index.php';
    }

    public function edit() {
        require 'app/views/home/edit.php';
    }


    public function thankyou() {

        $order = $this->loadModel('Order');
        $customer = $this->loadModel('Customer');

        require 'app/views/home/thankyou.php';
    }
}
