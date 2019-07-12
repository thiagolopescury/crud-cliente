<?php require_once("layout/header.php") ?>

<?php

require_once("DAO/conexao.php");
require_once("DAO/clienteDAO.php");
require_once("DAO/enderecoDAO.php");

if (!empty($_POST)) {
    $cliente = new Cliente();
    $cliente->nome = $_POST['nome'];
    $cliente->email = $_POST['email'];
    $cliente->telefone = $_POST['telefone'];

    $clienteDAO = new ClienteDAO($con);
    $clienteDAO->inserirCliente($cliente);

    $enderecoDAO = new EnderecoDAO($con);

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
}


?>

<script type="text/javascript" src="js/endereco.js"></script>
<h2>Cadastrar Cliente </h2>
<form method="POST" action="inserir.php">
    <div class="form-group" method=>
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome">



    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone">
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
                </div>
            </div>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="index.php" class="btn btn-light">Voltar</a>
</form>
<?php require_once("layout/footer.php") ?>