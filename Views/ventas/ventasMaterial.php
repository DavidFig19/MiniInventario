

<div class="row">
    
    
    <?php if($datos->total==null):?>
    <h3 class="text-uppercase text-center text-capitalize fw-bold mt-3">Aun no se vende este producto</h3>
    <?php else:?>
    <div class="col-lg-8 col-md-8-col-sm-12 mx-auto mt-3">
        <div class="card shadow-lg">
            
            <div class="card-body">
                <h3 class="titile-card text-uppercase text-center"><?= $datos->NOMBREMATERIAL?></h3>
                <br/>
                <label>ID Material:</label>
                <p class="fst-italic fw-bold"><?= $datos->IDMATERIAL?></p>
                
                <label>Descripcion:</label>
                <p class="fst-italic fw-bold">
                <?= $datos->DESCRIPCION?>
                </p>

                <label>Unidad de Medida:</label>
                <p class="fst-italic fw-bold">
                <?= $datos->UNIDADMEDIDA?>
                </p>

                <label>Total de piezas vendidas:</label>
                <p class="fst-italic fw-bold">
                <?= $datos->total?>
                </p>
                
                <label>Precio por Producto: </label>
                <p class="fst-italic fw-bold">
                $<?= $datos->PRECIO1?>
                </p>
               
               <label>Subtotal: </label>
               <p class="fst-italic fw-bold">
               $<?= $datos->subtotal?>
               </p>
            </div>
        </div>
    </div>
    <?php endif?>

   
   
</div>