<?php
use Vital\Controller\ClientesController;

if(isset($_GET['id'])){
    $cliente = new ClientesController();
    $ret = $cliente->atuCliente();
}

?>
<!-- {{isset($registro->nome) ? $registro->nome : ''}} -->
<div class="input-field">
    <input type="text" name="name" value="<?php echo isset($ret[0]['name']) ? $ret[0]['name'] : '' ?>" >
    <input type="hidden" name="id" value="<?php echo isset($ret[0]['id']) ? $ret[0]['id'] : '' ?>" >
    <label>Nome</label>
</div>

<div class="input-field">
    <input type="email" name="email" value="<?php echo isset($ret[0]['email']) ? $ret[0]['email'] : '' ?>" required>
    <label>E-mail</label>
</div>

<div class="input-field">
    <input type="password" name="senha" value="<?php echo isset($ret[0]['senha']) ? $ret[0]['senha'] : '' ?>" required>
    <label>Senha</label>
</div>

<div class="input-field">
    <input type="text" name="saldo" maxlength="12" value="<?php echo isset($ret[0]['saldo']) ? number_format($ret[0]['saldo'], 2, ',', ' ') : '' ?>" required onKeyPress="return(moeda(this,'.',',',event))" >
    <label>Saldo</label>
</div>

<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/MascaraDinheiro.js"></script>
