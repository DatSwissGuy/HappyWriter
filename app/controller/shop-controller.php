<?php

require 'app/models/Article.php';
require 'app/models/Content.php';

class ShopController extends Controller
{

    public function index() {
        /** @var MetadataModel $metadataModel */
        $metadataModel = $this->loadModel('MetadataModel');
        $metadata = $metadataModel->getMetadata();

        /** @var ArticleModel $articleModel */
        $articleModel = $this->loadModel('ArticleModel');
        $articles = $articleModel->getArticles();

        // Initialize order on first call of page
        $orderId = null;

        require 'app/views/home/index.php';
    }

    public function article() {
        /** @var ArticleModel $articleModel */
        $articleModel = $this->loadModel('ArticleModel');
        $articles = $articleModel->loadModel('ArticleModel')->getArticles();

        require 'app/views/shop/article.php';
    }

    public function content() {
        /** @var ArticleModel $articleModel */
        $articleModel = $this->loadModel('ArticleModel');
        $selectedArticle = $articleModel->getArticleById($this->app->getParameter1());

        $contentModel = $this->loadModel('ContentModel');
        $contentsForArticle = $contentModel->getContentsByConfiguration($this->app->getParameter1());

        require 'app/views/shop/content.php';
    }

    public function thankyou() {
        $customerModel = $this->loadModel('CustomerModel');
        $customerId = $customerModel->registerCustomer(
            $_POST['first-name'],
            $_POST['last-name'],
            $_POST['city'],
            $_POST['street'],
            $_POST['zipcode'],
            $_POST['telephone']
        );

        $orderModel = $this->loadModel('OrderModel');
        $updateOrder = $orderModel->updateCurrentOrder($customerId, $_POST['order-id'], $_POST['annotations']);

        require 'app/views/shop/thankyou.php';
    }

    public function toCheckout() {
        /** @var MetadataModel $metadataModel */
        $metadataModel = $this->loadModel('MetadataModel');
        $metadata = $metadataModel->getMetadata();

        $articleId = $_POST['article-id'];
        /** @var ArticleModel $articleModel */
        $articleModel = $this->loadModel('ArticleModel');
        $articles = $articleModel->getArticles();
        $articleById = $articleModel->getArticleById($articleId);

        /** @var OrderModel $orderModel */
        $orderModel = $this->loadModel('OrderModel');
        $orderId = $orderModel->create();

        /** @var OrderPositionModel $orderPosModel */
        $orderPosModel = $this->loadModel('OrderPositionModel');
        $orderPos= $orderPosModel->create($articleId, $orderId);

        // TODO move function to a better place
        function preg_grep_keys($pattern, $input) {
            $keys = preg_grep($pattern, array_keys($input));
            $values = [];
            foreach ($keys as $key) {
                $values[$key] = $input[$key];
            }
            return $values;
        }

        $contentIds = preg_grep_keys('/content-id/i', $_POST);

        /** @var OrderConfigurationModel $orderConfigModel */
        $orderConfigModel = $this->loadModel('OrderConfigurationModel');

        foreach ($contentIds as $contentId) {
            $orderConfigModel->create($orderPos, $contentId);
        }

        $orderContents = $orderModel->getOrderedContentsById($orderId);
        $sumContents = 0;

        require 'app/views/home/index.php';

        // TODO move some parts to view
        echo $articleById[0]->name.": <strong>".$articleById[0]->price."</strong><br>";
        foreach ($orderContents as $orderContent) {
            echo $orderContent->name.": <strong>".$orderContent->price."</strong><br>";

            $sumContents += $orderContent->price;
        }

        echo "Summe: <strong>".number_format($sumContents+$articleById[0]->price, 2,'.', '')."</strong>";
    }

}
