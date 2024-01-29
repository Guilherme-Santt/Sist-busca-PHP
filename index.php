<?php
include('conexao.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Busca</title>
</head>
<link rel="stylesheet" href="./css/style.css">
<body>
    <div class="header-body">
        <h1>Lista de Veículos</h1>
        <p>Digite o veículo ou modelo desejado no campo de pesquisa</p>
    </div>

    <div class="form-body">
        <form action="">
            <input  name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite os termos de pesquisa" type="text">
            <button class="btn-submit" type="submit">Pesquisar</button>
        </form>
        <br>
        <table width="600px">
            <tr>
                <th>Marca</th>
                <th>Veículo</th>
            </tr>
            <?php
            if (!isset($_GET['busca'])) {
                ?>
            <tr>
                <td colspan="3">Digite algo para pesquisar...</td>
            </tr>
            <?php
            } else {
                $pesquisa = $mysqli->real_escape_string($_GET['busca']);
                $sql_code = "SELECT * 
                    FROM veiculo 
                    WHERE fabricante LIKE '%$pesquisa%' 
                    OR veiculo LIKE '%$pesquisa%'";
                $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
                
                if ($sql_query->num_rows == 0) {
                    ?>
                <tr>
                    <td colspan="3">Nenhum resultado encontrado...</td>
                </tr>
                <?php
                } else {
                    while($dados = $sql_query->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $dados['veiculo']; ?></td>
                            <td><?php echo $dados['modelo']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            <?php
            } ?>
        </table>
    </div>
</body>
</html>