<?php

class Application
{
    private $url_controller = null;

    private $url_action = null;

    private $url_parameter_1 = null;

    private $url_parameter_2 = null;

    private $url_parameter_3 = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        $this->splitUrl();

        if (file_exists('./app/controller/' . $this->url_controller . '.php')) {
            require './app/controller/' . $this->url_controller . '.php';
  
            $controller = str_replace(' ', '', ucwords(str_replace('-', ' ', $this->url_controller)));

            $this->url_controller = new $controller;

            if (method_exists($this->url_controller, $this->url_action)) {
                if (isset($this->url_parameter_3)) {
                    $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
                } else if (isset($this->url_parameter_2)) {
                    $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                } else if (isset($this->url_parameter_1)) {
                    $this->url_controller->{$this->url_action}($this->url_parameter_1);
                } else {
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                $this->url_controller->index();
            }
        } else {
            require './app/controller/home-controller.php';
            $home = new HomeController();
            $home->index();
        }
    }

    private function splitUrl()
    {
        if (isset($_GET['url'])) {
            $url = ltrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->url_controller = (isset($url[0]) ? $url[0] . '-controller' : null);
            $this->url_action = (isset($url[1]) ? $url[1] : null);
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);

            // for debugging. uncomment this
            echo 'Controller: ' .  str_replace(' ', '', ucwords(str_replace('-', ' ', $this->url_controller))) . '<br />';
            echo 'Action: ' . ($this->url_action ? $this->url_action : 'index') . '<br />';
            echo 'Parameter 1: ' . $this->url_parameter_1 . '<br />';
            echo 'Parameter 2: ' . $this->url_parameter_2 . '<br />';
            echo 'Parameter 3: ' . $this->url_parameter_3 . '<br />';
        }
    }
}
