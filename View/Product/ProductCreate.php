<h1>Produtos</h1>
<div>
    <form action="?controller=ProductController&method=save" method="post">
        <div>
            <div>
            </div>
            <div>
                <label for="name">Nome:</label>
                <input type="text" name="product_name" id="product_name" required />
            </div>
            <div>
                <input type="submit" value="Cadastrar" />
                <input type="reset" value="Limpar" />
            </div>
        </div>
    </form>
    <div>
        <a href="?controller=ProductController&method=list">Voltar</a>
    </div>
</div>