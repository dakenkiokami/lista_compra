<?php

require_once(__DIR__ . '/../Model/Item.php');
require_once(__DIR__ . '/../Model/Product.php');
require_once(__DIR__ . '/../Model/ShoppingList.php');

class ItemController extends Controller
{

    public function list($shoppingList_id)
    {
        $shoppingList = ShoppingList::selectById($shoppingList_id);
        return $this->view(__DIR__ . '/../View/ShoppingList/ShoppingListUpdate', ['shoppingList' => $shoppingList]);
    }

    public function create()
    {
        $products = Product::selectAll();
        return $this->view(__DIR__ . '/../View/Item/ItemCreate', ['products' => $products]);
    }

    public function edit($data)
    {
        $item_id = (int) $data['item_id'];
        $item = Item::selectById($item_id);

        return $this->view(__DIR__ . '/../View/Item/ItemUpdate', ['item' => $item]);
    }

    public function save()
    {
        $item = new Item;
        $item->setShoppingListId($this->request->shoppingList_id);
        $item->setProductId($this->request->product_id);
        $item->setItemQtd($this->request->item_qtd);

        if ($item->saveItem()) {
            return $this->list($this->request->shoppingList_id);
        }
    }

    public function update($data)
    {
        $item_id = (int) $data['item_id'];
        $item = Item::selectById($item_id);
        $item->setItemName($this->request->item_name);
        $item->saveItem();

        return $this->list($this->request->shoppingList_id);
    }

    public function delete($data)
    {
        $item_id = (int) $data['item_id'];
        $item = Item::deleteItem($item_id);

        return $this->list($this->request->shoppingList_id);
    }
}
