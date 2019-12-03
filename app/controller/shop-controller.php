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
        $articleId = $_POST['article-id'];

        $metadata = $this->loadModel('MetadataModel')->getMetadata();

        $articleModel = $this->loadModel('ArticleModel');
        $articles = $articleModel->getArticles();

        $articlePrice = $articleModel->getArticleById($articleId);

        $order = $this->loadModel('OrderModel');
        $orderId = $order->create();

        $orderPos = $this->loadModel('OrderPositionModel')->create($articleId, $orderId);

        function preg_grep_keys($pattern, $input) {
            $keys = preg_grep($pattern, array_keys($input));
            $values = [];
            foreach ($keys as $key) {
                $values[$key] = $input[$key];
            }
            return $values;
        }
        $contentIds = preg_grep_keys('/content-id/i', $_POST);
        $orderConfig = $this->loadModel('OrderConfigurationModel');

        foreach ($contentIds as $contentId) {
            $orderConfig->create($orderPos, $contentId);
        }

        $items = $order->getOrderedContentsById($orderId);
        $sumItems = 0;

        require 'app/views/home/index.php';

        // price calculation prototype
        echo $articlePrice[0]->name.": <strong>".$articlePrice[0]->price."</strong><br>";
        foreach ($items as $item) {
            echo $item->name.": <strong>".$item->price."</strong><br>";

            $sumItems += $item->price;
        }

        echo "Summe: <strong>".number_format($sumItems+$articlePrice[0]->price, 2,'.', '')."</strong>";
    }

}
