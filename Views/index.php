

<div class="row">
    <div class="col-12 mx-auto mt-5">

        <a href="<?= base_url?>product/add" class="btn btn-success">
        <i class="fa-solid fa-plus"></i>
        Producto
        </a>
        <br />
        <br />
        <div class="table-responsive-sm table-responsive-md table-responsive-lg ">
            <table class="table table-striped shadow table-hover">
                <thead class="table-dark ">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Medida</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <th scope="row"><?= $producto['NOMBREMATERIAL'] ?></th>
                          
                            <th scope="row"><?= $producto['DESCRIPCION'] ?></th>
                            <th scope="row"><?= $producto['UNIDADMEDIDA'] ?></th>
                            <th scope="row">$<?= $producto['PRECIO1'] ?></th>
                            <th scope="row">

                                <a href="<?=base_url?>product/delete/<?= $producto['IDMATERIAL'] ?>" class="btn btn-outline-danger" href="">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                                <a href="<?=base_url?>product/getOne/<?= $producto['IDMATERIAL'] ?>" class="btn btn-outline-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                            </th>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            
        </div>
        
    </div>
</div>

<script>
    
</script>




