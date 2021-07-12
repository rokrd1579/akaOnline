@extends('layouts.app_frontend')

@section('content')
<main>
	<div class="container margin_60_35">
	
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="write_review">
						<h1>Producto: {{ $product_name}}</h1>
						@if (Auth::check())
								<form action="{{ route('reviewcreate') }}" method="POST" onsubmit="return datos()">                                 
                                 @csrf	
								 <input type="hidden" value="{{ $product_id}}" id="product_id" name="product_id">
								
						<div class="rating_submit">
							<div class="form-group">
							<label class="d-block">¿Cu&aacutentas estrellas le das?</label>
							<span class="rating mb-0">
								<input type="radio" class="rating-input" id="5_star" name="rating" value="5" ><label for="5_star" class="rating-star" ></label>
								<input type="radio" class="rating-input" id="4_star" name="rating" value="4"><label for="4_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="3_star" name="rating" value="3"><label for="3_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="2_star" name="rating" value="2"><label for="2_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="1_star" name="rating" value="1"><label for="1_star" class="rating-star"></label>
							</span>
							</div>
					     </div>
						

						<!-- /rating_submit -->
						<div class="form-group">
							<label>Titulo de la reseña</label>
							<input class="form-control" id="title" name="title" type="text" placeholder="Describe el producto en una frase" required minlength="1" maxlength="50">
						</div>
						<div class="form-group">
							<label>Tu reseña</label>
							<textarea class="form-control" id="review" name="review" style="height: 180px;" placeholder="Escribe aqui tu reseña" required minlength="1" maxlength="190"></textarea>
						</div>
						
					<!--	<div class="form-group">
							<label>Add your photo (optional)</label>
							<div class="fileupload"><input type="file" name="fileupload" accept="image/*"></div>
						</div> -->
					<!--	<div class="form-group">
							<div class="checkboxes float-left add_bottom_15 add_top_15">
								<label class="container_check">Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</div>
						</div>   -->

						<div id="container">
						<button id="btn" href="" class="btn_1">Enviar</button>
						
						</div>
						</form> 
								@endif
					</div>
				</div>
		</div>
		<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	@endsection

@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/manual/review.js')}}"></script>



@endpush