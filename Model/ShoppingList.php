<?php

require_once(__DIR__ . '/../Config/Connection.php');

class ShoppingList
{

    private int $shoppingList_id;
    private string $shoppingList_title;
    private string $shoppingList_date;

    public function __construct()
    {
    }

    public function getShoppingListId(): int
    {
        return $this->shoppingList_id;
    }

    public function getShoppingListTitle(): string
    {
        return $this->shoppingList_title;
    }

    public function getShoppingListDate(): string
    {
        return $this->shoppingList_date;
    }

    public function setShoppingListId(int $shoppingList_id)
    {
        $this->shoppingList_id = $shoppingList_id;
    }

    public function setShoppingListTitle(string $shoppingList_title)
    {
        $this->shoppingList_title = $shoppingList_title;
    }

    public function setShoppingListDate(string $shoppingList_date)
    {
        $this->shoppingList_date = $shoppingList_date;
    }

    public function formatDate()
    {

        $date = $this->getShoppingListDate();
        $array = explode("-", $date);
        $date = $array[2] . "/" . $array[1] . "/" . $array[0];

        return $date;
    }

    public function saveList()
    {
        if (!isset($this->shoppingList_id)) {
            $command = "INSERT INTO shoppingList (shoppingList_title, shoppingList_date) VALUES (:shoppingList_title, :shoppingList_date);";
        } else {
            $command = "UPDATE shoppingList SET shoppingList_title = (:shoppingList_title), shoppingList_date = (:shoppingList_date)
                WHERE shoppingList_id = (:shoppingList_id);";
        }

        if ($connection = Connection::connect()) {
            $stmt = $connection->prepare($command);
            $stmt->bindValue(':shoppingList_title', $this->getShoppingListTitle(), PDO::PARAM_STR);
            $stmt->bindValue(':shoppingList_date', $this->getShoppingListDate(), PDO::PARAM_STR);
            if (!isset($this->shoppingList_id))
                $this->setShoppingListId($connection->lastInsertId());
            else
                $stmt->bindValue(':shoppingList_id', $this->getShoppingListId(), PDO::PARAM_INT);
            $sucess = $stmt->execute();
        }

        return $sucess;
    }

    public static function selectAll()
    {

        $connection = Connection::connect();
        $ShoppingListList = [];

        $selectAll = "SELECT * from shoppingList ORDER BY shoppingList_date;";
        $stmt = $connection->prepare($selectAll);
        if ($stmt->execute()) {
            while ($data = $stmt->fetchObject(ShoppingList::class)) {
                $ShoppingListList[] = $data;
            }
        }

        if (count($ShoppingListList) > 0)
            return $ShoppingListList;

        return false;
    }

    public static function selectById($id)
    {

        $connection = Connection::connect();
        $shoppingList = [];
        $i = 0;

        $select = "SELECT * from shoppingList WHERE shoppingList_id='{$id}';";
        $stmt = $connection->prepare($select);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {

                $shoppingList[$i++] = $stmt->fetchObject(ShoppingList::class);

                $select = "SELECT * from item INNER JOIN product ON fk_id_product = product_id WHERE fk_id_shoppingList ='{$id}';";
                $stmt = $connection->prepare($select);
                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {

                        while ($data = $stmt->fetchObject(Item::class)) {
                            $shoppingList[$i++] = $data;
                        }
                    }
                }

                if ($shoppingList) {
                    return $shoppingList;
                }

                return false;
            }
        }
    }

    public static function selectByDate($initialDate, $finalDate)
    {

        $connection = Connection::connect();
        $ShoppingListList = [];

        $selectAll = "SELECT * from shoppingList WHERE shoppingList_date BETWEEN '{$initialDate}' AND '{$finalDate}';";
        $stmt = $connection->prepare($selectAll);
        if ($stmt->execute()) {
            while ($data = $stmt->fetchObject(ShoppingList::class)) {
                $ShoppingListList[] = $data;
            }
        }

        if (count($ShoppingListList) > 0)
            return $ShoppingListList;

        return false;
    }

    public static function deleteList($id)
    {
        $connection = Connection::connect();
        if ($connection->exec("DELETE FROM shoppingList WHERE shoppingList_id='{$id}';")) {
            return true;
        }
        return false;
    }
}
