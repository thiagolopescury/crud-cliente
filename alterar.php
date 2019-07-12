<?php
require_once("DAO/conexao.php");
require_once("DAO/clienteDAO.php");
require_once("DAO/enderecoDAO.php");

$idCliente = $_GET['id'];
$clienteDAO = new ClienteDAO($con);
$enderecoDAO = new EnderecoDAO($con);

if (!empty($_POST)) {
    $cliente = new Cliente();
    $cliente->nome = $_POST['nome'];
    $cliente->email = $_POST['email'];
    $cliente->telefone = $_POST['telefone'];
    $cliente->id = $idCliente;

    $clienteDAO->alterarCliente($cliente);

    
    $enderecoDAO->excluirPorCliente($idCliente);

    for ($i = 0; $i < sizeof($_POST['enderecoNome']); $i++) {
        $endereco = new Endereco();
        $endereco->nome = $_POST['enderecoNome'][$i];
        $endereco->logradouro = $_POST['enderecoLogradouro'][$i];
        $endereco->bairro = $_POST['enderecoBairro'][$i];
        $endereco->numero = $_POST['enderecoNumero'][$i];
        $endereco->cidade = $_POST['enderecoCidade'][$i];
        $endereco->cep = $_POST['enderecoCEP'][$i];
        $endereco->uf = $_POST['enderecoUF'][$i];
        $endereco->cliente_id = $cliente->id;
        $enderecoDAO->inserirEndereco($endereco);
    }

    header("location: index.php");
} else {
    $cliente = $clienteDAO->recuperarPorId($idCliente);
    $enderecos = $enderecoDAO->recuperarPorCliente($idCliente);
}

?>
<?php require_once("layout/header.php") ?>
<script type="text/javascript" src="js/endereco.js"></script>
<h2>Editar Cliente </h2>
<form method="POST" action="alterar.php?id=<?php echo $idCliente ?>">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input value="<?php echo $cliente->nome; ?>" type="text" class="form-control" id="nome" name="nome">

    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input value="<?php echo $cliente->email; ?>" type="email" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
        <label for="telefone">Telefone</label>
        <input value="<?php echo $cliente->telefone; ?>" type="text" class="form-control" id="telefone" name="telefone">
    </div>

    <div class="card">
        <div class="card-header">
            Endereços
        </div>
        <div class="card-body">
            <div class="container-fluid">

                <div class="enderecos">
                    <button class="btn btn-success" id="btnAddCampos">
                        Novo endereço
                    </button>
                    <br>
                    <?php

                    $numeroAleatorio = mt_rand(1, 999999);

                    foreach ($enderecos as $endereco) {
                        echo '<div id="form-group-id-' . $numeroAleatorio . '">';
                        echo '<div class="row">';
                        echo '<div class="col col-lg-12">';
                        echo '<div class="form-group">';
                        echo '<label for="enderecoNome">Nome</label>';
                        echo '<input type="text" class="form-control" id="enderecoNome" name="enderecoNome[]" value="' . $endereco->nome . '"></div>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                        echo '<div class="col col-lg-4">';
                        echo '<div class="form-group">';
                        echo '<label for="enderecoLogradouro">Logradouro</label>';
                        echo '<input type="text" class="form-control" id="enderecoLogradouro" name="enderecoLogradouro[]" value="' . $endereco->logradouro . '"> </div>';
                        echo '</div>';
                        echo '<div class="col col-lg-4">';
                        echo '<div class="form-group">';
                        echo '<label for="enderecoNumero">Número</label>';
                        echo '<input type="text" class="form-control" id="enderecoNumero" name="enderecoNumero[]" value="' . $endereco->numero . '"> </div>';
                        echo '</div>';
                        echo '<div class="col col-lg-4">';
                        echo '<div class="form-group">';
                        echo '<label for="enderecoCEP">CEP</label>';
                        echo '<input type="text" class="form-control" id="enderecoCEP" name="enderecoCEP[]" value="' . $endereco->cep . '"> </div>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                        echo '<div class="col col-lg-4">';
                        echo '<div class="form-group">';
                        echo '<label for="enderecoBairro">Bairro</label>';
                        echo '<input type="text" class="form-control" id="enderecoBairro" name="enderecoBairro[]" value="' . $endereco->bairro . '"> </div>';
                        echo '</div>';
                        echo '<div class="col col-lg-4">';
                        echo '<div class="form-group">';
                        echo '<label for="enderecoCidade">Cidade</label>';
                        echo '<input type="text" class="form-control" id="enderecoCidade" name="enderecoCidade[]" value="' . $endereco->cidade . '"> </div>';
                        echo '</div>';
                        echo '<div class="col col-lg-4">';
                        echo '<div class="form-group">';
                        echo '<label for="enderecoUF">UF</label>';
                        echo '<input type="text" class="form-control" id="enderecoUF" name="enderecoUF[]" value="' . $endereco->uf . '"> </div>';
                        echo '</div>';
                        echo '</div>';
                        echo '<button class="btn btn-danger removeField" type="button" data-form-group-id="' . $numeroAleatorio . '">Remover</button>';
                        echo '<hr />';
                        echo '</div>';
                    }
                    ?>
                </div>



            </div>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="index.php" class="btn btn-light">Voltar</a>
</form>
<?php require_once("layout/footer.php") ?>