<?php

require_once(__DIR__ . '/../Config/Connection.php');

class Item
{

    private int $item_id;
    private int $product_id;
    private int $shoppingList_id;
    private float $qtd;

    public function __construct()
    {
    }

    public function getItemId(): int
    {
        return $this->item_id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getShoppingListId(): int
    {
        return $this->shoppingList_id;
    }

    public function getItemQtd(): float
    {
        return $this->qtd;
    }

    public function setItemId(int $item_id)
    {
        $this->item_id = $item_id;
    }

    public function setProductId(int $product_id)
    {
        $this->product_id = $product_id;
    }

    public function setShoppingListId(int $shoppingList_id)
    {
        $this->shoppingList_id = $shoppingList_id;
    }

    public function setItemQtd(int $qtd)
    {
        $this->qtd = $qtd;
    }

    public function saveItem()
    {

        if (!isset($this->item_id)) {
            $command = "INSERT INTO item (qtd, fk_id_product, fk_id_shoppingList) VALUES (:qtd, :fk_id_product, :fk_id_shoppingList);";
        } else {
            $command = "UPDATE item SET qtd = (:qtd) WHERE item_id = (:item_id);";
        }

        if ($connection = Connection::connect()) {
            $stmt = $connection->prepare($command);
            $stmt->bindValue(':qtd', $this->getItemQtd());

            if (!isset($this->item_id)) {
                $stmt->bindValue(':fk_id_product', $this->getProductId());
                $stmt->bindValue(':fk_id_shoppingList', $this->getShoppingListId());
                $this->setItemId($connection->lastInsertId());
            } else
                $stmt->bindValue(':item_id', $this->getItemId());
            $sucess = $stmt->execute();
        }

        return $sucess;
    }

    public static function selectAll($shoppingList_id)
    {

        $connection = Connection::connect();
        $itemList = [];

        $selectAll = "SELECT * from item WHERE fk_id_shoppingList = '{$shoppingList_id}';";
        $stmt = $connection->prepare($selectAll);
        if ($stmt->execute()) {
            while ($data = $stmt->fetchObject(Item::class)) {
                $itemList[] = $data;
            }
        }

        if (count($itemList) > 0)
            return $itemList;

        return false;
    }

    public static function selectById($id)
    {

        $connection = Connection::connect();

        $select = "SELECT * from item WHERE item_id='{$id}';";
        $stmt = $connection->prepare($select);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $item = $stmt->fetchObject('Item');
                if ($item) {
                    return $item;
                }
            }
        }

        return false;
    }

    public static function deleteItem($id)
    {
        $connection = Connection::connect();
        if ($connection->exec("DELETE FROM item WHERE item_id='{$id}';")) {
            return true;
        }
        return false;
    }
}
