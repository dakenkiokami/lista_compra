<h1>Relatório</h1>
<div class="container">

    <?php
    if ($reportList) {
        foreach ($reportList as $report) {
    ?>
            <table>
                <thead>
                    <tr class="titulo">
                        <th class="medium">Produto</th>
                        <th class="medium">Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $report->product_name; ?></td>
                        <td><?php echo $report->qtd; ?></td>
                    </tr>
                <?php
            }
        } else {
                ?>
                <tr>
                    <td colspan="4">Nenhum lista encontrada dentro do período estabelecido</td>
                </tr>
            <?php
        }
            ?>
                </tbody>
            </table>
</div>
<div>
    <a href="?controller=ReportController&method=create">Voltar</a>
</div>