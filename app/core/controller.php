<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
abstract class Controller
{
 
    public $db = null;

    /** @var Application */
    public $app = null;

    function __construct($app)
    {
        $this->app = $app;
        $this->openDatabaseConnection();
    }

    private function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
    }

    public function loadModel($model_name)
    {
        require 'app/models/' . strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $model_name)) . '.php';
        return new $model_name($this->db);
    }

}
