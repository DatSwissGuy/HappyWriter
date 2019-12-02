<?php

require 'app/models/Article.php';
require 'app/models/Content.php';

class ShopController extends Controller
{

    public function index() {

        $metadata = $this->loadModel('MetadataModel')->getMetadata();

        /** @var ArticleModel $articleModel */
        $articleModel = $this->loadModel('ArticleModel');
        $articles = $articleModel->getArticles();


        require 'app/views/home/index.php';
    }

    public function article() {
        $articles = $this->loadModel('ArticleModel')->getArticles();

        require 'app/views/shop/article.php';
    }

    public function content() {

        $selectedArticle = $this->loadModel('ArticleModel')->getArticleById($this->app->getParameter1());

        $contentsForArticle = $this->loadModel('ContentModel')->getContentsByConfiguration($this->app->getParameter1());

        require 'app/views/shop/content.php';
    }

    public function thankyou() {

        $this->loadModel('CustomerModel')->registerCustomer(
            $_POST['first-name'],
            $_POST['last-name'],
            $_POST['city'],
            $_POST['street'],
            $_POST['zipcode'],
            $_POST['telephone']
        );

        require 'app/views/shop/thankyou.php';
    }

    public function toCheckout() {
        $metadata = $this->loadModel('MetadataModel')->getMetadata();

        $articles = $this->loadModel('ArticleModel')->getArticles();

        $orderId = $this->loadModel('OrderModel')->create();

        $orderPos = $this->loadModel('OrderPositionModel')->create($_POST['article-id'], $orderId);

        function preg_grep_keys($pattern, $input) {
            $keys = preg_grep($pattern, array_keys($input));
            $values = [];
            foreach ($keys as $key) {
                $values[$key] = $input[$key];
            }
            return $values;
        }

        $filteredOrderContents = preg_grep_keys('/content-id/i', $_POST);
        
        $orderConfig = $this->loadModel('OrderConfigurationModel');

        foreach ($filteredOrderContents as $contentId) {
            $orderConfig->create($orderPos, $contentId);
        }

        require 'app/views/home/index.php';
    }

}
