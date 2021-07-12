@extends('mainindex.maintemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection

@section('seccion')
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h1 mb-2 text-gray-800">Promociones <i class="fa fa-bullhorn"></i></h1>
                        <div class="card shadow mb-4 ">
                            <div class="card-header d-sm-flex py-3 justify-content-between bg-primary">
                                <h4 class="m-0 font-weight-bold text-white">Detalle de la promoción: {{$promotion->name}}</h4>
                                <a href="{{route('admin.promotions.index')}}" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </a>       
                            </div>
                                <div class="card-body">
                                    <div class=" ">
                                        <div class="row ">
                                            <div class="col-md-4 text-center ">
                                               <img src="{{$promotion->image}}" class="shadow rounded-circle" width="250" height="250"alt="">
                                            </div>
                                            <div class="col-md-8 align-self-center">
                                               <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="example-datetime-local-input"  class=""><strong>Inicio de promoción</strong></label>
                                                        <input class="form-control rounded-pill" disabled type="datetime-local" name="stard_date" value="{{ date('Y-m-d\TH:i', strtotime($promotion->stard_date)) }}" placeholder="2011-08-19T13:45:00">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="example-datetime-local-input" class=""><strong>Fin de promoción</strong></label>
                                                        <input class="form-control rounded-pill" disabled type="datetime-local" name="finish_date" value="{{ date('Y-m-d\TH:i', strtotime($promotion->finish_date)) }}" placeholder="2011-08-19T13:45:00">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-8">
                                                        <label for="exampleFormControlSelect2">Producto</label>
                                                        <select class="form-control rounded-pill" disabled id="product_id" name="products_id" style="width: 100%">
                                                            @foreach($products as $product)
                                                                    @if ($product->id == $promotion->products_id)
                                                                        <option value="{{$product->id}}" selected="selected">{{$product->name}}</option>
                                                                    @else
                                                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                                                    @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="">Descuento</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text sm">-</span>
                                                            </div>
                                                            <input type="number" disabled class="form-control text-center" id="name" name="discount" min="1" max="99"  required="required" placeholder="" value="{{($promotion->discount)}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="">Descripción</label>
                                                        <input type="text" disabled class="form-control rounded-pill" id="name" name="description" placeholder="" value="{{($promotion->description)}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                </div>
                            </div>
                        </div>
                    
                
@endsection