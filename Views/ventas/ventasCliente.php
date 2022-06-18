<!-- <?php var_dump($datos) ?> -->

<div class="row">

    <?php if (empty($datos)) : ?>
        <h3 class="text-center fw-bold text-uppercase">Sin ventas</h3>
    <?php else : ?>
        <?php foreach ($datos as $item) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mt-3">
                <div class="card mb-2 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-center fw-bold text-uppercase">Ticket</h6>
                        <label>ID cliente: <small class="fw-bold fst-italic"><?= $item["IDCLIENTE"] ?></small></label>
                        <br>
                        <label>RFC: <small class="fw-bold fst-italic"><?= $item["RFC"] ?></small></label>
                        <br>
                        <label>Razón social: <small class="fw-bold fst-italic"><?= $item["RAZON_SOCIAL"] ?></small></label>
                        <br>
                        <label>Subtotal venta: <small class="fw-bold fst-italic"><?= $item["SUBTOTAL"] ?></small></label>
                        <br>
                        <label>IVA venta: <small class="fw-bold fst-italic"><?= $item["IVA"] ?></small></label>
                        <br>
                        <label>Total venta: <small class="fw-bold fst-italic"><?= $item["TOTAL"] ?></small></label>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>

</div>