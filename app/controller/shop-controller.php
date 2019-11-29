<?php

require 'app/models/Article.php';
require 'app/models/Content.php';

class ShopController extends Controller
{

   public function article() {
        $articles = $this->loadModel('ArticleModel')->getArticles();

        require 'app/views/shop/article.php';
    }

    public function content() {
        // TODO remove selected article after debugging
        $selectedArticle = $this->loadModel('ArticleModel')->getSelectedArticle('Holzetui');

        $contents = $this->loadModel('ContentModel')->getContents();

        require 'app/views/shop/content.php';
    }

}
