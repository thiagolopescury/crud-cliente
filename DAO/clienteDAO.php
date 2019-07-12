<?php
require_once('cliente.php');



class ClienteDAO
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function recuperarTodos()
    {
        $rs = $this->conexao->query('SELECT Id, Nome, Email, Telefone FROM cliente');
        $clientes = [];

        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
            $cliente = $this->preencherCliente($row);
            $clientes[] = $cliente;
        }



        return $clientes;
    }

    public function recuperarPorId($id)
    {
        $cliente =null;
        $rs = $this->conexao->prepare('SELECT Id, Nome, Email, Telefone FROM cliente WHERE Id=?');

        $rs->bindParam(1, $id);

        if ($rs->execute()) {
            if ($rs->rowCount() > 0) {
                while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                    $cliente = $this->preencherCliente($row);
                }
            }
        }

        return $cliente;
    }

    public function excluirPorId($id){

        $rs = $this->conexao->prepare('DELETE FROM Cliente WHERE id= ?');

        $rs->bindParam(1, $id);
        $rs->execute();

    }

    
    public function inserirCliente($cliente)
    {


        $rs = $this->conexao->prepare("INSERT INTO Cliente(Nome, Telefone, Email) VALUES (:nome, :telefone, :email)");
        $rs->bindParam(':nome', $cliente->nome);
        $rs->bindParam(':telefone', $cliente->telefone);
        $rs->bindParam(':email', $cliente->email);
        $rs->execute();

        $cliente->id = $this->conexao->lastInsertId();
    }

    public function alterarCliente($cliente)
    {
        $rs = $this->conexao->prepare("update Cliente set Nome = :nome, Telefone = :telefone, email= :email WHERE id=:idCliente");
        $rs->bindParam(':nome', $cliente->nome);
        $rs->bindParam(':telefone', $cliente->telefone);
        $rs->bindParam(':email', $cliente->email);
        $rs->bindParam(':idCliente', $cliente->id);
        $rs->execute();

    }

    private function preencherCliente($row)
    {
        $cliente = new cliente();
        $cliente->id = $row->Id;
        $cliente->nome = $row->Nome;
        $cliente->telefone = $row->Telefone;
        $cliente->email = $row->Email;
        
        return $cliente;
    }
}
