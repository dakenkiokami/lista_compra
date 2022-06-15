<?php

require_once(__DIR__ . '/../Config/Connection.php');

class Product
{

    private int $product_id;
    private string $product_name;

    public function __construct()
    {
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getProductName(): string
    {
        return $this->product_name;
    }

    public function setProductId(int $product_id)
    {
        $this->product_name = $product_id;
    }

    public function setProductName(string $product_name)
    {
        $this->product_name = $product_name;
    }

    public function saveProduct()
    {

        if (!isset($this->product_id)) {
            $command = "INSERT INTO product (product_name) VALUES (:product_name);";
        } else {
            $command = "UPDATE product SET product_name = (:product_name) WHERE product_id = (:product_id);";
        }

        if ($connection = Connection::connect()) {
            $stmt = $connection->prepare($command);
            $stmt->bindValue(':product_name', $this->getProductName(), PDO::PARAM_STR);
            if (!isset($this->product_id))
                $this->setProductId($connection->lastInsertId());
            else
                $stmt->bindValue(':product_id', $this->getProductId(), PDO::PARAM_INT);
            $sucess = $stmt->execute();
        }

        return $sucess;
    }

    public static function selectAll()
    {

        $connection = Connection::connect();
        $productList = [];

        $selectAll = "SELECT * from product;";
        $stmt = $connection->prepare($selectAll);
        if ($stmt->execute()) {
            while ($data = $stmt->fetchObject(Product::class)) {
                $productList[] = $data;
            }
        }

        if (count($productList) > 0)
            return $productList;

        return false;
    }

    public static function selectById($id)
    {

        $connection = Connection::connect();

        $select = "SELECT * from product WHERE product_id='{$id}';";
        $stmt = $connection->prepare($select);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $product = $stmt->fetchObject('Product');
                if ($product) {
                    return $product;
                }
            }
        }

        return false;
    }

    public static function deleteProduct($id)
    {
        $connection = Connection::connect();
        if ($connection->exec("DELETE FROM product WHERE product_id='{$id}';")) {
            return true;
        }
        return false;
    }
}
