<?php

class ControllerCart extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelCart;
    }

    function index()
    {
        $this->view->contentView = "cartView.php";
        if (isset($_SESSION["user"])) {
            $result = $this->model->getCart();
            $quantityTotal = 0;
            $sumTotal = 0;
            foreach ($result as $item) {
                $quantityTotal += $item["quantity"];
                $sumTotal += $item["total"];
            }
            return [
                "quantity" => $quantityTotal,
                "total" => $sumTotal,
                "cart" => $result
            ];
        } else {
            return ["error" => "Требуется аутентификация"];
        }
    }

    function add()
    {
        if (!isset($_SESSION["user"])) {
            header('Location: ' . $host . "/user");
        }
        $values = [
            "userId" => $_SESSION["user"]["id"],
            "productId" => $_POST["productId"],
            "quantity" => $_POST["quantity"] ? $_POST["quantity"] : 1,
            "color" => $_POST["color"],
            "size" => $_POST["size"]
        ];
        $this->view->contentView = "result.php";
        return $this->model->add($values);
    }

    function delete()
    {   $input = json_decode(file_get_contents("php://input"), true);
        if (isset($input["id"])) {
            return $this->model->delete($input["id"]);
        } else {
            return ["error" => "Не удалено"];
        }

    }
}
