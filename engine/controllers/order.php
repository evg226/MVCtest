<?php

class ControllerOrder extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelOrder;
    }

    function index(){
        $this->view->contentView = "404View.php";
        if (isset($_SESSION["user"])) {
            return $this->model->getOrders();
        } else {
            return ["error" => "Требуется аутентификация"];
        }
    }

    function buy():array{
        $this->view->contentView = "result.php";
        if (!isset($_SESSION["user"]["id"])) return ["error"=>"Необходимо авторизоваться"];
        if (!isset($_POST["address"])||!$_POST["address"]) return ["error"=>"Требуется Ваш адрес"];
        $userId=$_SESSION["user"]["id"];
        $address=$_POST["address"];
        $response=$this->model->buy($userId,$address);
        if (!isset($response['error'])) $response["result"]="Товары заказаны. Следите за статусом на странице заказов";
        $response["redirectTo"]="/user";
        return $response;
    }

    function update(){
        if (isset($_SESSION["user"]["id"])) {
            if($_SESSION["user"]["role"]==="ADMIN")
                $status="sent";
            else
                $status="cancelled";
            $input = json_decode(file_get_contents("php://input"), true);
            return $this->model->update($input["id"],$status);
        }  else {
            return ["error"=>"Необходимо авторизоваться"];
        }
    }
}
