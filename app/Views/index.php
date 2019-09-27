<?php

use Vital\Controller\Main;

require_once(__DIR__."/layout/header.php");
    $cliente = new Main();
    $ret = $cliente->verficaCliente();
    $valorSolicitado = $cliente->validaValor();
?>
    <div class="container">
        <h3 class="center">Caixa Eletrônico</h3>
<?php if(count($ret) == 0) { ?>
    <div class="row">
        <form class="col s12" action="/confirmarCliente" method="post">
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">mail</i>
                    <input id="icon_prefix" type="text" name="email" class="validate" required>
                    <label for="icon_prefix">Seu E-mail</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">keyboard</i>
                    <input id="icon_prefix" type="text" name="senha" class="validate" required>
                    <label for="icon_prefix">Sua Senha</label>
                </div>
            </div>
            <button class="btn deep-orange">Enviar</button>
        </form>
    </div>
<?php } else { ?>
    <?php
        if(isset($valorSolicitado['erro'])){
            if ($valorSolicitado['erro'] != ''){
                echo "<a onclick=\"M.toast({html: '".$valorSolicitado['erro']."'})\" class=\"btn red\">".$valorSolicitado['erro']."</a>";
            }
        }
     if(isset($valorSolicitado['valor'])) {
        echo "<div class='row'> 
              <div class='input-field col s6'>
                    <i class='material-icons prefix'>perm_identity</i>
                    <label><b>".$ret[0]['name']."</b></label>
                </div>
                <div class='input-field col s6'>
                    <i class='material-icons prefix'>local_atm</i>
                    <label ><b>".number_format($ret[0]['saldo'], 2, ',', '.')."</b></label>
                </div>               
                <div class='input-field col s6'>
                    <i class='material-icons prefix'>local_atm</i>
                    <label >Valor Solicitado: R$ <b>".$valorSolicitado['valor']."</b></label>
                </div>
            </div>
              ";
    } else {
    ?>
        <form class="col s12" action="/confirmarValor" method="post">
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">perm_identity</i>
                    <label><?php echo '<b>'.$ret[0]['name'].'</b>'; ?></label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">local_atm</i>
                    <label ><?php echo '<b>'.number_format($ret[0]['saldo'], 2, ',', '.').'</b>'; ?></label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">attach_money</i>
                    <input id="icon_money" type="text" name="valorSolicitado" onKeyPress="return(moeda(this,'.',',',event))" class="validate" required>
                    <input id="icon_money" type="hidden" name="id" class="validate" value="<?php echo $ret[0]['id']; ?>" >
                    <input id="icon_money" type="hidden" name="name" class="validate" value="<?php echo $ret[0]['name']; ?>" >
                    <input id="icon_money" type="hidden" name="email" class="validate" value="<?php echo $ret[0]['email']; ?>" >
                    <input id="icon_money" type="hidden" name="senha" class="validate" value="<?php echo $ret[0]['senha']; ?>" >
                    <input id="icon_money" type="hidden" name="saldo" class="validate" value="<?php echo $ret[0]['saldo']; ?>" >
                    <label >Valor solicitado</label>
                </div>
                <div class="input-field col s6">
                    <button class="btn green">Solicitar</button>
                </div>
            </div>

        </form>
<?php }} ?>
        <div class="container">
        <?php
        if(isset($valorSolicitado['notas']))
        {
            echo '<h5>NOTAS SOLICITADAS</h5>';
            echo '<div class="container"><div class="row">';
            if(isset($valorSolicitado['notas']['50']))
            {
                echo '<div class="col s12 m3">
                                    <div class="card">
                                        <div class="card-image">
                                            <img width="40" src="img/50_real.jpg" alt="">                                            
                                        </div>                                        
                                    </div>
                                    <div class="card-action">
                                        <a href="#"><b> Qtd: '.$valorSolicitado['notas']['50'].'</b></a>
                                    </div>
                                </div>';
            }
            if(isset($valorSolicitado['notas']['10']))
            {
                echo '<div class="col s12 m3">
                                    <div class="card">
                                        <div class="card-image">
                                            <img width="40" src="img/10_real.jpg" alt="">                                            
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <a href="#"><b> Qtd: '.$valorSolicitado['notas']['10'].'</b></a>
                                    </div>
                                </div>';
            }
            if(isset($valorSolicitado['notas']['5']))
            {
                echo '<div class="col s12 m3">
                                    <div class="card">
                                        <div class="card-image">
                                            <img width="40" src="img/5_real.jpg" alt="">                                            
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <a href="#"><b> Qtd: '.$valorSolicitado['notas']['5'].'</b></a>
                                    </div>
                                </div>';
            }
            if(isset($valorSolicitado['notas']['1']))
            {
                echo '<div class="col s12 m3">
                                    <div class="card">
                                        <div class="card-image">
                                            <img width="40" src="img/1_real.jpg" alt="">                                            
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <a href="#"><b> Qtd: '.$valorSolicitado['notas']['1'].'</b></a>
                                    </div>
                                </div>';
            }
            echo '</div></div>';
        } else {
        ?>

        <h5>NOTAS DISPONÍVEIS</h5>
        <div class="row">
            <div class="col s12 m3">
                <div class="card">
                    <div class="card-image">
                        <img width="40" src="img/1_real.jpg" alt="">
                        <span class="card-title">R$ 1,00</span>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card">
                    <div class="card-image">
                        <img width="40" src="img/5_real.jpg" alt="">
                        <span class="card-title">R$ 5,00</span>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card">
                    <div class="card-image">
                        <img width="40" src="img/10_real.jpg" alt="">
                        <span class="card-title">R$ 10,00</span>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card">
                    <div class="card-image">
                        <img width="40" src="img/50_real.jpg" alt="">
                        <span class="card-title">R$ 50,00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php } ?>
    </div>
    <script src="js/jquery-1.11.1.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/MascaraDinheiro.js"></script>
<?php require_once(__DIR__."/layout/footer.php"); ?>