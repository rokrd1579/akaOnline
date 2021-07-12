@extends('mainindex.maintemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
@endsection

@section('seccion')
            <div class="container-fluid">
            <!-- Vista principal del módulo 'empresas' -->
                    <!-- Page Heading -->
                    <h1 class="h1 mb-2 text-gray-800">Empresas <i class="fa fa-building"></i></h1>

                    <!-- DataTales Example -->
                <div class="card shadow mb-4 ">
                        <div class="card-header d-sm-flex py-3 justify-content-between bg-primary">
                            <h4 class="m-0 font-weight-bold text-white">Registros de Empresas</h4>
                            <a href="{{route('admin.business.create')}}" class="Addbusiness d-sm-inline-block btn btn-sm btn-primary shadow-sm rounded-pill"  
                             data-toggle="popover" title="Agregar usuario!">
                            <i class="fa fa-plus-circle text-white-50" ></i> Agregar</a>
                        </div>
                    <div class="card-body">
                        <!-- Mostrar todos los registros del módulo empresas -->
                        <div class=" ">
                            <table class="table table-bordered text-center table-hover" id="tableusers" width="100%" cellspacing="0">
                                    <thead class="bg-gradient-primary text-white">
                                        <tr>
                                            <th style="width: 25%">Nombre</th>
                                            <th style="width: 25%">Razón social</th>
                                            <th style="width: 25%">Correo electrónico</th>
                                            <th style="width: 25%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="bg-gradient-primary text-white">
                                        <tr>
                                            <th style="width: 25%">Nombre</th>
                                            <th style="width: 25%">Razón social</th>
                                            <th style="width: 25%">Correo electrónico</th>
                                            <th style="width: 25%">Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody class="">
                                        @foreach($businesses as $business)
                                            <tr>
                                                <td>{{$business->name}}</td>
                                                <td>{{$business->name_business}}</td>
                                                <td>{{$business->email}}</td>
                                                <td class="aling-middle">
                                                    <!-- Botones para mostrar, editar y edliminar registros del módulo 'empresas' -->
                                                    <form action="{{route('admin.business.destroy', $business->id)}}" class="Deletebusiness" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{route('admin.business.show', $business->id)}}" class="Addbusiness btn btn-warning btn-circle shadow-sm  btn-xl"
                                                            data-toggle="popover" title="Detalle!"> 
                                                            <i class="fa fa-info-circle"></i>
                                                        </a>
                                                        <a href="{{route('admin.business.edit', $business->id)}}" class="btn btn-primary btn-circle  shadow-sm  btn-xl"
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
                            </table>
                            <!-- Código JS para mostrar tabla de datos (DataTable) y mensajes al realizar operaciones del CRUD -->
                                @section('js')
                                    <!-- SweetAlert -->
                                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                    <script>
                                        $('.Deletebusiness').submit(function(e){
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
                                        $('.Addbusiness').submit(function(e){
                                            e.preventDefault()
                                        })
                                    </script>
                                    @if(session('Modificar')=='Ok')
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
                                            Swal.fire({
                                                '¡Eliminado!',
                                                'El registro se eliminó.',
                                                'success'})
                                        </script>
                                    @endif
                                    <!-- SweetAlert -->
                                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                                    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
                                    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
                                    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

                                    <script>
                                    $(document).ready(function() {
                                        $('#tableusers').DataTable({
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