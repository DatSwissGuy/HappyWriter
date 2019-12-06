<?php

require 'app/models/Article.php';
require 'app/models/Content.php';

class ShopController extends Controller
{

    public function index() {
        session_start();
        /** @var MetadataModel $metadataModel */
        $metadataModel = $this->loadModel('MetadataModel');
        $metadata = $metadataModel->getMetadata();

        /** @var ArticleModel $articleModel */
        $articleModel = $this->loadModel('ArticleModel');
        $articles = $articleModel->getArticles();

        $orderId = null;
        require 'app/views/home/index.php';
    }

    public function content() {
        session_start();
        $urlParam = $this->app->getParameter1();

        if (!empty($urlParam < 3 && $urlParam > 0 )) {
            /** @var ArticleModel $articleModel */
            $articleModel = $this->loadModel('ArticleModel');
            $selectedArticle = $articleModel->getArticleById($urlParam);

            /** @var ContentModel $contentModel */
            $contentModel = $this->loadModel('ContentModel');
            $contentsForArticle = $contentModel->getContentsByConfiguration($urlParam);

            require 'app/views/shop/content.php';
        } else {
            header('Location: /');
        }
    }

    public function order_complete() {
        session_start();

        if (empty($_POST['order-id'])) {
            header('Location: /');
        }

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
        require 'app/views/shop/order-complete.php';
    }

    public function order_summary() {
        session_start();

        /** @var MetadataModel $metadataModel */
        $metadataModel = $this->loadModel('MetadataModel');
        $metadata = $metadataModel->getMetadata();

        if (!empty($_POST['article-id'])) {
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
            $orderPos = $orderPosModel->create($articleId, $orderId);

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
            /** @var OrderModel $orderContents */
            $orderContents = $orderModel->getOrderedContentsById($orderId);
            $sumContents = 0;
            require 'app/views/home/index.php';
        } else {
            header('Location: /');
        }
    }

    public function abort() {
        session_start();
        if (isset($_POST['order-id'])) {
            $orderId = htmlentities($_POST['order-id'], ENT_QUOTES, 'UTF-8');
        }
        /** @var OrderModel $orderContents */
        $orderModel = $this->loadModel('OrderModel');
        $deleteOrder = $orderModel->delete($orderId);
        session_destroy();
        header('Location: /');
    }

}
