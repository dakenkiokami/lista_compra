<?php

require_once(__DIR__ . '/Controller/ShoppingListController.php');
require_once(__DIR__ . '/Controller/ProductController.php');
require_once(__DIR__ . '/Controller/ItemController.php');
require_once(__DIR__ . '/Controller/ReportController.php');

?>
<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset="utf-8">
    <title>Teste Prático LXTec</title>
    <link rel="stylesheet" href="Assets/style.css">
</head>

<body>

    <?php
    if ($_GET) {
        $controller = isset($_GET['controller']) ? ((class_exists($_GET['controller'])) ? new $_GET['controller'] : NULL) : null;
        $method     = isset($_GET['method']) ? $_GET['method'] : null;
        if ($controller && $method) {
            if (method_exists($controller, $method)) {
                $parameters = $_GET;
                unset($parameters['controller']);
                unset($parameters['method']);
                call_user_func(array($controller, $method), $parameters);
            } else {
                echo "Método não encontrado!";
            }
        } else {
            echo "Controller não encontrado!";
        }
    } else {
        echo '<h1>Teste Prático LXTec</h1>';
        echo '<div><a href="?controller=ShoppingListController&method=list">Listas</a></div>';
        echo '<div><a href="?controller=ProductController&method=list">Produtos</a></div>';
        echo '<div><a href="?controller=ReportController&method=create">Relatório por data</a></div>';
    }
    ?>


</body>

</html>