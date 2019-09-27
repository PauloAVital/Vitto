<?php require_once __DIR__ .'/../layout/header.php'; ?>

    <div class="container">
        <h3 class="center">Atualizar cliente</h3>

        <div class="row">
            <form class="" action="/atualizaCliente" method="post" enctype="multipart/form-data">

                <?php require_once __DIR__ .'/_form.php'; ?>

                <button class="btn deep-orange">Atualizar</button>
            </form>
        </div>
        <div class="row" style="float: right">
            <a class="btn green" href="/listarCliente">Listagem</a>
        </div>
    </div>

<?php require_once __DIR__ .'/../layout/footer.php'; ?>