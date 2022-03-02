<?php
session_start();
require_once "./engine/controllers/index.php"; // контроллер приложения
require_once "./engine/models/index.php"; // модель приложения
require_once "./engine/views/index.php"; //представление приложения
require_once "./engine/router.php"; //роутер
Router::start();
