<?php

class CustomerController extends Controller
{
    public function new_customer() {

        require 'app/views/customer/new-customer.php';

    }

    public function verify_customer() {

        $customer = $this->loadModel('Customer');

        require 'app/views/customer/verify-customer.php';

    }
}