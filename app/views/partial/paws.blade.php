@extends('tmpl.public')

@section('__header') 
@stop  

@section('content')   
<div class="band content">
    <div class="container "> 
        <h2 class="content__title content__title--main">4 Paws</h2> 
        <div class="row">
            <section class="columns small-12">
                <div class="header-23-sub">
                    <div id="bgvideo" class="background">
                        <video autoplay loop poster="polina.jpg" id="bgvid">
                            <source src="polina.webm" type="video/webm">
                            <source src="/videos/dogshow.mp4" type="video/mp4">
                        </video>
                    </div>
                    <button id="vidpause">Pause</button>
                    <div id="video_controls">
                       <button id="mutebtn">mute</button>
                    </div> 
                </div>
            </section>
            <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                <div class="section section--form" >
                    
                </div>
            </section>
            <div class="footer__push"></div>  
        </div>
    </div>
</div>
@stop