<?php

class CustomerController extends Controller

{

    public function new_customer() {

        require 'app/models/Order.php';
        $order = new Order;
        $order->id = $this->app->getParameter1();

        require 'app/views/customer/new-customer.php';
    }

    public function verify_customer() {

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

        require 'app/models/Order.php';
        $order = new Order;
        $order->annotations = $annotations;
        $order->id = $orderId;

        require 'app/models/Customer.php';
        $customer = new Customer;
        $customer->firstname = $firstName;
        $customer->lastname = $lastName;
        $customer->city = $city;
        $customer->street = $street;
        $customer->zipcode = $zipcode;
        $customer->telephone = $telephone;

        require 'app/views/customer/verify-customer.php';
    }

}