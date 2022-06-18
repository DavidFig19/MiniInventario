<div class="row">
    <div class=" col-sm-12 col-md-8 col-lg-6 mt-5 mx-auto">
        <div class="card  mb-5 shadow ">
            <div class="card-header">
                <h5 class="text-center">Recepcion datos producto</h5>
            </div>
            <div class="card-body">
                <form class="row g-1 needs-validation" action="<?= ($accion->tipo == "Agregar") ? base_url . 'product/save/' : base_url . 'product/save/' . $datos->IDMATERIAL ?>" method="post" novalidate>
                    <div class="form-group">
                        <label for="">ID</label>
                        <input value="<?= (isset($datos)) ? $datos->IDMATERIAL : ''; ?>" type="text" name="idProduct" class="form-control" disabled>

                    </div>
                    <div class="form-group">
                        <label for="">Nombre:</label>
                        <input placeholder="Ejemplo, Pintura.." value="<?= (isset($datos)) ? $datos->NOMBREMATERIAL : ''; ?>" maxlength="50" type="text" name="nombreProduct" class="form-control" autofocus required>
                        <div class="invalid-feedback">
                            Campo Vacio
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion:</label>
                        <textarea placeholder="Ejemplo, Pintura, para exterior..." maxlength="60" name="descProduct" class="form-control" cols="30" rows="5" required><?= (isset($datos)) ? $datos->DESCRIPCION : ''; ?></textarea>
                        <div class="invalid-feedback">
                            Campo Vacio
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="">Unidad Medida:</label>
                        <input placeholder="Ejemplo, Litros" value="<?= (isset($datos)) ? $datos->UNIDADMEDIDA : ''; ?>" maxlength="10" type="text" name="medidaProduct" class="form-control" required>
                        <div class="invalid-feedback">
                            Campo Vacio
                        </div>
                    </div>

                    <div class="form-group col-md-8 col-sm-12">
                        <label for="">Precio:</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input placeholder="00.00" value="<?= (isset($datos)) ? $datos->PRECIO1 : ''; ?>" type="number" name="precioProduct" class="form-control" required>
                            <div class="invalid-feedback">
                                Campo Vacio
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn <?= $accion->clase ?>" type="submit"><?= $accion->tipo ?> <?= $accion->icono ?></button>
                </form>
            </div>



        </div>
    </div>
</div>