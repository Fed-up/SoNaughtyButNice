@extends('tmpl.public')



@section('content')
    <section class="page">  
        <nav class="tabs subnav subnav--centre" data-tab data-options="deep_linking:true; scroll_to_content: false">
            <h2 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#recipes">@if(Auth::check())@if(Auth::user()->user_type != 'B2B')Recipes @else Nutritents @endif @else Recipes @endif</a></h2>
            @if(Auth::check())
                @if(Auth::user()->user_type != 'B2B')
                | <h2 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#myrecipes">Exclusive Recipes</a></h2>
                @endif
            @else
                | <h2 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#myrecipes">Exclusive Recipes</a></h2>
            @endif 
            <h2 class="subnav"></h2>


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
                                        <a href="/recipe/{{$recipe->id}}" class="content-box__copy__inner--recipe"><h5 class="content-box__title">{{$recipe->name}}</h5></a>
                                        @if(!empty($category[$recipe->id]))
                                            <a href="/collection/{{$category[$recipe->id]->id}}" class="content-box__tag">{{$category[$recipe->id]->name}}</a>
                                        @else
                                            <a href="/collections" class="content-box__tag">Collections</a>
                                        @endif
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <div id="ae" class="row content-boxes__wrapper content">
                @foreach($aeData as $ae)
                @if($ae->active == 1)
                    <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                        <article class="content-box">
                            <div class="row collapse">                                   
                                <a href="/recipe/{{$ae->id}}" class="columns small-4 medium-12 end">
                                  <img src="/uploads/{{ $aeImage[$ae->id] }}" />
                                </a>
                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/recipe/{{$ae->id}}" class="content-box__copy__inner--recipe"><h5 class="content-box__title">{{$ae->name}}</h5></a>
                                        @if(!empty($category[$ae->id]))
                                            <a href="/collection/{{$category[$ae->id]->id}}" class="content-box__tag">{{$category[$ae->id]->name}}</a>
                                        @else
                                            <a href="/collections" class="content-box__tag">Collection</a>
                                        @endif
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                @endif
                @endforeach
            </div>

            <div id="fj" class="row content-boxes__wrapper content">
                @foreach($fjData as $fj)
                @if($fj->active == 1)
                    <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                        <article class="content-box">
                            <div class="row collapse">                                   
                                <a href="/recipe/{{$fj->id}}" class="columns small-4 medium-12 end">
                                  <img src="/uploads/{{ $fjImage[$fj->id] }}" />
                                </a>
                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/recipe/{{$fj->id}}" class="content-box__copy__inner--recipe"><h5 class="content-box__title">{{$fj->name}}</h5></a>
                                        @if(!empty($category[$fj->id]))
                                            <a href="/collection/{{$category[$fj->id]->id}}" class="content-box__tag">{{$category[$fj->id]->name}}</a>
                                        @else
                                            <a href="/collections" class="content-box__tag">Collection</a>
                                        @endif
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                @endif
                @endforeach
            </div>

            <div id="ko" class="row content-boxes__wrapper content">
                @foreach($koData as $ko)
                @if($ko->active == 1)
                    <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                        <article class="content-box">
                            <div class="row collapse">                                   
                                <a href="/recipe/{{$ko->id}}" class="columns small-4 medium-12 end">
                                  <img src="/uploads/{{ $koImage[$ko->id] }}" />
                                </a>
                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/recipe/{{$ko->id}}" class="content-box__copy__inner--recipe"><h5 class="content-box__title">{{$ko->name}}</h5></a>
                                        @if(!empty($category[$ko->id]))
                                            <a href="/collection/{{$category[$ko->id]->id}}" class="content-box__tag">{{$category[$ko->id]->name}}</a>
                                        @else
                                            <a href="/collections" class="content-box__tag">Collection</a>
                                        @endif
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                @endif
                @endforeach
            </div>

            <div id="pt" class="row content-boxes__wrapper content">

                @foreach($ptData as $pt)
                @if($pt->active == 1)
                    <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                        <article class="content-box">
                            <div class="row collapse">                                   
                                <a href="/recipe/{{$pt->id}}" class="columns small-4 medium-12 end">
                                  <img src="/uploads/{{ $ptImage[$pt->id] }}" />
                                </a>
                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/recipe/{{$pt->id}}" class="content-box__copy__inner--recipe"><h5 class="content-box__title">{{$pt->name}}</h5></a>
                                        @if(!empty($category[$pt->id]))
                                            <a href="/collection/{{$category[$pt->id]->id}}" class="content-box__tag">{{$category[$pt->id]->name}}</a>
                                        @else
                                            <a href="/collections" class="content-box__tag">Collection</a>
                                        @endif
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                @endif
                @endforeach
            </div>

            <div id="uz" class="row content-boxes__wrapper content">
                
                @foreach($uzData as $uz)
                @if($uz->active == 1)
                    <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                        <article class="content-box">
                            <div class="row collapse">                                   
                                <a href="/recipe/{{$uz->id}}" class="columns small-4 medium-12 end">
                                  <img src="/uploads/{{ $uzImage[$uz->id] }}" />
                                </a>
                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/recipe/{{$uz->id}}" class="content-box__copy__inner--recipe"><h5 class="content-box__title">{{$uz->name}}</h5></a>
                                        @if(!empty($category[$uz->id]))
                                            <a href="/collection/{{$category[$uz->id]->id}}" class="content-box__tag">{{$category[$uz->id]->name}}</a>
                                        @else
                                            <a href="/collections" class="content-box__tag">Collection</a>
                                        @endif
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                @endif
                @endforeach
            </div>


            <div id="myrecipes" class="row content-boxes__wrapper content">
                @if(isset($exrData))
                    @foreach($exrData as $exIndex=>$exRecipe)
                    <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                        <article class="content-box">
                            <div class="row collapse">

                               
                                <a href="/recipe/{{$exRecipe->id}}" class="columns small-4 medium-12 end">
                                  <img src="/uploads/{{ $exr_image[$exRecipe->id] }}" />
                                </a>
                                

                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/recipe/{{$exRecipe->id}}" class="content-box__copy__inner--recipe">
                                            <h5 class="content-box__title">{{$exRecipe->name}}</h5>
                                            <!-- <p class="content-box__summary">{{$recipe->summary}}</p> -->
                                        </a>
                                        
                                        
                                        @if(!empty($category[$exRecipe->id]))
                                            <a href="/collection/{{$category[$exRecipe->id]->id}}" class="content-box__tag">{{$category[$exRecipe->id]->name}}</a>
                                        @else
                                            <a href="/collections" class="content-box__tag">Collection</a>
                                        @endif

                                        
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                    @endforeach
                @else
                    <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                    <div class="section section--form" >
                        <h1 class="page-header">exclusive recipes coming soon..</h1>
                    </div>
                    </section>
                @endif
            </div>

            

        </section>

                <h3 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#ae">A - E</a></h3> |
                <h3 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#fj">F - J</a></h3> |
                <h3 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#ko">K - O</a></h3> |
                <h3 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#pt">P - T</a></h3> |
                <h3 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#uz">U - Z</a></h3> 
        </nav>
        <!-- <h2 class="content__title content__title--main"><a class="content__title--link" href="/recipes">More Recipes</a></h2> -->
        <!-- <div class="footer__push"></div> -->
  	</section><!--End Band Content-->
@stop
{{-- '<pre>'; print_r($recipe->MenuCategories->name); echo '</pre>'; --}}

@section('_footer')
	<script type="text/javascript" src="/public/js/flexslider.js"></script>
	<script type="text/javascript" src="/public/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
@stop