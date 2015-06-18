@extends('tmpl.public')
@section('_header')
    <link rel="stylesheet" href="/bower_components/swiper/dist/css/swiper.min.css">
@stop

@section('content')
    <main class="main page">
        <!-- <section class="flexslider--tom">
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
        </section> -->
        <!-- Slider main container -->
        <section class="row no__row__padding"> 
            <div class="columns end"> 
                <div class="swiper-container">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach($h_data as $h_image)
                            @foreach($h_image->Images as $image)
                                <div class="swiper-slide" data-bg-alignment="center" data-color-scheme="light" data-x-pos="centered" data-y-pos="middle" style="background-image: url(/uploads/{{ $image->name }}); ">
                                    <div class="swiper__content">
                                        {{ $h_image->name }}
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                    
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    
                    <!-- If we need scrollbar -->
                    <!-- <div class="swiper-scrollbar"></div> --> 
                </div>
            </div>
        </section>
        <section class="row">
            <div class="columns small-12 medium-6 large-4 xlarge-2 end"> 
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            <h1 class"brand__name">So Naughty But Nice</h1>
            </div>
        </section>
    </main>
@stop

@section('_footer')
    <!-- <script  type="text/javascript" src="/js/flexslider.js"></script> -->
    <script src="/bower_components/swiper/dist/js/swiper.min.js"></script>
    <script type="text/javascript" src="/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
    <script>        
        var mySwiper = new Swiper ('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: '.swiper-pagination',

        // Navigation arrows
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',

        // And if we need scrollbar
        // scrollbar: '.swiper-scrollbar',
        })        
    </script>
    <script>
        // function _flexslider(){
        //   $('.flexslider').flexslider({
        //     animation: "slide",
        //     animationLoop: false,
        //     pauseOnHover: true,
        //     smoothHeight: true,
        //     itemWidth: 280,
        //     itemMargin: 0,
        //     minItems: 1,
        //     maxItems: 1,
        //   });
        // }
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

