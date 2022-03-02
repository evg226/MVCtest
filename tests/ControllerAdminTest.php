<?php
//include_once "tests/AppTest.php";
include_once "engine/controllers/admin.php";
include_once "engine/models/admin.php";
use PHPUnit\Framework\TestCase;

class ControllerAdminTest extends TestCase{
    function testAdminIndex()
    {
        $admin = new ControllerAdmin();
        $_POST=[];
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        $result=$admin->index();
        $this->assertSame("Требуется аутентификация ADMIN",$result["error"]);
        $_SESSION['user']=["role"=>"USER"];
        $result=$admin->index();
        $this->assertSame("Требуется аутентификация ADMIN",$result["error"]);

        $_SESSION['user']=["role"=>"ADMIN"];
        $result=$admin->index();
        $this->assertSame(false,isset($result["error"]));

        $_GET['entity']='product';
        $result=$admin->index();
        $this->assertSame(false,isset($result["error"]));
    }
}
