<?php

require_once('Controller.php');
require_once(__DIR__ . '/../Model/ShoppingList.php');
require_once(__DIR__ . '/../Model/Item.php');

class ShoppingListController extends Controller
{

    public function list()
    {
        $shoppingLists = ShoppingList::selectAll();
        return $this->view(__DIR__ . '/../View/ShoppingList/ShoppingListList', ['shoppingLists' => $shoppingLists]);
    }

    public function create()
    {
        return $this->view(__DIR__ . '/../View/ShoppingList/ShoppingListCreate');
    }

    public function edit($data)
    {
        $shoppingList_id = (int) $data['shoppingList_id'];
        $shoppingList = ShoppingList::selectById($shoppingList_id);
        return $this->view(__DIR__ . '/../View/ShoppingList/ShoppingListUpdate', ['shoppingList' => $shoppingList]);
    }

    public function save()
    {
        $shoppingList = new ShoppingList;
        $shoppingList->setShoppingListTitle($this->request->shoppingList_title);
        $shoppingList->setShoppingListDate($this->request->shoppingList_date);
        if ($shoppingList->saveList()) {
            return $this->list();
        }
    }

    public function update($data)
    {
        $shoppingList_id = (int) $data['shoppingList_id'];
        $shoppingList = ShoppingList::selectById($shoppingList_id);
        $shoppingList[0]->setShoppingListTitle($this->request->shoppingList_title);
        $shoppingList[0]->setShoppingListDate($this->request->shoppingList_date);
        $shoppingList[0]->saveList();

        for ($i = 1; $i < count($shoppingList); $i++) {

            $item = Item::selectById($shoppingList[$i]->getItemId());
            $item->setItemQtd($this->request->$i);
            $item->saveItem();
        }

        return $this->list();
    }

    public function delete($data)
    {
        $shoppingList_id = (int) $data['shoppingList_id'];
        
        $shoppingList = ShoppingList::selectById($shoppingList_id);
        $shoppingList[0]->setShoppingListTitle($this->request->shoppingList_title);
        $shoppingList[0]->setShoppingListDate($this->request->shoppingList_date);
        $shoppingList[0]->saveList();

        for ($i = 1; $i < count($shoppingList); $i++) {

            $item = Item::selectById($shoppingList[$i]->getItemId());
            $item->deleteItem($shoppingList[$i]->getItemId());
        }

        $shoppingList = ShoppingList::deleteList($shoppingList_id);

        return $this->list();
    }
}
