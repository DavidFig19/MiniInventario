<input type="text" value="<?= base_url ?>" id="urlbase" style="display:none;">


<div class="row">

    <div class="col-lg-4 col-md-3 col-sm-12">
        <div class="card mt-3 shadow-sm">
            <h5 class="card-header bg-primary"></h5>
            <div class="card-body">
                <h6 class="text-center">Buscar Clientes</h6>
                <small class="text-center">Busqueda automatica</small>
                <form  id="formSearch">
                    <div class="input-group">

                        <input value="<?= (isset($_POST['razonSocial'])) ? $_POST['razonSocial'] : null ?>" class="form-control" type="text" id="razonSocial" name="razonSocial" placeholder="Razon social...">
                       
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="card ">
            <h5 class="card-header bg-primary"></h5>
            <div class="card-body d-flex flex-column align-items-center">
                <i class="fa-solid fa-user-plus fa-4x"></i>

                <span>Resgistrar un cliente</span>

                <small>Nuevo usuario</small>

                <a class="btn btn-primary" href="<?= base_url ?>cliente/add"><i class="fa-solid fa-circle-plus"></i> acceder</a>
            </div>
        </div>
    </div>
    <div class=" mx-auto col-lg-8 col-md-7 col-sm-12 table-responsive-lg table-responsive-md table-responsive-sm">
        <table class="table table-bordered  table-hover table-striped mt-3 shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Razón Social</th>
                    <th scope="col">RFC</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody id="Table">
                <!--Genrado con JavaScript-->
                
            </tbody>
        </table>

    </div>
</div>
<script>
  
    const table = document.querySelector('#Table');
    const formSearch = document.getElementById('formSearch');
    const inputSearch = document.querySelector('#razonSocial');
    const url = document.querySelector('#urlbase').value;
    console.log(inputSearch);


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
                            ${element.RAZON_SOCIAL}
                        </td>
                        <td scope="row">
                            ${element.RFC}
                        </td>
                        <td >
                           <button onclick="eliminar(this.value)" value="${element.IDCLIENTE}"  class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                           <a href="${url}cliente/getOne/${element.IDCLIENTE}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                           <a href="${url}venta/add/${element.IDCLIENTE}" class="btn btn-outline-success btn-sm">Ir de <i class="fa-solid fa-cart-shopping"></i></a>
                        </td>
                        </tr>
                        `;

                    });
                    table.innerHTML = rawTextNodes;
                }

            })

    }


    inputSearch.addEventListener('input', shwoTable)






    //para eliminar sin recargar
    const eliminar=(param)=>{
        const url_base = `${url}cliente/delete/${param}`;
            fetch(url_base)
                .then(data => {
                    return data;
                    
                });
               
                shwoTable();
    }
</script>