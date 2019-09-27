<?php require_once(__DIR__."/layout/header.php"); ?>
    <div class="container">
        <h3 class="center">Caixa Eletrônico</h3>
    <div class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">mail</i>
                    <input id="icon_prefix" type="text" class="validate">
                    <label for="icon_prefix">Seu E-mail</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">keyboard</i>
                    <input id="icon_prefix" type="text" class="validate">
                    <label for="icon_prefix">Sua Senha</label>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">attach_money</i>
                    <input id="icon_money" type="tel" class="validate">
                    <label for="icon_telephone">Valor solicitado</label>
                </div>
            </div>

        </form>
    </div>
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




<?php require_once(__DIR__."/layout/footer.php"); ?>