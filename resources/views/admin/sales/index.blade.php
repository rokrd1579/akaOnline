@extends('mainindex.maintemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection

@section('seccion')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h1 mb-2 text-gray-800">Ventas</h1>
                    <p class="mb-4">El sistema debe permitir a los usuarios de tipo Administrador gestionar 
                        los datos de Ventas.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header d-sm-flex py-3 justify-content-between bg-primary">
                            <h4 class="m-0 font-weight-bold text-white">Registros de Ventas</h4>
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm rounded-pill"  
                             data-toggle="popover" title="Agregar usuario!">
                            <i class="fa fa-plus-circle text-white-50" ></i> Agregar</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ">
                            <table class="table table-bordered " id="tableusers" width="100%" cellspacing="0">
                            <thead class="bg-gradient-primary text-center text-white">
                                        <tr>
                                            <th style="width: 20%">Cliente</th>
                                            <th style="width: 20%">Fecha</th>
                                            <th style="width: 20%">Total</th>
                                            <th style="width: 20%">Estado</th>
                                            <th style="width: 20%">Acciones</th>
                                        </tr>
                                    </thead>
                                   
                                    <tfoot class="bg-gradient-primary text-center text-white">
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Noveron Gabriel</td>
                                            <td>20/03/2021</td>
                                            <td>$10,000.00</td>
                                            <td>Proceso de Pago</td>
                                            <td class="aling-middle">
                                                <form action="" class="">
                                                    <button type="button" class="btn btn-warning btn-circle shadow-sm  btn-xl"
                                                    data-toggle="popover" title="Detalle!">
                                                        <i class="fa fa-info-circle"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-circle  shadow-sm  btn-xl"
                                                    data-toggle="popover" title="Modificar!">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-circle  shadow-sm  btn-xl"
                                                    data-toggle="popover" title="Eliminar!">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                            </table>
                            @section('js')
                               <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                               <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                               <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

                               <script>
                    $(document).ready(function() {
                       $('#tableusers').DataTable();
                    });

                </script>
                            @endsection
                            </div>
                        </div>
                    </div>
                </div>
@endsection