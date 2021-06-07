<!DOCTYPE html>
<html lang="pt-BR">
<?php include('./includes/head.php')?>
    <body>

        <?php include('./includes/header.php')?>
        <main>
            <div id="container-text-info" class="col-md-12 mx-auto text-center py-5 bg-custom">
                <h1 class="display-5 col-md-10 mx-auto fw-bold text-light px-2">Busque um endereço com o CEP</h1>
                <p class="lead mb-4 col-md-10 mx-auto text-light">Agora busque endereços facilmente digitando apenas o CEP =D</p>   
            </div>
            <div class="px-4 my-2 text-center">
                <!-- <img class="d-block mx-auto mb-4" src="" alt="" width="72" height="57"> -->
                <div class="col-lg-6 mx-auto">
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <div class="col-sm-12 col-md-10 col-lg-12 shadow-lg" id="container-form">
                            <form class="p-4 p-md-5 border rounded-3 bg-light" id='form-cep'>
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="cep" name='cep' placeholder="00000-000" maxlength="9" required value="">
                                    <label for="cep">Digite o CEP</label>
                                </div>
                                <button class="w-100 btn btn-lg text-light btn-color-custom" type="submit" id='submit-form-cep'>Buscar</button>
                                <hr class="my-4">
                                <!-- <small class="text-dark bg-warning p-2 border rounded-3 d-flex justify-content-center align-items-center "> -->
                                <small class="text-danger p-2 d-flex justify-content-center align-items-center ">
                                    Atenção não fornecemos o número do endereço apenas bairro, rua e cidade.
                                </small>                        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include('./includes/modal.php')?>
        <?php include('./includes/loader.php')?>
        <?php include('./includes/footer.php')?>
        <?php include('./includes/scripts.php')?>
    </body>
</html>