@extends('mainindex.maintemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
@endsection

@section('seccion')
 <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h1 mb-2 text-gray-800">Promociones <i class="fa fa-bullhorn"></i></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header d-sm-flex py-3 justify-content-between bg-primary">
                            <h4 class="m-0 font-weight-bold text-white">Registros de promociones</h4>
                            <a href="{{route('admin.promotions.create')}}" class="Addpromotions d-sm-inline-block btn btn-sm btn-primary shadow-sm rounded-pill"  
                              data-toggle="popover" title="Agregar usuario!">
                            <i class="fa fa-plus-circle text-white-50" ></i> Agregar</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered text-center table-hover" id="tablepromotions" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th style="width: 20%">Imagen</th>
                                            <th style="width: 20%">Nombre</th>
                                            <th style="width: 40%">Descripción</th>
                                            <th style="width: 20%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($promotions as $promotion)
                                        <tr>
                                            <td><img src="{{asset($promotion->image)}}" class="rounded-pill" width="80" height="80"alt=""></td>
                                            <td>{{$promotion->name}}</td>
                                            <td>{{$promotion->description}}</td>
                                            <td class="align-middle">
                                                <form action="{{route('admin.promotions.destroy', $promotion->id)}}" class="Deletepromotion" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{route('admin.promotions.show', $promotion->id)}}" class="btn btn-warning btn-circle shadow-sm  btn-xl"
                                                        data-toggle="popover" title="Detalle!"> 
                                                        <i class="fa fa-info-circle"></i>
                                                    </a>
                                                    <a href="{{route('admin.promotions.edit', $promotion->id)}}" class="Addpromotions btn btn-primary btn-circle  shadow-sm  btn-xl"
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
                                    <tfoot class="bg-primary text-white">
                                        <tr>
                                            <th style="width: 20%">Imagen</th>
                                            <th style="width: 20%">Nombre</th>
                                            <th style="width: 40%">Descripción</th>
                                            <th style="width: 20%">Acciones</th>
                                        </tr>
                                    </tfoot>
                            </table>
                            @section('js')
                            <!-- SweetAlert -->
                            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                $('.Deletepromotion').submit(function(e){
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
                                $('.Addpromotions').submit(function(e){
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
                                $('#tablepromotions').DataTable({
                                    responsive: true,
                                    "language": {
                                        "lengthMenu": "Mostrar "+ 
                                        '<select class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">todos</option></select>' +
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