<?php
class ControllerCatalog extends Controller {
    public function __construct()    {
        parent::__construct();
        $this->model=new ModelCatalog;
        $this->view->contentView="result.php";
    }

    function index (){
        if(isset($_GET["id"])){
            $this->view->contentView="productView.php";
            return $this->model->getById($_GET["id"]);
        } else {
            $this->view->contentView="catalogView.php";
            $startId=isset($_GET["startId"])?$_GET["startId"]:0;
            $limit=isset($_GET["limit"])?$_GET["limit"]:3;
            return $this->model->getData($startId,$limit);
        }
    }
    function getImages(){
        if(isset($_GET["productId"])){
            return $this->model->getImages($_GET["productId"]);
        }
    }

    function create():array{
        $user=$this->chechAuth();
        if (isset($user['error'])) return $user;
        if(!(isset($_POST["name"])&&
            isset($_POST["description"])&&
            isset($_POST["price"])&&
            isset($_POST["category_id"]))) return ["error"=>"Не хватает данных продукта"];
        $product=[
            "name"=>$_POST["name"],
            "description"=>$_POST["description"],
            "price"=>$_POST["price"],
            "category_id"=>$_POST["category_id"],
        ];
        $result=$this->model->create($product);
        return ["id"=>$result['id'],
            "result"=>"Изменен {$result['name']}",
            "redirectTo"=>"/admin/index/?entity=product"];

    }

    function update():array{
        $user=$this->chechAuth();
        if (isset($user['error'])) return $user;
        if(!isset($_POST["id"])) return ["error"=>"Не хватает данных продукта"];
        $product=["id"=>$_POST["id"]];
        if(isset($_POST["name"])) $product["name"]=$_POST["name"];
        if(isset($_POST["description"])) $product["description"]=$_POST["description"];
        if(isset($_POST["price"])) $product["price"]=$_POST["price"];
        if(isset($_POST["category_id"])) $product["category_id"]=$_POST["category_id"];
        $result=$this->model->update($product);
        return ["id"=>$result['id'],
            "result"=>"Изменен {$result['name']}",
            "redirectTo"=>"/admin/index/?entity=product"];
    }

    function delete():array{
        $user=$this->chechAuth();
        if (isset($user['error'])) return $user;
        if(!isset($_POST["id"])) return ["error"=>"Не хватает данных продукта"];
        return $this->model->delete($_POST['id']);
    }
}