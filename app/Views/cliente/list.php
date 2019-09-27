<?php

use Vital\Controller\ClientesController;

require_once __DIR__ .'/../layout/header.php';
    $clientes = new ClientesController();
    $result = $clientes->listarClientes();
?>
<div class="container">
    <h3 class="center">Lista de Clientes</h3>

    <div class="row">
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Saldo</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            <?php
                  foreach ($result as $cliente)
                  {
                        echo '<tr>
                                <td>'.$cliente['id'].'</td>
                                <td>'.$cliente['name'].'</td>
                                <td>'.$cliente['email'].'</td>
                                <td>'.number_format($cliente['saldo'], 2, ',', ' ').'</td>
                                <td>
                                    <a class="btn deep-orange" href="atualizarCliente?id='.$cliente['id'].'">Editar</a>
                                    <a class="btn red" href="apagaCliente?id='.$cliente['id'].'">Excluir</a>
                                </td>
                            </tr>';
                  }
            ?>


            </tbody>
        </table>
    </div>
    <div class="row">
        <a class="btn blue" href="/cliente">Adicionar</a>
    </div>
</div>
<?php require_once __DIR__ .'/../layout/footer.php'; ?>