<?php

require 'app/models/Article.php';

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

    public function article() {
        $articles = $this->loadModel('ArticleModel')->getArticles();

        require 'app/views/home/article-list.php';
    }

    public function content() {
        // TODO remove selected article after debugging
        $selectedArticle = $this->loadModel('ArticleModel')->getSelectedArticle('Holzetui');
        $contents = $this->loadModel('ContentModel')->getContents();

        require 'app/views/home/content.php';
    }

    public function new_customer() {

        require 'app/views/home/new-customer.php';

    }
}
