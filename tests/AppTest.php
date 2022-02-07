<?php
session_start();
require_once "./engine/controllers/index.php"; // контроллер приложения
require_once "./engine/models/index.php"; // модель приложения
require_once "./engine/views/index.php"; //представление приложения
require_once "tests/ControllerUserTest.php";
require_once "tests/ControllerAdminTest.php";
require_once "tests/ControllerCatalogTest.php";
require_once "tests/ControllerCategoryTest.php";
use PHPUnit\Framework\TestSuite;


class AppTest extends TestSuite {
    protected $sharedFixture;
    public static function suite()
    {
        $suite = new AppTest('AppSuite');
        $suite->addTestSuite('ControllerUserTest');
        $suite->addTestSuite('ControllerAdminTest');
        $suite->addTestSuite('ControllerCatalogTest');
        $suite->addTestSuite('ControllerCategoryTest');
        return $suite;
    }
    protected function setUp()
    {
//        $this->sharedFixture = new ControllerUser();
    }
    protected function tearDown()
    {
        $this->sharedFixture = NULL;
    }
}