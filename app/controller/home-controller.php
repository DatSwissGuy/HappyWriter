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

    public function listArticle()
    {
        $articles = $this->loadModel('ArticleModel')->getArticles();

        require 'app/views/home/article-list.php';
    }

    public function listContent()
    {
        $contents = $this->loadModel('ContentModel')->getContents();

        require 'app/views/home/content-list.php';
    }
}
