@extends('tmpl.public')



@section('content')

    <section class="page">
        <nav class="tabs subnav" data-tab data-options="deep_linking:true; scroll_to_content: false">
            <h2 class="content-title--main content__title--main--tabs active"><a class="tab__link" href="#collections">Collections</a></h2> |
            <h2 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#mycollections">My Collections</a></h2>
        </nav>
        <section class="tabs-content"> 

            <div id="collections" class="row content-boxes__wrapper content active">
                @foreach($collections as $index=>$collection)
                @if(empty($collection))
                    
                @else
                    <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                        <article class="content-box">
                            <div class="row collapse">

                                
                                <a href="/collection/{{$collection->id}}" class="columns small-4 medium-12 end">
                                  <img src="/uploads/{{ $cImage[$collection->id] }}" />
                                </a>
                               

                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/collection/{{$collection->id}}" class="content-box__copy__inner">
                                            <h5 class="content-box__title">{{$collection->name}}</h5>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                @endif
                @endforeach
            </div>
            <div id="mycollections" class="row content-boxes__wrapper content">
                <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                <div class="section section--form" >
                    <h1 class="page-header">exclusive recipes coming soon..</h1>
       
                </div>
                </section>
            </div>
        </section>
        <h2 class="content__title content__title--main"><a class="content__title--link" href="/collections">More Collections</a></h2>
    </section><!--End Band Content-->
        
        
    	   
@stop

@section('_footer')
	<script type="text/javascript" src="/public/js/flexslider.js"></script>
	<script type="text/javascript" src="/public/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
@stop