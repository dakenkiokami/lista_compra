<h1>Produtos</h1>
<div class="container">
    <form action="?controller=ProductController&method=update&product_id=<?php echo $product->getProductId(); ?>" method="post">
        <div>
            <div>
            </div>
            <div>
                <label for="name">Nome:</label>
                <input type="text" name="product_name" id="product_name" value="<?php echo $product->getProductName() ?>" required />
            </div>
            <div>
                <input type="submit" value="Editar" />
                <input type="reset" value="Cancelar" />
            </div>
        </div>
    </form>
</div>
<div>
    <a href="?controller=ProductController&method=list">Voltar</a>
</div>