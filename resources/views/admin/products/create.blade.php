@extends('mainindex.maintemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<!--Select2-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Bootstrap input file -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<!-- Bootstrap input file -->
@endsection

@section('seccion')
                                <div class="container-fluid">
                                    <!-- Page Heading -->
                                    <h1 class="h1 mb-2 text-gray-800">Productos <i class="fa fa-shopping-basket"></i></h1>

                                    
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4 ">
                                        <div>
                                            <div class="card-header d-sm-flex py-3 justify-content-between bg-primary">
                                                <h4 class="m-0 font-weight-bold text-white">Agregar nuevo producto</h4>
                                            </div>
                                                <div class="card-body">
                                                        <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="">Nombre</label>
                                                                    <input type="text" minlength="3" maxlength="80" class="@error('name') is-invalid @enderror form-control" id="name" name="name" placeholder="" value="{{old('name')}}">
                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="exampleFormControlSelect2">Categoría(s)</label>
                                                                    <select class="@error('categories') is-invalid @enderror js-example-basic-multiple" id="categories" name="categories[]" multiple="multiple" style="width: 100%">
                                                                        @foreach($categories as $category)
                                                                                @if ($loop->first)
                                                                                    <option value="{{$category->id}}" selected="selected">{{$category->category_name}}</option>
                                                                                @else
                                                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                                                @endif
                                                                        @endforeach
                                                                    </select>
                                                                    @error('categories')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="exampleFormControlSelect2">Empresa</label>
                                                                    <select class="@error('business_id') is-invalid @enderror form-control" id="categories" name="business_id" style="width: 100%">
                                                                        @foreach($businesses as $business)
                                                                                @if ($loop->first)
                                                                                    <option value="{{$business->id}}" selected="selected">{{$business->name}}</option>
                                                                                @else
                                                                                    <option value="{{$business->id}}">{{$business->name}}</option>
                                                                                @endif
                                                                        @endforeach
                                                                    </select>
                                                                    @error('business_id')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="formGroupExampleInput">Características</label>
                                                                    <textarea minlength="40" maxlength="1000" class="@error('characteristics') is-invalid @enderror form-control" id="characteristics" name="characteristics" placeholder="" value="">{{old('characteristics')}}</textarea>
                                                                    @error('characteristics')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="formGroupExampleInput">Descripción</label>
                                                                    <textarea minlength="40" maxlength="500" class="@error('description') is-invalid @enderror form-control" id="description" name="description" placeholder="" value="">{{old('description')}}</textarea>
                                                                    @error('description')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Precio</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">$</span>
                                                                        </div>
                                                                        <input type="number" step="0.01" max="999999.99" id="num" class="@error('price') is-invalid @enderror form-control text-center " aria-label="Amount (to the nearest dollar)" min="1" pattern="^[0-9]+" name="price" value="{{old('price')}}">
                                                                    @error('price')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Envío</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">$</span>
                                                                        </div>
                                                                        <input type="number" step="0.01" id="num2" max="100000" class="@error('price_shipping') is-invalid @enderror form-control text-center" aria-label="Amount (to the nearest dollar)" min="0" pattern="^[0-9]+" name="price_shipping" value="{{old('priceshipping')}}">
                                                                        @error('price_shipping')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Existencia</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-archive"></i></span>
                                                                        </div>
                                                                        <input type="number" id="num3"  step="any"class="@error('stock') is-invalid @enderror form-control text-center" aria-label="Amount (to the nearest dollar)" min="1" max="1000" pattern="^[0-9]+" name="stock" value="{{old('stock')}}">
                                                                        @error('stock')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="exampleFormControlSelect2">Estado</label>
                                                                    <select class="form-control" id="state" name="state">
                                                                        <option value="Disponible">Disponible</option>
                                                                        <option value="Agotado">Agotado</option>
                                                                        <option value="Nuevo">Nuevo</option>
                                                                        <option value="En importacion">En importación</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-res-1">Agregar imágenes</label>
                                                                <div class="file-loading shadow-sm">
                                                                    <input id="input-res-1" name="images[]" multiple accept="image/*" required class="@error('images') is-invalid @enderror text-center" type="file">
                                                                </div>
                                                            </div>
                                                            <br><!-- 
                                                            <div class="form-group custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" id="active" name="active">
                                                                <label class="custom-control-label" for="customSwitch1">Activo</label>
                                                            </div>
                                                            <br> -->
                                                            <div class="modal-footer">
                                                                <a href="{{route('admin.products.index')}}" class="btn btn-danger rounded-pill shadow-sm" data-dismiss="modal">Cerrar</a>
                                                                <button type="submit" class="btn btn-primary rounded-pill shadow-sm">Guardar</button>
                                                            </div>
                                                        </form>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @section('js')
                                    <!-- Bootstrap input file -->
                                    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
                                    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.0/js/plugins/piexif.min.js" type="text/javascript"></script>
                                    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.0/js/plugins/sortable.min.js" type="text/javascript"></script>
                                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
                                    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.0/js/fileinput.min.js"></script>
                                    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.0/themes/fas/theme.min.js"></script>
                                    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.0/js/locales/LANG.js"></script>
                                    <script src="js/locales/es.js"></script>
                                    <!-- Bootstrap input file -->
                                    <!-- Select2 -->
                                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            $('.js-example-basic-multiple').select2({
                                                language: "es",
                                                maximumSelectionLength : 3,
                                            });
                                        });
                                    </script>
                                    <script>
                                        var input=  document.getElementById('num');
                                    input.addEventListener('input',function(){
                                    if (this.value.length > 8) 
                                        this.value = this.value.slice(0,8);
                                    })
                                   </script>
                                    <script>
                                        var input=  document.getElementById('num2');
                                    input.addEventListener('input',function(){
                                    if (this.value.length > 8) 
                                        this.value = this.value.slice(0,8);
                                    })
                                   </script>
                                   <script>
                                        var input=  document.getElementById('num3');
                                    input.addEventListener('input',function(){
                                    if (this.value.length > 4) 
                                        this.value = this.value.slice(0,4);
                                    })
                                   </script>
                                    
                                    <script>
                                        $(document).ready(function() {
                                            $("#input-res-1").fileinput({
                                                showCaption: false, 
                                                dropZoneEnabled: false,
                                                language: "es",
                                                uploadUrl: "/site/test-upload",
                                                enableResumableUpload: true,
                                                initialPreviewAsData: true,
                                                browseClass: "btn btn-primary btn-block rounded-pill shadow-sm",
                                                showCaption: false,
                                                showRemove: false,
                                                showUpload: false,
                                                showTitle: false,
                                                maxFileCount: 6,
                                                minFileCount: 6,
                                                theme: 'fas',
                                                overwriteInitial: true,
                                                deleteUrl: '/site/file-delete',
                                                fileActionSettings: {
                                                    showZoom: function(config) {
                                                        if (config.type === 'pdf' || config.type === 'image') {
                                                            return true;
                                                        }
                                                        return false;
                                                    }
                                                }
                                            });
                                        });
                                        (function ($) {
                                            "use strict";

                                            $.fn.fileinputLocales['es'] = {
                                                fileSingle: 'archivo',
                                                filePlural: 'archivos',
                                                browseLabel: 'Examinar &hellip;',
                                                removeLabel: 'Quitar',
                                                removeTitle: 'Quitar archivos seleccionados',
                                                cancelLabel: 'Cancelar',
                                                cancelTitle: 'Abortar la subida en curso',
                                                pauseLabel: 'Pause',
                                                pauseTitle: 'Pause ongoing upload',
                                                uploadLabel: 'Subir archivo',
                                                uploadTitle: 'Subir archivos seleccionados',
                                                msgNo: 'No',
                                                msgNoFilesSelected: 'No hay archivos seleccionados',
                                                msgPaused: 'Paused',
                                                msgCancelled: 'Cancelado',
                                                msgPlaceholder: 'Seleccionar {files} ...',
                                                msgZoomModalHeading: 'Vista de la imágen',
                                                msgFileRequired: 'Debes seleccionar un archivo para subir.',
                                                msgSizeTooSmall: 'El archivo "{name}" (<b>{size} KB</b>) es demasiado pequeño y debe ser mayor de <b>{minSize} KB</b>.',
                                                msgSizeTooLarge: 'El archivo "{name}" (<b>{size} KB</b>) excede el tamaño máximo permitido de <b>{maxSize} KB</b>.',
                                                msgFilesTooLess: 'Debe seleccionar al menos <b>{n}</b> {files} a cargar.',
                                                msgFilesTooMany: 'El número de archivos seleccionados a cargar <b>({n})</b> excede el límite máximo permitido de <b>{m}</b>.',
                                                msgTotalFilesTooMany: 'You can upload a maximum of <b>{m}</b> files (<b>{n}</b> files detected).',
                                                msgFileNotFound: 'Archivo "{name}" no encontrado.',
                                                msgFileSecured: 'No es posible acceder al archivo "{name}" porque está siendo usado por otra aplicación o no tiene permisos de lectura.',
                                                msgFileNotReadable: 'No es posible acceder al archivo "{name}".',
                                                msgFilePreviewAborted: 'Previsualización del archivo "{name}" cancelada.',
                                                msgFilePreviewError: 'Ocurrió un error mientras se leía el archivo "{name}".',
                                                msgInvalidFileName: 'Caracteres no válidos o no soportados en el nombre del archivo "{name}".',
                                                msgInvalidFileType: 'Tipo de archivo no válido para "{name}". Sólo se permiten archivos de tipo "{types}".',
                                                msgInvalidFileExtension: 'Extensión de archivo no válida para "{name}". Sólo se permiten archivos "{extensions}".',
                                                msgFileTypes: {
                                                    'image': 'image',
                                                    'html': 'HTML',
                                                    'text': 'text',
                                                    'video': 'video',
                                                    'audio': 'audio',
                                                    'flash': 'flash',
                                                    'pdf': 'PDF',
                                                    'object': 'object'
                                                },
                                                msgUploadAborted: 'La carga de archivos se ha cancelado',
                                                msgUploadThreshold: 'Procesando &hellip;',
                                                msgUploadBegin: 'Inicializando &hellip;',
                                                msgUploadEnd: 'Hecho',
                                                msgUploadResume: 'Resuming upload &hellip;',
                                                msgUploadEmpty: 'No existen datos válidos para el envío.',
                                                msgUploadError: 'Upload Error',
                                                msgDeleteError: 'Delete Error',
                                                msgProgressError: 'Error',
                                                msgValidationError: 'Error de validación',
                                                msgLoading: 'Subiendo archivo {index} de {files} &hellip;',
                                                msgProgress: 'Subiendo archivo {index} de {files} - {name} - {percent}% completado.',
                                                msgSelected: '{n} {files} seleccionado(s)',
                                                msgFoldersNotAllowed: 'Arrastre y suelte únicamente archivos. Omitida(s) {n} carpeta(s).',
                                                msgImageWidthSmall: 'El ancho de la imagen "{name}" debe ser de al menos {size} px.',
                                                msgImageHeightSmall: 'La altura de la imagen "{name}" debe ser de al menos {size} px.',
                                                msgImageWidthLarge: 'El ancho de la imagen "{name}" no puede exceder de {size} px.',
                                                msgImageHeightLarge: 'La altura de la imagen "{name}" no puede exceder de {size} px.',
                                                msgImageResizeError: 'No se pudieron obtener las dimensiones de la imagen para cambiar el tamaño.',
                                                msgImageResizeException: 'Error al cambiar el tamaño de la imagen.<pre>{errors}</pre>',
                                                msgAjaxError: 'Algo ha ido mal con la operación {operation}. Por favor, inténtelo de nuevo mas tarde.',
                                                msgAjaxProgressError: 'La operación {operation} ha fallado',
                                                msgDuplicateFile: 'File "{name}" of same size "{size} KB" has already been selected earlier. Skipping duplicate selection.',
                                                msgResumableUploadRetriesExceeded:  'Upload aborted beyond <b>{max}</b> retries for file <b>{file}</b>! Error Details: <pre>{error}</pre>',
                                                msgPendingTime: '{time} remaining',
                                                msgCalculatingTime: 'calculating time remaining',
                                                ajaxOperations: {
                                                    deleteThumb: 'Archivo borrado',
                                                    uploadThumb: 'Archivo subido',
                                                    uploadBatch: 'Datos subidos en lote',
                                                    uploadExtra: 'Datos del formulario subidos '
                                                },
                                                dropZoneTitle: 'Arrastre y suelte aquí los archivos &hellip;',
                                                dropZoneClickTitle: '<br>(o haga clic para seleccionar {files})',
                                                fileActionSettings: {
                                                    removeTitle: 'Eliminar archivo',
                                                    uploadTitle: 'Subir archivo',
                                                    uploadRetryTitle: 'Reintentar subir',
                                                    downloadTitle: 'Descargar archivo',
                                                    zoomTitle: 'Ver detalles',
                                                    dragTitle: 'Mover / Reordenar',
                                                    indicatorNewTitle: 'No subido todavía',
                                                    indicatorSuccessTitle: 'Subido',
                                                    indicatorErrorTitle: 'Error al subir',
                                                    indicatorPausedTitle: 'Upload Paused',
                                                    indicatorLoadingTitle:  'Subiendo &hellip;'
                                                },
                                                previewZoomButtonTitles: {
                                                    prev: 'Anterior',
                                                    next: 'Siguiente',
                                                    toggleheader: 'Mostrar encabezado',
                                                    fullscreen: 'Pantalla completa',
                                                    borderless: 'Modo sin bordes',
                                                    close: 'Cerrar vista detallada'
                                                }
                                            };
                                        })(window.jQuery);
                                    </script>
                                @endsection                     
@endsection