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