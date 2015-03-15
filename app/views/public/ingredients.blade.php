@extends('tmpl.public')



@section('content')
    <section class="page">
        <h2 class="content__title content__title--main"><a class="content__title--link" href="/ingredients">Ingredients</a></h2>
        
        <section class="tabs-content"> 

            <div id="ingredients" class="row content-boxes__wrapper content active">
                @foreach($iData as $ingredient)
                <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                    <article class="content-box">
                        <div class="row collapse">

                            
                            <a href="/ingredient/{{$ingredient->id}}" class="columns small-4 medium-12 end">
                              <img src="/uploads/{{ $iImage[$ingredient->id] }}" />
                            </a>
                            

                            <section class="columns small-8 medium-12">
                                <div class="content-box__copy">
                                    <a href="/ingredient/{{$ingredient->id}}" class="content-box__copy__inner">
                                        <h5 class="content-box__title">{{$ingredient->name}}</h5>
                                        <!-- <p class="content-box__summary">{{$ingredient->summary}}</p> -->
                                    </a>
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

                                
                                <a href="/ingredient/{{$ae->id}}" class="columns small-4 medium-12 end">
                                  <img src="/uploads/{{ $aeImage[$ae->id] }}" />
                                </a>
                                

                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/ingredient/{{$ae->id}}" class="content-box__copy__inner">
                                            <h5 class="content-box__title">{{$ae->name}}</h5>
                                            <!-- <p class="content-box__summary">{{$ingredient->summary}}</p> -->
                                        </a>
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

                                    
                                    <a href="/ingredient/{{$fj->id}}" class="columns small-4 medium-12 end">
                                      <img src="/uploads/{{ $fjImage[$fj->id] }}" />
                                    </a>
                                    

                                    <section class="columns small-8 medium-12">
                                        <div class="content-box__copy">
                                            <a href="/ingredient/{{$fj->id}}" class="content-box__copy__inner">
                                                <h5 class="content-box__title">{{$fj->name}}</h5>
                                                <!-- <p class="content-box__summary">{{$ingredient->summary}}</p> -->
                                            </a>
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

                                    
                                    <a href="/ingredient/{{$ko->id}}" class="columns small-4 medium-12 end">
                                      <img src="/uploads/{{ $koImage[$ko->id] }}" />
                                    </a>
                                    

                                    <section class="columns small-8 medium-12">
                                        <div class="content-box__copy">
                                            <a href="/ingredient/{{$ko->id}}" class="content-box__copy__inner">
                                                <h5 class="content-box__title">{{$ko->name}}</h5>
                                                <!-- <p class="content-box__summary">{{$ingredient->summary}}</p> -->
                                            </a>
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

                                    
                                    <a href="/ingredient/{{$pt->id}}" class="columns small-4 medium-12 end">
                                      <img src="/uploads/{{ $ptImage[$pt->id] }}" />
                                    </a>
                                    

                                    <section class="columns small-8 medium-12">
                                        <div class="content-box__copy">
                                            <a href="/ingredient/{{$pt->id}}" class="content-box__copy__inner">
                                                <h5 class="content-box__title">{{$pt->name}}</h5>
                                                <!-- <p class="content-box__summary">{{$ingredient->summary}}</p> -->
                                            </a>
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

                                    
                                    <a href="/ingredient/{{$uz->id}}" class="columns small-4 medium-12 end">
                                      <img src="/uploads/{{ $uzImage[$uz->id] }}" />
                                    </a>
                                    

                                    <section class="columns small-8 medium-12">
                                        <div class="content-box__copy">
                                            <a href="/ingredient/{{$uz->id}}" class="content-box__copy__inner">
                                                <h5 class="content-box__title">{{$uz->name}}</h5>
                                                <!-- <p class="content-box__summary">{{$ingredient->summary}}</p> -->
                                            </a>
                                        </div>
                                    </section>
                                </div>
                            </article>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
        
        <nav class="tabs subnav subnav--centre" data-tab data-options="deep_linking:true; scroll_to_content: false">
            <h3 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#ae">A - E</a></h3> |
            <h3 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#fj">F - J</a></h3> |
            <h3 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#ko">K - O</a></h3> |
            <h3 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#pt">P - T</a></h3> |
            <h3 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#uz">U - Z</a></h3> 
        </nav>
        <!-- <h2 class="content__title content__title--main"><a class="content__title--link" href="/ingredients">More Ingredients</a></h2> -->
    </section><!--End Band Content-->
@stop

@section('_footer')
	<script type="text/javascript" src="/public/js/flexslider.js"></script>
	<script type="text/javascript" src="/public/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
@stop