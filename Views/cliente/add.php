<!-- <?php  var_dump($datos);?> -->
<div class="row">
    <div class=" col-sm-12 col-md-8 col-lg-6 mt-5 mx-auto">
        <div class="card  mb-5 shadow ">
            <div class="card-header">
                <h5 class="text-center">Recepcion datos Clientes</h5>
            </div>
            <div class="card-body">
                <form class="row g-1 needs-validation" action="<?= ($accion->tipo=="Guardar")?base_url . 'cliente/save':base_url . 'cliente/save/'.$datos->IDCLIENTE ?>" method="post" novalidate>
                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input value="<?= (isset($datos))?$datos->IDCLIENTE:null ?>" type="text" name="id" id="id" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="razon">Razon Social:</label>
                        <input value="<?= (isset($datos))?$datos->RAZON_SOCIAL:null ?>" type="text" maxlength="60" name="razon" id="razon" class="form-control" autofocus placeholder="Materiales S.A. de C.V" required>
                        <div class="invalid-feedback">
                            *Máximo 60 caracteres*
                            *No puede estar vacio*
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rfc">RFC:</label>
                        <input value="<?= (isset($datos))?$datos->RFC:null ?>" type="text" name="rfc" id="rfc" class="form-control" placeholder="xxx-xxx-xxx-x" maxlength="15" minlength="10" required>
                        <div class="invalid-feedback">
                            *No puede estar vacio*
                            *Máximo 15 caracteres*
                            *Miniimo 11 caracteres*

                        </div>
                    </div>
                    <br />
                    <br />
                    <br />
                    <button class="btn  <?=$accion->clase?>" type="submit"><?=$accion->tipo?> <?=$accion->icono?></button>
                </form>
            </div>



        </div>
    </div>
</div>