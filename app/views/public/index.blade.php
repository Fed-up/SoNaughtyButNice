@extends('tmpl.public')

@section('content')
<main class="main page">
    @if (Auth::check())
        <h2 class="content__title content__title--homepage"><a class="content__title--link" href="/profile">Welcome home {{ Auth::user()->fname }}</a></h2>
    @endif
    <section class="flexslider--tom">
        <div class="flexslider flex-viewport">
            <ul class="slides">
                @foreach($h_data as $h_image)
                    {{--'<pre>'; dd($h_data->first()->id); echo '</pre>';--}}
                    @foreach($h_image->Images as $image)
                        <li> 
                            <figure>
                                <a href="{{$h_image->link}}">
                                    <img src="/uploads/{{ $hImage[$h_image->id] }}" />
                                </a>
                            </figure>
                        </li>
                    @endforeach
                @endforeach   
            </ul>
        </div>
    </section>

        

    <section class="row content-boxes__wrapper">
        @foreach($iData as $ingredient)
        
        <div class="columns small-12 medium-6 large-4 xlarge-2 end">
            <a href="/ingredients" class="content-box content-box--homepage">
                <div class="content-box__image"  style="background: url(/uploads/{{ $iImage[$ingredient->id] }}) center center; background-size:cover;"></div>
                <h5 class="content-box__title content-box__title--homepage">Ingredients</h5>
            </a>
        </div>
        @endforeach

        @foreach($rData as $recipe)
        <div class="columns small-12 medium-6 large-4 xlarge-2 end">
            <a href="/recipes" class="content-box content-box--homepage">
                <div class="content-box__image"  style="background: url(/uploads/{{ $rImage[$recipe->id] }}) center center; background-size:cover;"></div>
                <h5 class="content-box__title content-box__title--homepage">@if(Auth::check())@if(Auth::user()->user_type != 'B2B')Recipes @else Nutritents @endif @else Recipes @endif</h5>
            </a>
        </div>
        @endforeach

        @foreach($collections as $index=>$collection)
        <div class="columns small-12 medium-6 large-4 xlarge-2 end">
            <a href="/collections" class="content-box content-box--homepage">
                @if($collection_check == 1)
                <div class="content-box__image"  style="background: url(/uploads/{{ $cImage[$collection->id] }}) center center; background-size:cover;"></div>   
                @else
                <div class="content-box__image"  style="background: url(/uploads/{{ $cImage }}) center center; background-size:cover;"></div>   
                @endif
                <h5 class="content-box__title content-box__title--homepage">Collections</h5>
            </a>
        </div>
        @endforeach

        @if($e_count != 'empty')
            @foreach($eData as $event)
            <div class="columns small-12 medium-6 large-4 xlarge-2 end">
                 
                @if($e_count == 1) 
                    <a href="/events"  class="content-box content-box--homepage">
                    <div class="content-box__image"  style="background: url(/uploads/{{ $eImage[$event->id] }}) center center; background-size:cover;"></div> 
                @else 
                    <a href="/events" class="content-box content-box--homepage">
                    <div class="content-box__image"  style="background: url(/uploads/{{ $eImage[$event->id] }}) center center; background-size:cover;"></div>
                @endif
                <h5 class="content-box__title content-box__title--homepage">Events</h5>
                </a>
            </div>
            @endforeach
        @else
            <div class="columns small-12 medium-6 large-4 xlarge-2 end">
                <a href="/events"  class="content-box content-box--homepage">
                    <div class="content-box__image"  style="background: url(/uploads/{{ $eImage }}) center center; background-size:cover;"></div>
                    <h5 class="content-box__title content-box__title--homepage">Events</h5>
                </a>
            </div>
            <!-- <a href="/events" class="content-box content-box--homepage">
            <div class="content-box__image"  style="background: url(/uploads/{{ $eImage }}) center center; background-size:cover;"></div>
            <h5 class="content-box__title content-box__title--homepage">Upcoming Events</h5> -->
        @endif

        @foreach($pData as $catering)
        <div class="columns small-12 medium-6 large-4 xlarge-2 end">
            <a href="/catering" class="content-box content-box--homepage">
                <div class="content-box__image"  style="background: url(/uploads/{{ $pImage[$catering->id] }}) center center; background-size:cover;"></div>
                <h5 class="content-box__title content-box__title--homepage">Catering</h5>
            </a>
        </div>
        @endforeach

        <div class="columns small-12 medium-6 large-4 xlarge-2 end">
            <a href="/signup" class="content-box content-box--homepage">
                <div class="content-box__image"  style="background: url(/images/site/join.jpg) center center; background-size:cover;"></div>
                <h5 class="content-box__title content-box__title--homepage">Login | Register</h5>
            </a>
        </div>
    </section>
</main>
@stop

@section('_footer')
    <script type="text/javascript" src="/js/flexslider.js"></script>
    <script type="text/javascript" src="/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
    <script>
        // $(window).load(function() {
        //   $('.flexslider--thumbs').flexslider({
        //     controlNav: "thumbnails",
        //     controlsContainer: "#thumbs",
        //     animationSpeed: 300,
        //     slideshow: false,
        //     directionNav: false,

        //     animation: "slide",
        //     direction: "vertical"
        //   });
        // });
    </script>
@stop
