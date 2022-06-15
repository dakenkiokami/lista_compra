<h1>Relatórios</h1>
<div class="container">
    <form action="?controller=ReportController&method=report" method="post">
        <div>
            <div>
            </div>
            <div>
                <label for="initialDate">Data inicial:</label>
                <input type="date" name="initialDate" id="initialDate" required />
            </div>
            <div>
                <label for="finalDate">Data final:</label>
                <input type="date" name="finalDate" id="finalDate" required />
            </div>
            <div>
                <input type="submit" value="Gerar relatório" />
                <input type="reset" value="Limpar" />
            </div>
        </div>
    </form>
</div>
<div>
    <a href="#" onclick="location.href='index.php'">Voltar</a>
</div>