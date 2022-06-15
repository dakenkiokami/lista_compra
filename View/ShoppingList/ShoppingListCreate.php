<div class="container">
    <form action="?controller=ShoppingListController&method=save" method="post">
        <h1>Lista de compras</h1>
        <div>
            <label for="shoppingList_title">Título:</label>
            <input type="text" name="shoppingList_title" id="shoppingList_title" required />

            <label for="shoppingList_date">Data:</label>
            <input type="date" name="shoppingList_date" id="shoppingList_date" required />

        </div>
        <div>

            <input type="submit" value="Cadastrar" />
            <input type="reset" value="Limpar" />

        </div>
    </form>
</div>
<div>
    <a href="?controller=ShoppingListController&method=list">Voltar</a>
</div>