<input type="text" value="<?= base_url ?>" id="urlbase" style="display:none;">

<div class="row">
    <!-- para el buscador -->
    <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
        <div class="card shadow-sm">
            <h6 class="card-header bg-dark"></h6>
            <div class="card-body">
                <h5 class="text-center">
                <i class="fa-solid fa-basket-shopping fa-4x"></i>
                </h5>
                <h6 class="text-center">Ver compras por cliente</h6>
                <br>
                <a target="_blank" href="<?= base_url.'venta/ventasCliente/'.$datos->IDCLIENTE?>" class="btn btn-dark d-block">Ver su historial de compras</a>
            </div>
        </div>
        <br>
        <div class="card  shadow-sm">
            <h5 class="card-header bg-dark"></h5>
            <div class="card-body">
                <h6 class="text-center">Buscar materiales</h6>
                <small class="text-center">Busqueda automatica</small>
                <form id="formSearchMaterial">
                    <div class="input-group">

                        <input class="form-control" type="text" id="materialSearch" name="materialSearch" placeholder="Material...">

                    </div>
                </form>
            </div>
        </div>
        <br />
        <div class="card shadow-sm">
            <div class="card-header  text-white bg-dark">
                <small>Datos Compra</small>
            </div>


            <form id="formComprar" class="card-body" action="<?= base_url . 'venta/save' ?>" method="POST">
                <div class="form-group">
                    <label for="">ID cliente:</label>
                    <input tabindex="-1" onfocus="this.blur()" value="<?= $datos->IDCLIENTE ?>" type="text" name="idcliente" id="idcliente" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Cliente:</label>
                    <input tabindex="-1" onfocus="this.blur()" value="<?= $datos->RAZON_SOCIAL ?>" type="text" name="razonsocial" id="razonsocial" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">RFC:</label>
                    <input tabindex="-1" onfocus="this.blur()" value="<?= $datos->RFC ?>" type="text" name="rfcCliente" id="rfcCliente" class="form-control">
                </div>
                <br />
                <div id="contentNota" class="form-group">
                    <!--Aqui se genera los productos comprados con javascript-->

                </div>
                <div class="form-group">
                    <label for="">Subtotal:</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input class="form-control" type="text" name="subtotal" id="subtotal" tabindex="-1" onfocus="this.blur()">

                    </div>
                </div>
                <div class="form-group">
                    <label for="">IVA:</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input class="form-control" type="text" name="iva" id="iva" tabindex="-1" onfocus="this.blur()">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Total:</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input class="form-control" type="text" name="total" id="total" tabindex="-1" onfocus="this.blur()">
                    </div>
                </div>
                <br>
                <div class="form-group">


                    <input class="form-control " type="text" name="contador" id="contador" tabindex="-1" onfocus="this.blur()">

                </div>
                <br>
                <button name="comprarMaterial" class="btn btn-success" type="submit">Comprar <i class="fa-solid fa-money-bill"></i></button>
            </form>

        </div>
    </div>
    <!-- para la tabla de busqueda -->
    <div class="col-lg-8 col-md-8 col-sm-12">
        <table class="table table-bordered  table-hover table-striped mt-3 shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody id="TableMaterial">
                <!--Genrado con JavaScript-->

            </tbody>
        </table>
    </div>
</div>

