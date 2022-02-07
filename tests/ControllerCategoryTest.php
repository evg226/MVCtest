<?php
//include_once "tests/AppTest.php";
include_once "engine/controllers/category.php";
include_once "engine/models/category.php";
use PHPUnit\Framework\TestCase;

class ControllerCategoryTest extends TestCase
{
    function testProductCreate()
    {
        $controller=new ControllerCategory();
        $result=$controller->index();
        print_r("\nList of categories: ");
        print_r($result);
        $this->assertSame(false,isset($result["error"]));
        $this->assertSame(true,isset($result[0]["id"]));
    }
}
