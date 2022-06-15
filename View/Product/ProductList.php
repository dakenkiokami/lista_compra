<h1>Produtos</h1>
<div class="container">
    <table>
        <thead>
            <tr class="titulo">
                <th class="small">ID</th>
                <th class="medium">Nome</th>
                <th class="none"><a href="?controller=ProductController&method=create">Novo Produto</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($products) {
                foreach ($products as $product) {
            ?>
                    <tr>
                        <td><?php echo $product->getProductId(); ?></td>
                        <td><?php echo $product->getProductName(); ?></td>
                        <td class="button">
                            <a href="?controller=ProductController&method=edit&product_id=<?php echo $product->getProductId(); ?>">Editar</a>
                            <a href="?controller=ProductController&method=delete&product_id=<?php echo $product->getProductId(); ?>">Excluir</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4">Nenhum produto encontrada</td>
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