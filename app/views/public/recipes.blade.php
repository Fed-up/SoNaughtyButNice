@extends('tmpl.public')



@section('content')
    <section class="page">
        <nav class="tabs subnav" data-tab data-options="deep_linking:true; scroll_to_content: false">
            <h2 class="content-title--main content__title--main--tabs active"><a class="tab__link" href="#recipes">Recipes</a></h2> |
            <h2 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#myrecipes">My Recipes</a></h2>
        </nav>
        <section class="tabs-content"> 

            <div id="recipes" class="row content-boxes__wrapper content active">
                @foreach($rData as $index=>$recipe)
                <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                    <article class="content-box">
                        <div class="row collapse">

                           
                            <a href="/recipe/{{$recipe->id}}" class="columns small-4 medium-12 end">
                              <img src="/uploads/{{ $rImage[$recipe->id] }}" />
                            </a>
                            

                            <section class="columns small-8 medium-12">
                                <div class="content-box__copy">
                                    <a href="/recipe/{{$recipe->id}}" class="content-box__copy__inner--recipe">
                                        <h5 class="content-box__title">{{$recipe->name}}</h5>
                                        <!-- <p class="content-box__summary">{{$recipe->summary}}</p> -->
                                    </a>
                                    
                                    
                                    @if(!empty($category[$recipe->id]))
                                        <a href="/collection/{{$category[$recipe->id]->id}}" class="content-box__tag">{{$category[$recipe->id]->name}}</a>
                                    @else
                                        <a href="/collections" class="content-box__tag">Collection</a>
                                    @endif

                                    
                                </div>
                            </section>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
            <div id="myrecipes" class="row content-boxes__wrapper content">
                <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                <div class="section section--form" >
                    <h1 class="page-header">exclusive recipes coming soon..</h1>
       
                </div>
                </section>
            </div>

        </section>
        <h2 class="content__title content__title--main"><a class="content__title--link" href="/recipes">More Recipes</a></h2>
  	</section><!--End Band Content-->
@stop
{{-- '<pre>'; print_r($recipe->MenuCategories->name); echo '</pre>'; --}}

@section('_footer')
	<script type="text/javascript" src="/public/js/flexslider.js"></script>
	<script type="text/javascript" src="/public/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
@stop