<?php

class AdminController extends Controller
{

    public function index() {
        if(!empty($_COOKIE['admin'])) {
            require 'app/views/admin/admin-panel.php';
        } else {
            require 'app/views/admin/login.php';
        }
    }

    public function admin_panel() {
        session_start();
        $username = null;
        $password = null;

        if (isset($_POST['username'])) {
            $username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
        }

        if (isset($_POST['password'])) {
            $password = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');
        }

        if($username === 'admin' && $password === 'admin') {
            setcookie('admin','$aSBoYXRlIHRoaXMgcHJvamVjdA==$', time() + 3599, '/', '', 0, 1);
            require 'app/views/admin/admin-panel.php';
        } else {
            header('Location: /admin');
        }
    }

    public function logout() {
        setcookie('admin','$aSBoYXRlIHRoaXMgcHJvamVjdA==$', time() - 3600, '/');
        require 'app/views/admin/login.php';
    }

    public function edit_articles() {
        if(!empty($_COOKIE['admin'])) {
            require 'app/views/admin/edit-articles.php';
        } else {
            require 'app/views/admin/login.php';
        }
    }

    public function edit_contents() {
        if(!empty($_COOKIE['admin'])) {
            require 'app/views/admin/edit-contents.php';
        } else {
            require 'app/views/admin/login.php';
        }
    }

    public function add_content() {

        var_dump($_POST);
        $name = null;
        $description = null;
        $price = null;
        $icon = null;
        $article1 = null;
        $article2 = null;
        $articleId = null;
        $contentId = null;

        if (isset($_POST['name'])) {
            $name = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['description'])) {
            $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['price'])) {
            $price = (float)htmlentities($_POST['price'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['icon'])) {
            $icon = htmlentities($_POST['icon'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['article-1'])) {
            $article1 = htmlentities($_POST['article-1'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['article-2'])) {
            $article2 = htmlentities($_POST['article-2'], ENT_QUOTES, 'UTF-8');
        }

        //$this->loadModel('ConfigurationModel')->add($articleId, $contentId);

        $this->loadModel('ContentModel')->add($name, $description, $price, $icon);
        require 'app/views/admin/edit-contents.php';
        echo "<br><div class='container'><div class='alert alert-success'>Inhalt angelegt!</div></div>";
    }

    public function add_article() {

        $name = null;
        $description = null;
        $price = null;
        $icon = null;

        if (isset($_POST['name'])) {
            $name = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['description'])) {
            $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['price'])) {
            $price = (float)htmlentities($_POST['price'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['icon'])) {
            $icon = htmlentities($_POST['icon'], ENT_QUOTES, 'UTF-8');
        }

        $this->loadModel('ArticleModel')->add($name, $description, $price, $icon);

        require 'app/views/admin/edit-articles.php';
        echo "<br><div class='container'><div class='alert alert-success'>Artikel angelegt!</div></div>";
    }

    // TODO remove after debugging
    public function destroy_cookie() {
        setcookie('admin','$aSBoYXRlIHRoaXMgcHJvamVjdA==$', time() - 3600, '/');
        if (empty($_COOKIE['admin'])) {
            echo "Admin cookie destroyed";
        }
    }
    // TODO remove after debugging
    public function show_cookies() {
        var_dump($_COOKIE);
    }
}