<?php

class AdminController extends Controller
{

    public function index() {
        require 'app/views/admin/login.php';
    }

    public function admin_panel() {
        $username = null;
        $password = null;

        if (isset($_POST['username'])) {
            $username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
        }

        if (isset($_POST['password'])) {
            $password = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');
        }

        if($username === 'admin' && $password === 'admin') {
            setcookie('admin','$aSBoYXRlIHRoaXMgcHJvamVjdA==$', time() + 3599, '/');
            require 'app/views/admin/admin-panel.php';
        } else {
            require 'app/views/admin/login.php';

        }
    }

    public function admin_edit_articles() {

    }

    public function admin_edit_contents() {

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