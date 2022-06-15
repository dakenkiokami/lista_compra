<h1>Relatório</h1>
<div class="container">

    <?php
    if ($reportList) { ?>

        <table>
            <thead>
                <tr class="titulo">
                    <th class="medium">Produto</th>
                    <th class="medium">Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($reportList as $report) {
                ?>

                    <tr>
                        <td><?php echo $report->product_name; ?></td>
                        <td><?php echo $report->qtd; ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4">Nenhuma lista encontrada dentro do período estabelecido</td>
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