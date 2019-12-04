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

        $firstName = null;
        $lastName = null;
        $city = null;
        $street = null;
        $zipcode = null;
        $telephone = null;
        $orderId = null;

        if (isset($_POST['first-name'])) {
            $firstName = htmlentities($_POST['first-name'], ENT_QUOTES, 'UTF-8');
        }

        if (isset($_POST['last-name'])) {
            $lastName = htmlentities($_POST['last-name'], ENT_QUOTES, 'UTF-8');
        }

        if (isset($_POST['city'])) {
            $city = htmlentities($_POST['city'], ENT_QUOTES, 'UTF-8');
        }

        if (isset($_POST['street'])) {
            $street = htmlentities($_POST['street'], ENT_QUOTES, 'UTF-8');
        }

        if (isset($_POST['zipcode'])) {
            $zipcode = (int)htmlentities($_POST['zipcode'], ENT_QUOTES, 'UTF-8');
        }

        if (isset($_POST['telephone'])) {
            $telephone = htmlentities($_POST['telephone'], ENT_QUOTES, 'UTF-8');
        }

        if (isset($_POST['annotations'])) {
            $annotations = htmlentities($_POST['annotations'], ENT_QUOTES, 'UTF-8');
        }

        if (isset($_POST['order-id'])) {
            $orderId = (int)htmlentities($_POST['order-id'], ENT_QUOTES, 'UTF-8');
        }

        /** @var CustomerModel $customerModel */
        $customerModel = $this->loadModel('CustomerModel');
        $customerId = $customerModel->registerCustomer(
            $firstName,
            $lastName,
            $city,
            $street,
            $zipcode,
            $telephone
        );

        /** @var OrderModel $orderModel */
        $orderModel = $this->loadModel('OrderModel');
        $updateOrder = $orderModel->updateCurrentOrder($customerId, $orderId, $annotations);

        require 'app/views/shop/thankyou.php';
    }

    public function toCheckout() {
        /** @var MetadataModel $metadataModel */
        $metadataModel = $this->loadModel('MetadataModel');
        $metadata = $metadataModel->getMetadata();


        $articleId = (int)htmlentities($_POST['article-id'], ENT_QUOTES, 'UTF-8');
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
