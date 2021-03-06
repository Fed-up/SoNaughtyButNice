<?php
  // header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  // header("Cache-Control: post-check=0, pre-check=0", false);
  // header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
	<head>
    	<title>{{ $title or "So Naughty But Nice" }}</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" > 
      @yield('_header')
      <!-- Dev site css --> 
      <link rel="stylesheet" type="text/css" href="../sass/compiled_css/dev_snbn.css"> 
      
      <!-- Live site css  -->
      <!-- <link rel="stylesheet" type="text/css" href="../deploy_css/snbn.min.css">  -->

      <link rel="stylesheet" type="text/css" href="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/css/no-theme/jquery-ui-1.10.4.custom.min.css"/>
  </head>


  <body>
    <div class="content-slot">
    
    <div id="container">
        <div id="header">
            @include('public.header')
        </div>
        <div id="body">
            @yield('content')  
        </div>
        <div id="footer">
            @include('public.footer') 
        </div>
    </div>

    </div>

    <aside 
        id="panel--right" 
        class="panel--right"> <!-- //panel -->
        <div id="navigation" class="">

            @if (Auth::check())

            @else
                {{ Form::open(array('url' => 'login', 'class' => 'form-signin form-signin--swipe')) }}
                <a href="/signup" class="side__member__button">Become a Member</a> 
                <h3 class="side__login__header">Join Us Today</h3> 

                <div class="form__input--side--login form__input--side--login--swipe">
                    {{ Form::label('email', 'Email: ', array('class' => 'input__name--white')) }}
                    {{ Form::email('email', '', array('placeholder'=>'Email', 'class'=>'form-control' ) ) }}
                </div>
                <div class="form__input--side--login form__input--side--login--swipe">
                    {{ Form::label('password', 'Password: ', array('class' => 'input__name--white')) }}
                    {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control' ) ) }}
                </div>

                {{ Form::submit('Login', array('class' => 'side__login__button--swipe')) }}

                {{ Form::close() }}
            @endif 




            <nav class="">
                <a href="/" class="{{((Request::segment(0) === '')? 'side--nav navTab_active ' : 'side--nav')}}">Home</a>
                <!-- <a class="side--nav" href="/">{{ ((Auth::guest())? '' : ((Auth::user()->admin == 1)? HTML::link('admin', 'Profile') : HTML::link('profile', 'Profile'))) }}</a> -->
                {{ ((Auth::guest())? '' : ((Auth::user()->admin == 1)? HTML::link('admin', 'Profile', array('class' => 'side--nav')) : HTML::link('profile', 'Profile', array('class' => 'side--nav')))) }}
                <a class="{{((Request::segment(1) === 'collections')? 'side--nav navTab_active' : 'side--nav')}}" href="/collections">Collections</a>
                <a class="{{((Request::segment(1) === 'recipes')? 'side--nav navTab_active' : 'side--nav')}}" href="/recipes">@if(Auth::check())@if(Auth::user()->user_type != 'B2B')Recipes @else Nutritents @endif @else Recipes @endif</a>
                <a class="{{((Request::segment(1) === 'ingredients')? 'side--nav navTab_active' : 'side--nav')}}" href="/ingredients">Ingredients</a>
                <a class="{{((Request::segment(1) === 'events')? 'side--nav navTab_active' : 'side--nav')}}" href="/events">Events</a>
                <a class="{{((Request::segment(1) === 'catering')? 'side--nav navTab_active' : 'side--nav')}}" href="/catering">Catering</a>
            </nav>
        </div>
    </aside><!-- /panel -->


      
    

    
    
    

    
    <!-- JS 
    ====================================  -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/jquery-touchswipe/jquery.touchSwipe.min.js"></script>
    <script src="/bower_components/foundation/js/foundation/foundation.js"></script>
    <script src="/bower_components/foundation/js/foundation/foundation.tab.js"></script>
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5439fba30c5e8a76" async></script>

    @yield('_footer')
    <script>


      $(function() {   
        $(document).foundation();
        //Enable swiping...
        $("body").swipe( {
          //Generic swipe handler for all directions
          swipe: function(event, direction, distance, duration, fingerCount, fingerData) {

            if(direction == "left"){
              $("body").addClass("showPanel")
            }
            else if(direction == "right"){
              $("body").removeClass("showPanel")
            }
          },
          allowPageScroll: "vertical",
          excludedElements: "button, input, select, textarea, .noSwipe"
        });


        //Trigger menu
        $(".trigger-menu").click(function($event){

          console.log('hi');

          if($( "body" ).hasClass( "showPanel" )){
            $("body").removeClass("showPanel")
          }
          else if(!$( "body" ).hasClass( "showPanel" )){
            $("body").addClass("showPanel");
            $event.stopPropagation();
          }
        });

        //Click to close menu
        $(".page").click(function($event) {
          console.log(".page click");
          if($( "body" ).hasClass( "showPanel" )){
            $("body").removeClass("showPanel");
            $event.preventDefault();
          }
        });
      });

    </script> 
    
    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-N294FC"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N294FC');</script>
    <!-- End Google Tag Manager -->


    </body>
</html>
