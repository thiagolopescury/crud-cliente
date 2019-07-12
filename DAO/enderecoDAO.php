<?php
require_once('endereco.php');



class EnderecoDAO
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function recuperarPorCliente($idCliente)
    {
        $enderecos = [];
        $rs = $this->conexao->prepare('SELECT Nome, Logradouro, Numero,CEP, Bairro, Cidade, UF FROM Endereco WHERE Cliente_id= ?');

        $rs->bindParam(1, $idCliente);

        if ($rs->execute()) {
            if ($rs->rowCount() > 0) {
                while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                    $endereco = new Endereco();
                    $endereco->nome = $row->Nome;
                    $endereco->logradouro = $row->Logradouro;
                    $endereco->numero = $row->Numero;
                    $endereco->cep = $row->CEP;
                    $endereco->bairro = $row->Bairro;
                    $endereco->cidade = $row->Cidade;
                    $endereco->uf = $row->UF;
                    $enderecos[] = $endereco;
                }
            }
        }

        return $enderecos;
    }

    public function excluirPorCliente($idCliente)
    {

        $rs = $this->conexao->prepare('DELETE FROM Endereco WHERE Cliente_id= ?');

        $rs->bindParam(1, $idCliente);
        $rs->execute();
    }

    public function inserirEndereco($endereco)
    {


        $rs = $this->conexao->prepare("INSERT INTO Endereco(Nome,Logradouro,Numero,CEP,Bairro,Cidade,Uf,Cliente_Id)  VALUES (:nome, :logradouro, :numero, :cep, :bairro, :cidade, :uf, :cliente_id)");
        $rs->bindParam(':nome', $endereco->nome);
        $rs->bindParam(':logradouro', $endereco->logradouro);
        $rs->bindParam(':numero', $endereco->numero);
        $rs->bindParam(':cep', $endereco->cep);
        $rs->bindParam(':bairro', $endereco->bairro);
        $rs->bindParam(':cidade', $endereco->cidade);
        $rs->bindParam(':uf', $endereco->uf);
        $rs->bindParam(':cliente_id', $endereco->cliente_id);
        $rs->execute();
    }
}
