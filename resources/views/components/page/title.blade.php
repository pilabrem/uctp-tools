<!-- start banner Area
     Affiche le titre de la page et le lien vers cette dernière
 -->
<section class="banner-area relative" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white" style="text-align: center;">
                    {{$slot}}
                </h1>
                <p class="text-white link-nav" style="text-align: center;">
                    <a href="{{route('home')}}">Accueil </a>
                    <span class="lnr lnr-arrow-right"></span>
                    {{$link}}
                </p>
            </div>
        </div>
    </div>
</section>