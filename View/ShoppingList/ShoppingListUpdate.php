<h1>Listas</h1>
<div class="container">
    <form action="?controller=ShoppingListController&method=update&shoppingList_id=<?php echo $shoppingList[0]->getShoppingListId(); ?>" method="post">
        <div>
            <div>
                <label for="shoppingList_title">Título:</label>
                <input type="text" name="shoppingList_title" id="shoppingList_title" value="<?php echo $shoppingList[0]->getShoppingListTitle() ?>" required />
                <label for="shoppingList_date">Data:</label>
                <input type="date" name="shoppingList_date" id="shoppingList_date" value="<?php echo $shoppingList[0]->getShoppingListDate() ?>" required />
            </div>

            <?php
            if (count($shoppingList) > 1) {
            ?>
                <div>
                    <h2>Itens</h2>
                </div>
                <table>
                    <thead>
                        <tr class="titulo">
                            <th class="small">ID</th>
                            <th class="medium">Nome</th>
                            <th class="small">Qtde</th>
                            <th class="none"><a href="?controller=ItemController&method=create&shoppingList_id=<?php echo $shoppingList[0]->getShoppingListId(); ?>">Adicionar Produto</a></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                }
                for ($i = 1; $i < count($shoppingList); $i++) {
                    ?>
                        <tr>
                            <td><?php echo $shoppingList[$i]->getItemID() ?></td>
                            <td><?php echo $shoppingList[$i]->product_name ?></td>
                            <td><input class="small" type="text" name="<?php echo $i ?>" id="<?php echo $i ?>" value="<?php echo $shoppingList[$i]->getItemQtd() ?>" required /></td>
                            <td class="button"><a href="?controller=ItemController&method=delete&item_id=<?php echo $shoppingList[$i]->getItemID(); ?>&shoppingList_id=<?php echo $shoppingList[0]->getShoppingListId(); ?>">Excluir</a></td>
                        </tr>
                    <?php
                }
                    ?>
                    </tbody>
                </table>
                <div>
                    <input type="submit" value="Editar" />
                    <input type="reset" value="Cancelar" />
                </div>
        </div>
    </form>

</div>
<div>
    <a href="?controller=ShoppingListController&method=list">Voltar</a>
</div>