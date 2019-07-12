<?php

require_once("DAO/conexao.php");
require_once("DAO/clienteDAO.php");
require_once("DAO/enderecoDAO.php");

$idCliente = $_GET['id'];

$enderecoDAO = new EnderecoDAO($con);
$enderecoDAO->excluirPorCliente($idCliente);

$clienteDAO = new ClienteDAO($con);
$clienteDAO->excluirPorId($idCliente);

header("location: index.php");
?>