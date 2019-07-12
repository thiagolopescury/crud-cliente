<?php require_once("layout/header.php") ?>
<?php

require_once("DAO/conexao.php");
require_once("DAO/clienteDAO.php");
require_once("DAO/enderecoDAO.php");

$idCliente = $_GET['id'];

$clienteDAO = new ClienteDAO($con);
$cliente = $clienteDAO->recuperarPorId($idCliente);


$enderecoDAO = new EnderecoDAO($con);
$enderecos = $enderecoDAO->recuperarPorCliente($idCliente);

?>
<h1> Detalhe do Cliente </h1>
<form>
    <div class="form-group">
        <label><strong>Nome</strong></label>
        <br><?php echo $cliente->nome ; ?>
    </div>
    <div class="form-group">
        <label><strong>Email</strong></label>
        <br> <?php echo $cliente->email ; ?>
    </div>
    <div class="form-group">
        <label><strong>Telefone</strong></label>
        <br> <?php echo $cliente->telefone ; ?>
    </div>

</form>
<h2> Endereços </h2>
<table class="table table-striped table-hover">

    <thead class="thead-dark">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Logradouro</th>
            <th scope="col">Numero</th>
            <th scope="col">CEP</th>
            <th scope="col">Bairro</th>
            <th scope="col">Cidade</th>
            <th scope="col">UF</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($enderecos as $endereco) {
            echo "<tr>" ;
            echo "<td>" . $endereco->nome . "</td>";
            echo "<td>" . $endereco->logradouro . "</td>";
            echo "<td>" . $endereco->numero . "</td>";
            echo "<td>" . $endereco->cep . "</td>";
            echo "<td>" . $endereco->bairro . "</td>";
            echo "<td>" . $endereco->cidade . "</td>";
            echo "<td>" . $endereco->uf . "</td>";
            echo "</tr>";
        }

        ?>
        
    </tbody>
</table>
<a href="index.php" class="btn btn-light">Voltar</a>

<?php require_once("layout/footer.php") ?>