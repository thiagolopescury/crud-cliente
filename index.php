<?php require_once("layout/header.php") ?>
<?php

require_once("DAO/conexao.php");
require_once("DAO/clienteDAO.php");

$clienteDAO = new ClienteDAO($con);
$clientes = $clienteDAO->recuperarTodos();

?>

<h2>Clientes Cadastrados </h2>

<table class="table table-striped table-hover">

	<thead class="thead-dark">
		<tr>
			<th scope="col">Nome</th>
			<th scope="col">Telefone</th>
			<th scope="col">Email</th>
			<th scope="col">Ação</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($clientes as $cliente) {
			echo "<tr>";
			echo "<td>" . $cliente->nome . "</td>";
			echo "<td>" . $cliente->telefone . "</td>";
			echo "<td>" . $cliente->email . "</td>";
			echo '<td>' . '<a class="btn btn-primary btn-sm" href="alterar.php?id=' . $cliente->id . '">Editar</a> '
				. '<a class="btn btn-warning btn-sm" href="detalhar.php?id=' . $cliente->id .'">Detalhar</a> '
				. '<a class="btn btn-danger btn-sm" href="excluir.php?id=' . $cliente->id . '">Excluir</a> '
				. '</td>';
			echo "</tr>";
		}

		?>

	</tbody>
</table>

<?php require_once("layout/footer.php") ?>