<script>
    //valor de la url
    const url = document.querySelector('#urlbase').value;
    //tabla
    const table = document.querySelector('#TableMaterial');
    //formulario busqueda
    const formSearch = document.getElementById('formSearchMaterial');
    //formulario para comprar
    const formComprar = document.getElementById('formComprar');
    //input del formulario
    const inputSearch = document.querySelector('#materialSearch');

    //contenido nota
    const contentNota = document.getElementById('contentNota');
    //arreglo para el contenido
    var contenido = [];
    //input para subtotal
    const inputSubtotal = document.getElementById('subtotal');
    //input para iva
    const inputIva = document.getElementById('iva');
    //input para total
    const inputTotal = document.getElementById('total');


    //valor subtotal
    var subtotal = 0;

    //valor para el iva
    var iva = 0;
    //valor total
    var total = 0;
    //var contador para el for
    var contadorProduct = 0;
    //input para mandar el contador
    const contadorProductInput = document.getElementById("contador");

    //contador para names unicos en los inputs
    var count = 0;




    formSearch.addEventListener('submit', function(e) {
        e.preventDefault();
    })

    function shwoTable() {
        table.innerHTML = "";
        let rawTextNodes = "";
        let campos = new FormData(formSearch);

        fetch(`${url}busquedas.php`, {
                method: 'POST',
                body: campos,
            })
            .then(res => res.json())
            .then(data => {
                if (!data) {
                    rawTextNodes = `<h5 class="text-center">Sin resultados...</h5>`;
                } else {
                    data.forEach(element => {

                        rawTextNodes += `
                        <tr>
                        <td scope="row">
                            ${element.IDMATERIAL}
                        </td>
                        <td scope="row">
                            ${element.NOMBREMATERIAL}
                        </td>
                        <td scope="row">
                            ${element.UNIDADMEDIDA}
                        </td>
                        <td scope="row">
                            ${element.PRECIO1}
                        </td>
                        <td >
                           <button onclick="addProducto('${element.NOMBREMATERIAL}','${element.IDMATERIAL}',${element.PRECIO1},'${element.UNIDADMEDIDA}');"   class="btn btn-outline-primary btn-sm">Comprar <i class="fa-brands fa-shopify"></i></button>
                           <a target="_blank" href="${url}venta/ventasProduct/${element.IDMATERIAL}" class="btn btn-outline-success btn-sm">Ver ventas</a>

                        </td>
                        </tr>
                        `;

                    });
                    table.innerHTML = rawTextNodes;
                }

            })

    }


    inputSearch.addEventListener('input', shwoTable);


    //funcion para llenar el formulario de guardado
    function addProducto(nombre, id, precio, unidad) {

        //label id
        const labelID = document.createElement("label");
        labelID.innerHTML = "ID:";
        //label nombre
        const labelMaterial = document.createElement("label");
        labelMaterial.innerHTML = "Material:";
        //label unidadMedida
        const labelUnidad = document.createElement("label");
        labelUnidad.innerHTML = "Unidad medida:";
        //label precio
        const labelPrecio = document.createElement("label");
        labelPrecio.innerHTML = "Precio $:";
        //label cantidad
        const labelCantidad = document.createElement("label");
        labelCantidad.innerHTML = "Cantidad:";

        const br = document.createElement("br");
        const hr = document.createElement("hr");
        //para el id
        const inputId = document.createElement("input");
        inputId.setAttribute("class", "form-control");
        inputId.setAttribute("name", `idMaterial-${count}`);
        inputId.setAttribute("value", id);
        //para el nombre
        const inputNombre = document.createElement("input");
        inputNombre.setAttribute("class", "form-control");
        inputNombre.setAttribute("name", `nombreMaterial-${count}`);
        inputNombre.setAttribute("value", nombre);

        //para el nombre
        const inputUnidad = document.createElement("input");
        inputUnidad.setAttribute("class", "form-control");
        inputUnidad.setAttribute("name", `unidadMaterial-${count}`);
        inputUnidad.setAttribute("value", unidad);


        //para el precio
        const inputPrecio = document.createElement("input");
        inputPrecio.setAttribute("class", "form-control");
        inputPrecio.setAttribute("name", `precioMaterial-${count}`);
        inputPrecio.setAttribute("value", precio);

        //para la cantidad
        const inputCantidad = document.createElement("input");
        inputCantidad.setAttribute("class", "form-control valor-cant");
        inputCantidad.setAttribute("type", "number");
        inputCantidad.setAttribute("id", `inputCantidad-${id}`);
        inputCantidad.setAttribute("name", `cantidadMaterial-${count}`);
        inputCantidad.setAttribute("value", 1);
        inputCantidad.setAttribute("min", 1);
        inputCantidad.setAttribute("pattern", "^[0-9]+");
        inputCantidad.setAttribute("data-value", precio);


        contentNota.appendChild(labelID)
        contentNota.appendChild(inputId);
        contentNota.appendChild(labelMaterial);
        contentNota.appendChild(inputNombre);
        contentNota.appendChild(labelUnidad);
        contentNota.appendChild(inputUnidad);
        contentNota.appendChild(labelPrecio);
        contentNota.appendChild(inputPrecio);
        contentNota.appendChild(labelCantidad);
        contentNota.appendChild(inputCantidad);
        contentNota.appendChild(hr);
        //para asignar un name unico a cada elemento
        count = count + 1;
        console.log('Este es el contador de index: ' + count);
        //cada que agregamos un nuevo elemento el subtotal 
        //lo reiniciamos a 0
        subtotal = 0;
        //ejecutamos denuevo toda la funcion
        addPrecio();
        //añadimos un nevo pructo al contador
        contadorProduct = contadorProduct + 1;
        contadorProductInput.value = contadorProduct;

    }



    //fucnion para agregar el precio
    //mandamos como parametro tambien el id
    //para seleccionar su input y tomar el valor de su cantidad
    function addPrecio() {

        let arregloInputs = document.querySelectorAll('.form-control.valor-cant');
        arregloInputs.forEach((element) => {
            subtotal = subtotal + (parseInt(element.getAttribute("data-value")) * element.value);
            console.log(subtotal);
            //ejecutamos la funcion para cambiar los precios
            //mostrados
            showPrices(subtotal);

        })


        //si cambia el valor algun input
        arregloInputs.forEach((input) => {
            input.addEventListener('change', () => {
                //por cada cambio reinicia el subtotal
                //y vuelve a recororer todo el arreglo
                //para que tome el valor de todos denuevo
                subtotal = 0;
                arregloInputs.forEach((element) => {
                    subtotal = subtotal + (parseInt(element.getAttribute("data-value")) * element.value);
                    console.log("subtotal con cambio: " + subtotal);
                    //ejecutamos la funcion para cambiar los precios
                    //mostrados
                    showPrices(subtotal);
                })
            })

        })


    }

    function showPrices(param) {
        iva = param * .16;
        total = iva + param;
        inputSubtotal.value = param;
        inputIva.value = iva;
        inputTotal.value = total;

    }
</script>