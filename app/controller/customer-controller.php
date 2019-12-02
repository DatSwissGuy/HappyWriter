<?php

class CustomerController extends Controller

{

    public function new_customer() {
        require 'app/views/customer/new-customer.php';
    }

    public function verify_customer() {

        require 'app/models/Customer.php';
        $customer = new Customer;
        $customer->firstname = $_POST['first-name'];
        $customer->lastname = $_POST['last-name'];
        $customer->city = $_POST['city'];
        $customer->street = $_POST['street'];
        $customer->zipcode = $_POST['zipcode'];
        $customer->telephone = $_POST['telephone'];
        require 'app/views/customer/verify-customer.php';
    }


}