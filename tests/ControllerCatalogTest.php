<?php
//include_once "tests/AppTest.php";
include_once "engine/controllers/catalog.php";
include_once "engine/models/catalog.php";
use PHPUnit\Framework\TestCase;

class ControllerCatalogTest extends TestCase{
    function testCatalog(){
        $controller=new ControllerCatalog();
        unset($_POST);
        $_POST["name"]="name";
        $_POST["description"]="description";
        $_POST["price"]=100;
        $_POST["category_id"]=1;
        $result=$controller->create();
        $id=$result["id"];
        print_r("\ncreated products.id=".$id);
        $this->assertSame(false,isset($result["error"]));
        $this->assertSame(true,$result["id"]>0);

        unset($_POST);
        $_POST["id"]=$id;
        $_POST["name"]="nameUPD";
        $_POST["description"]="descriptionUPD";
        $_POST["price"]=111;
        $_POST["category_id"]=2;
        $result=$controller->update();
        print_r("\nupdated product=");
        print_r($result);
        $this->assertSame(false,isset($result["error"]));
        $this->assertSame(true,$result["id"]==$id);

        unset($_POST);
        $_POST["id"]=$id;
        $_POST["name"]="nameUPD2";
        $result=$controller->update();
        print_r("\npart updated product=");
        print_r($result);
        $this->assertSame(false,isset($result["error"]));
        $this->assertSame(true,$result["id"]==$id);

        unset($_POST);
        $_POST["id"]=$id;
        $result=$controller->delete();
        print_r("\ndelete product=".$result["id"]);
        $this->assertSame(false,isset($result["error"]));
        $this->assertSame(true,$result["id"]==$id);

    }
}

