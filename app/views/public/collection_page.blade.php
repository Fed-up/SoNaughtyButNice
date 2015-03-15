@extends('tmpl.public')



@section('content')
    <section class="page">
         <h2 class="content__title content__title--main"><a class="content__title--link" href="/collections">{{$cData[0]->name }}</a></h2>

        <div class="row content-boxes__wrapper">
            @foreach($cData as $collection)
                @foreach($collection->menuRecipes as $recipe)
                    <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                        <article class="content-box">
                            <div class="row collapse">

                                

                                    <!-- <pre>{{print_r($cImage[$recipe->id])}}</pre> -->

                                    <a href="/recipe/{{$recipe->id}}" class="columns small-4 medium-12 end">

                                      <img src="/uploads/{{ $cImage[$recipe->id] }}" />
                                    </a>
                                
                               

                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/recipe/{{$recipe->id}}" class="content-box__copy__inner">
                                            <h5 class="content-box__title">{{$recipe->name}}</h5>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                @endforeach
            @endforeach
        </div>
    </section><!--End Band Content-->



    
@stop

@section('_footer')
	<script type="text/javascript" src="/public/js/flexslider.js"></script>
	<script type="text/javascript" src="/public/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
@stop