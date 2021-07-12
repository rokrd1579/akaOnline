@extends('mainindex.maintemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
@endsection

@section('seccion')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h1 mb-2 text-gray-800">Productos <i class="fa fa-shopping-basket"></i></h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 ">
            <div class="card-header d-sm-flex py-3 bg-primary d-flex">
                <div class="container">
                    <div class="form-row">
                        <div class="col-md-8"> 
                            <h4 class="m-0 font-weight-bold text-white">Registros de Productos</h4>
                        </div>
                        <div class="col-md">
                            <p class="text-white"><strong>Empresa:</strong></p>
                        </div>
                        <div class="col-md">
                            <div id="SelectBusiness"></div>
                        </div>
                        <div class="col-md">
                            <a href="{{route('admin.products.create')}}" class="Addproducts d-sm-inline-block btn btn-sm btn-primary shadow-sm rounded-pill"  
                            data-toggle="popover" title="Agregar usuario!">
                            <i class="fa fa-plus-circle" ></i> Agregar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table table-bordered text-center table-hover" id="tableproducts" width="100%" cellspacing="0">
                        <thead class="bg-gradient-primary text-white">
                            <tr>
                                <th style="width: 20%">Imagen</th>
                                <th style="width: 20%">Nombre</th>
                                <th style="width: 20%">Categorìa(s)</th>
                                <th style="width: 20%">Empresa</th>
                                <th style="width: 20%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach ($products as $product)
                                <tr>
                                    <td class="align-middle">
                                    @if ($product->images->count()<=0)
                                        <img src="{{asset('/Plantilla/img/image002.png')}}" class="rounded-pill" width="80" height="80"alt=""> 
                                    @else
                                    <img src="{{$product->images->random()->url}}" class="rounded-pill" width="80" height="80"alt="">
                                    @endif
                                    </td>
                                    <td class="text-left">{{$product->name}}</td>
                                    <td class="text-left">
                                        @foreach($product->categories as $category)
                                        <ul class="list-unstyled">
                                            <li>{{$category->category_name}}</li>
                                        </ul>
                                        @endforeach
                                    </td>
                                    <td>{{$product->business->name}}</td>
                                    <td class="align-middle">
                                        <form action="{{route('admin.products.destroy', $product->id)}}" class="Deleteproduct" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('admin.products.show', $product->slug)}}" class="btn btn-warning btn-circle shadow-sm  btn-xl"
                                            data-toggle="popover" title="Mostrar!">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                            <a href="{{route('admin.products.edit', $product->slug)}}" class="Addproducts btn btn-primary btn-circle  shadow-sm  btn-xl"
                                            data-toggle="popover" title="Modificar!">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-circle  shadow-sm  btn-xl"
                                            data-toggle="popover" title="Eliminar!">
                                                <i class="fa fa-trash"></i>
                                            </button>                                           
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gradient-primary text-white">
                            <tr>
                                <th style="width: 20%">Imagen</th>
                                <th style="width: 20%">Nombre</th>
                                <th style="width: 20%">Categoría(s)</th>
                                <th style="width: 20%">Empresa</th>
                                <th style="width: 20%">Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                    @section('js')
                        <!-- SweetAlert -->
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            $('.Deleteproduct').submit(function(e){
                                e.preventDefault()
                                Swal.fire({
                                    title: '¿Estás seguro?',
                                    text: "¡No es revertible!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#28a745',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: '¡Si, eliminar!'
                                    }).then((result) => {
                                    if (result.isConfirmed) {
                                        this.submit()
                                        
                                    }
                                })
                            })
                            $('.Addproducts').submit(function(e){
                                e.preventDefault()
                            })
                        </script>
                        @if(session('Editar')=='Ok')
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'El registro ha sido editado.',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            </script>
                            @endif
                            @if(session('Agregar')=='Ok')
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'El registro ha sido guardado.',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            </script>
                            @endif
                        @if(session('Eliminar')=='Ok')
                            <script>
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El registro se eliminó.',
                                    'success')
                            </script>
                        @endif
                        <!-- SweetAlert -->
                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
                        <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>}
                        <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
                        <script>
                                $(document).ready(function() {
                                    $('#tableproducts').DataTable({
                                        responsive: true,
                                        "language": {
                                            "lengthMenu": "Mostrar "+ 
                                            '<select class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">todos</option></select>'+
                                            " registros por página",
                                            "zeroRecords": "Registro no encontrado - disculpa",
                                            "info": "Página _PAGE_ de _PAGES_",
                                            "infoEmpty": "No records available",
                                            "infoFiltered": "(Filtro de _MAX_ registros)",
                                            "search": "Buscar:",
                                            "paginate":{
                                                "next": "Siguiente",
                                                "previous": "Anterior",
                                            }
                                        },
                                        initComplete: function() {
                                            var column = this.api().column(3);

                                            var select = $('<select class="custom-select custom-select-sm form-control form-control-sm rounded-pill shadow-sm"><option value="" placeholder="Empresa"></option></select>')
                                            .appendTo('#SelectBusiness')
                                            .on('change', function(){
                                                var val = $(this).val();
                                                column.search(val).draw()
                                            });
                                            var offices = [];
                                            column.data().toArray().forEach(function(s){
                                                s = s.split(',');
                                                s.forEach(function(d){
                                                    if(!~offices.indexOf(d)){
                                                        offices.push(d)
                                                        select.append('<option value="' + d + '">' + d + '</option>');
                                                    }
                                                })
                                            });
                                        }
                                    });
                                });
                        </script>
                    @endsection
                </div>
            </div>
        </div>                 
    </div>    
@endsection