@extends('mainindex.maintemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<!--Select2-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('seccion')
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h1 mb-2 text-gray-800">Productos <i class="fa fa-shopping-basket"></i></h1>
                        <div class="card shadow mb-4 ">
                            <div class="card-header d-sm-flex py-3 justify-content-between bg-primary">
                                <h4 class="m-0 font-weight-bold text-white">Detalle del producto: {{$product->name}}</h4>   
                            </div>
                                <div class="card-body">
                                    <div class=" ">
                                        <div class="row ">
                                            <div class="col-md-6  align-self-center">
                                               <!-- <img src="{{asset($product->image)}}" class="shadow rounded-circle"width="350" height="350" alt=""> -->
                                                <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
                                                    <div class="carousel-inner shadow-sm rounded">
                                                        @foreach($product->images as $image)
                                                        <div class="carousel-item @if($loop->index==0) active @endif">
                                                            <img src="{{$image->url}}" class="d-block w-100 shadow"  alt="...">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 align-self-center">
                                                <table class="table table-borderless table-sm ">
                                                    <tbody class="">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-8">
                                                                <label for="exampleFormControlSelect2"><strong>Categoría(s):</strong></label>
                                                                <select disabled class="js-example-basic-multiple"  id="categories" name="categories[]" multiple="multiple" style="width: 100%">
                                                                    @foreach($categories as $category)
                                                                            @if ($category->id == $product->category_id)
                                                                                <option value="{{$category->id}}" selected="selected">{{$category->category_name}}</option>
                                                                            @else
                                                                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                                            @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="exampleFormControlSelect2"><strong>Empresa</strong></label>
                                                                <select disabled class="form-control @error('categories') is-invalid @enderror" id="" name="business_id" style="width: 100%">
                                                                @foreach($businesses as $business)
                                                                        @if ($business->id == $product->business_id)
                                                                            <option value="{{$business->id}}" selected="selected">{{$business->name}}</option>
                                                                        @else
                                                                            <option value="{{$business->id}}">{{$business->name}}</option>
                                                                        @endif
                                                                @endforeach
                                                                </select>
                                                                @error('categories')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                        </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleFormControlSelect2"><strong>Estado:</strong></label>
                                                                <select disabled class="form-control rounded-pill" id="state" name="state">
                                                                    <option selected="selected">{{$product->state}}</option>
                                                                    <option value="Disponible">Disponible</option>
                                                                    <option value="Agotado">Agotado</option>
                                                                    <option value="Nuevo">Nuevo</option>
                                                                    <option value="En importacion">En importación</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="formGroupExampleInput"><strong>Existencia:</strong></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fa fa-archive"></i></span>
                                                                    </div>
                                                                    <input disabled type="number" step="any" class="form-control text-center" aria-label="Amount (to the nearest dollar)" min="0" pattern="^[0-9]+" name="stock" value="{{$product->stock}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="formGroupExampleInput"><strong>Precio:</strong></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">$</span>
                                                                    </div>
                                                                    <input disabled type="number" step="any" class="form-control text-center" aria-label="Amount (to the nearest dollar)" min="1" pattern="^[0-9]+" name="price" value="{{$product->price}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="formGroupExampleInput"><strong>Descuento:</strong></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">-</span>
                                                                    </div>
                                                                    <input disabled type="number" step="any" class="form-control text-center" aria-label="Amount (to the nearest dollar)" min="1" pattern="^[0-9]+" name="discount" value="{{$product->promotion?$product->promotion->discount:"0" }}">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">%</span>
                                                                    </div>    
                                                                </div>
                                                            </div>
                                                            @if($product->promotion)<!-- value="{{$product->promotion?$product->promotion->discount:"Sin promoción" }} -->
                                                            <div class="form-group col-md-6">
                                                                <label for="formGroupExampleInput"><strong>Descuento total:</strong></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">$</span>
                                                                    </div>
                                                                    <input disabled type="number" step="any" class="form-control text-center" aria-label="Amount (to the nearest dollar)" min="1" pattern="^[0-9]+" name="price" value="{{(($product->price *$product->promotion->discount)/100)}}">
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if($product->promotion)<!-- value="{{$product->promotion?$product->promotion->discount:"Sin promoción" }} -->
                                                            <div class="form-group col">
                                                                <label for="formGroupExampleInput"><strong>Nuevo precio:</strong></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">$</span>
                                                                    </div>
                                                                    <input disabled type="number" step="any" class="form-control text-center" aria-label="Amount (to the nearest dollar)" min="1" pattern="^[0-9]+" name="price" value="{{$product->new_price = ($product->price-($product->price *$product->promotion->discount)/100)}}">
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="form-group col-md-6">
                                                                <label for="formGroupExampleInput"><strong>Envío:</strong></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">$</span>
                                                                    </div>
                                                                    <input disabled type="number" step="any" class="form-control text-center" aria-label="Amount (to the nearest dollar)" min="1" pattern="^[0-9]+" name="price_shipping" value="{{$product->price_shipping}}">
                                                                </div>
                                                            </div>
                                                            @if($product->promotion)
                                                            <div class="form-group col-md-6">
                                                                <label for="formGroupExampleInput"><strong>Precio total:</strong></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">$</span>
                                                                    </div>
                                                                    <input disabled type="number" step="any" class="form-control text-center" aria-label="Amount (to the nearest dollar)" min="1" pattern="^[0-9]+" name="price" value="{{$product->price_shipping + $product->new_price}}">
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="form-group col-md-6">
                                                                <label for="formGroupExampleInput"><strong>Precio total:</strong></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">$</span>
                                                                    </div>
                                                                    <input disabled type="number" step="any" class="form-control text-center" aria-label="Amount (to the nearest dollar)" min="1" pattern="^[0-9]+" name="price" value="{{$product->price + $product->price_shipping}}">
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        @if($product->promotion)<!-- value="{{$product->promotion?$product->promotion->discount:"Sin promoción" }} -->
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="example-datetime-local-input"  class=""><strong>Inicio de promoción</strong></label>
                                                                <input class="form-control rounded-pill" disabled type="datetime-local" name="stard_date" value="{{ date('Y-m-d\TH:i', strtotime($product->promotion->stard_date)) }}" placeholder="2011-08-19T13:45:00">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="example-datetime-local-input" class=""><strong>Fin de promoción</strong></label>
                                                                <input class="form-control rounded-pill" disabled type="datetime-local" name="finish_date" value="{{ date('Y-m-d\TH:i', strtotime($product->promotion->finish_date)) }}" placeholder="2011-08-19T13:45:00">
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="form-row">
                                                            <div class="form-group col-md ">
                                                                <label for="formGroupExampleInput"><strong>Activo:</strong></label>
                                                                <div class="container">
                                                                    @if($product->active==1 && $product->stock>=1) 
                                                                        <div class="d-inline p-2 bg-success text-white shadow-sm rounded-pill justify-content-center">
                                                                            <i class="fa fa-check-circle"></i>  <strong>Si</strong>
                                                                        </div>
                                                                    @else
                                                                        <div class="d-inline p-2 bg-danger text-white shadow-sm rounded-pill align-middle">
                                                                            <i class="fa fa-times-circle""></i>  <strong>No</strong>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> 
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="formGroupExampleInput"><strong>Características:</strong></label>
                                                <textarea class="form-control text-justify text-break" disabled rows="3" id="characteristics" name="characteristics">{{old('characteristics', $product->characteristics)}}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="formGroupExampleInput"><strong>Descripción:</strong></label>
                                                <textarea class="form-control text-justify text-break" disabled rows="3" id="description" name="description">{{old('description', $product->description)}}</textarea>
                                            </div>
                                        </div> 
                                        <div class="modal-footer">
                                            <a href="{{route('admin.products.index')}}" class="btn btn-danger rounded-pill shadow-sm" data-dismiss="modal">Cerrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @section('js')
                                @php
                                    $category_ids = [];                           
                                @endphp
                                @foreach ($product->categories as $category)
                                    @php
                                        array_push($category_ids, $category->id)
                                    @endphp
                                @endforeach
                                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.11/dist/sweetalert2.all.min.js"></script>
                                <script src="resources\js\app.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('.js-example-basic-multiple').select2({
                                            language: "es",
                                            maximumSelectionLength : 3,
                                        });
                                        data = [];
                                        data = <?php echo json_encode($category_ids); ?>;
                                        $('.js-example-basic-multiple').val(data);
                                        $('.js-example-basic-multiple').trigger('change');
                                    });
                                </script>
                            @endsection
                    
@endsection