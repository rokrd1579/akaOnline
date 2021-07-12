<footer class="revealed">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_1">Páginas rápidas</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="{{ route('about')}}">Acerca de nosotros</a></li>
                        <li><a href="{{route('help')}}">Atención a cliente</a></li>
                        @if(Auth::user() != null)
                        <li><a href="{{route('profile')}}">Mi perfil</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_2">Categorías</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        <ul>
                            @foreach($categoriesMenu as $category)
                            <li><a href="{{route('catalogue_categories', ['category'=> $category->slug])}}">{{$category->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_3">Contactanos</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="ti-home"></i>Costera Miguel Aleman<br>Acapulco Gro.</li>
                        <li><i class="ti-headphone-alt"></i>+55 5555555555</li>
                        <li><i class="ti-email"></i><a href="#0">AcaOnline@gmail.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="follow_us">
                    <h5>Siguenos en</h5>
                    <ul>
                        <li><a href="#"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('img/twitter_icon.svg')}}" alt="" class="lazy"></a></li>
                        <li><a href="#"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('img/facebook_icon.svg')}}" alt="" class="lazy"></a></li>
                        <li><a href="#"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('img/instagram_icon.svg')}}" alt="" class="lazy"></a></li>
                        <li><a href="#"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('img/youtube_icon.svg')}}" alt="" class="lazy"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /row-->
    <hr>
    <div class="row add_bottom_25">
        <div class="col-lg-6">
            <ul class="footer-selector clearfix">
                <li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{asset('img/cards_all.svg')}}" alt="" width="198" height="30" class="lazy"></li>
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="additional_links">
                <li><a href="{{route('terms_conditions')}}">Términos y condiciones</a></li>
                <li><a href="{{route('notice_privacy')}}">Aviso de privacidad</a></li>
                <li><span>© 2021 AcaOnline</span></li>
            </ul>
        </div>
    </div>
    </div>
</footer>