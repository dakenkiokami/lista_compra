<?php

require_once(__DIR__ . '/../Config/Connection.php');

class Report
{
    public static function generateReport($initialDate, $finalDate)
    {

        $connection = Connection::connect();
        $reportList = [];

        $selectAll = "SELECT product_name, SUM(qtd) as qtd FROM item JOIN product ON fk_id_product = product_id JOIN shoppingList ON fk_id_shoppingList = shoppingList_id WHERE shoppingList_Date BETWEEN '{$initialDate}' AND '{$finalDate}' GROUP BY product_name;";
        $stmt = $connection->prepare($selectAll);
        if ($stmt->execute()) {
            while ($data = $stmt->fetchObject(Report::class)) {
                $reportList[] = $data;
            }
        }

        if (count($reportList) > 0)
            return $reportList;

        return false;
    }
}
