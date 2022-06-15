<div>
    <form action="?controller=ItemController&method=save" method="post">
        <div>
            <div>
                <span>Adicionando um novo item</span>
            </div>
            <div>
            </div>
            <div>
                <label for="product_id">Produto:</label>
                <select name="product_id" id="product_id" required>
                    <?php
                    if ($products) {
                        foreach ($products as $product) {
                    ?>
                            <option value="<?= $product->getProductId(); ?>"><?php echo ($product->getProductName()); ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="item_qtd">Quantidade:</label>
                <input type="number" name="item_qtd" id="item_qtd" required />
            </div>
            <div>
                <input type="hidden" name="shoppingList_id" id="shoppingList_id" value="<?php echo($_REQUEST['shoppingList_id']); ?>"/>
                <input type="submit" value="Adicionar" />
                <input type="reset" value="Limpar" />
            </div>
        </div>
    </form>
    <div>
    <a href="?controller=ShoppingListController&method=list">Voltar</a>
    </div>
</div>