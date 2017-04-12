<?php

class App
{
    public $request;

    public function __construct($request)
    {
        session_start();

            $this->request = explode('/', $request);
        $this->checkRequest();
    }

    private function checkRequest()
    {
        $url = array_shift($this->request);
        $url = ucfirst($url);
        if (file_exists(ROOT . '/controllers/' . $url . 'Controller.php')) {
            $this->runController($url);
        } else {

            $this->runController('Index');
        }
    }

    private function runController($ctrl_name)
    {
        require_once ROOT . "/controllers/" . "$ctrl_name" . "Controller.php";
        new \Database();
        $controller = "Controllers\\" . $ctrl_name . "Controller";


        $ctrl = new $controller();
        if (count($this->request) == 0) {
            $ctrl->actionIndex();
        } else {
            $method = 'action' . array_shift($this->request);
            if (method_exists($ctrl, $method)) {
                if (empty($this->request))
                    $ctrl->$method();
                else
                    call_user_func_array(array($ctrl, $method), $this->request);
            } else
                echo "Error 404";
        }
    }


}
