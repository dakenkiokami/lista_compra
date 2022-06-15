<h1>Listas</h1>
<div class="container">
    <table>
        <thead>
            <tr class="titulo">
                <th class="small">ID</th>
                <th class="medium">Nome</th>
                <th class="medium">Data</th>
                <th class="none"><a href="?controller=ShoppingListController&method=create">Nova Lista</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($shoppingLists) {
                foreach ($shoppingLists as $shoppingList) {
            ?>
                    <tr>
                        <td><?php echo $shoppingList->getShoppingListId(); ?></td>
                        <td><?php echo $shoppingList->getShoppingListTitle(); ?></td>
                        <td><?php echo $shoppingList->formatDate(); ?></td>
                        <td class="button">
                            <a href="?controller=ShoppingListController&method=edit&shoppingList_id=<?php echo $shoppingList->getShoppingListId(); ?>">Editar</a>
                            <a href="?controller=ShoppingListController&method=delete&shoppingList_id=<?php echo $shoppingList->getShoppingListId(); ?>">Excluir</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4">Nenhum lista encontrada</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div>
    <a href="#" onclick="location.href='index.php'">Voltar</a>
</div>