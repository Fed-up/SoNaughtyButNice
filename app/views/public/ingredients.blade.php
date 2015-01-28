@extends('tmpl.public')



@section('content')
    <section class="page">
        <h2 class="content__title content__title--main"><a class="content__title--link" href="/ingredients">More Ingredients</a></h2>

        <div class="row content-boxes__wrapper">
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
        <h2 class="content__title content__title--main"><a class="content__title--link" href="/ingredients">More Ingredients</a></h2>
    </section><!--End Band Content-->
@stop

@section('_footer')
	<script type="text/javascript" src="/public/js/flexslider.js"></script>
	<script type="text/javascript" src="/public/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
@stop