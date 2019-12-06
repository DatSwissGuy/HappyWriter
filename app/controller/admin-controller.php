<?php

require 'app/models/Content.php';

class AdminController extends Controller
{

    public function index() {
        if (!empty($_COOKIE['admin'])) {
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

        if ($username === 'admin' && $password === 'admin') {
            setcookie('admin', '$aSBoYXRlIHRoaXMgcHJvamVjdA==$', time() + 3599, '/', '', 0, 1);
            require 'app/views/admin/admin-panel.php';
        } else {
            header('Location: /admin');
        }
    }

    public function logout() {
        setcookie('admin', '$aSBoYXRlIHRoaXMgcHJvamVjdA==$', time() - 3600, '/');
        require 'app/views/admin/login.php';
    }

    public function add_content() {

        if (empty($_COOKIE['admin'])) {
            require 'app/views/admin/login.php';
            return;
        }

        if (!empty($_POST)) {
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

            $contentModel = $this->loadModel('ContentModel');
            $contentId = $contentModel->add($name, $description, $price, $icon);

            $configModel = $this->loadModel('ConfigurationModel');
            if (isset($_POST['article-id-1'])) {
                $article1 = htmlentities($_POST['article-id-1'], ENT_QUOTES, 'UTF-8');
                $configModel->add($article1, $contentId);
            }
            if (isset($_POST['article-id-2'])) {
                $article2 = htmlentities($_POST['article-id-2'], ENT_QUOTES, 'UTF-8');
                $configModel->add($article2, $contentId);
            }

            require 'app/views/admin/add-content.php';
            echo "<br><div class='container'><div class='alert alert-success'>Inhalt angelegt!</div></div>";
        } else {
            require 'app/views/admin/add-content.php';
        }

    }

    public function edit_contents() {
        if (empty($_COOKIE['admin'])) {
            require 'app/views/admin/login.php';
            return;
        }

        $contentModel = $this->loadModel('ContentModel');
        $contents = $contentModel->getContents();

        require 'app/views/admin/edit-contents.php';
    }

    public function edit_content() {
        if (empty($_COOKIE['admin'])) {
            require 'app/views/admin/login.php';
            return;
        }

        $contentId = $this->app->getParameter1();
        $contentModel = $this->loadModel('ContentModel');
        $content = $contentModel->getContentById($contentId)[0];

        $configModel = $this->loadModel('ConfigurationModel');
        $config = $configModel->getConfigByContentId($contentId);

        $isConfig1Checked = '';
        $isConfig2Checked = '';

        if (!empty($config[0])) {
            $isConfig1Checked = 'checked';
        }

        if (!empty($config[1])) {
            $isConfig2Checked = 'checked';
        }

        require 'app/views/admin/edit-content.php';
    }

    public function update_content() {
        if (empty($_COOKIE['admin'])) {
            require 'app/views/admin/login.php';
            return;
        }

        if (!empty($_POST)) {
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
            if (isset($_POST['content-id'])) {
                $contentId = htmlentities($_POST['content-id'], ENT_QUOTES, 'UTF-8');
            }

            $contentModel = $this->loadModel('ContentModel');
            $contentUpdate = $contentModel->updateById($contentId, $name, $description, $price, $icon);

            $configModel = $this->loadModel('ConfigurationModel');
            $configModel->delete($contentId);
            if (isset($_POST['article-id-1'])) {
                $article1 = htmlentities($_POST['article-id-1'], ENT_QUOTES, 'UTF-8');
                $configModel->add($article1, $contentId);
            }
            if (isset($_POST['article-id-2'])) {
                $article2 = htmlentities($_POST['article-id-2'], ENT_QUOTES, 'UTF-8');
                $configModel->add($article2, $contentId);
            }

            header('Location: /admin/edit_contents');
        } else {
            require 'app/views/admin/edit-content.php';
        }
    }

    public function delete_content() {
        if (empty($_COOKIE['admin'])) {
            require 'app/views/admin/login.php';
            return;
        }

        $contentId = $this->app->getParameter1();
        $contentModel = $this->loadModel('ContentModel');
        $contentModel->delete($contentId);

        header('Location: /admin/edit_contents');
    }

// TODO remove after debugging
    public
    function destroy_cookie() {
        setcookie('admin', '$aSBoYXRlIHRoaXMgcHJvamVjdA==$', time() - 3600, '/');
        if (empty($_COOKIE['admin'])) {
            echo "Admin cookie destroyed";
        }
    }

// TODO remove after debugging
    public
    function show_cookies() {
        var_dump($_COOKIE);
    }
}