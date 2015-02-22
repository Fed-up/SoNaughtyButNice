@extends('tmpl.public')



@section('content')


    <section class="page">
        <nav class="tabs subnav" data-tab data-options="deep_linking:true; scroll_to_content: false">
            <h2 class="content-title--main content__title--main--tabs active"><a class="tab__link" href="#events">Events</a></h2> |
            <h2 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#myevents">My Events</a></h2>
        </nav>
        <section class="tabs-content"> 
            <div id="events" class="row content-boxes__wrapper content active">
                @if($e_count != 'empty')
                    @foreach($eData as $event)
                    <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                        <article class="content-box">
                            <div class="row collapse">

                                <a href="/event/{{$event->id}}" class="columns small-4 medium-12 end">
                                  <img src="/uploads/{{ $event_image[$event->id] }}" />
                                </a>

                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/event/{{$event->id}}" class="content-box__copy__inner">
                                            <h5 class="content-box__title">{{$event->name}}</h5>
                                            <p class="content-box__summary--display">{{$event->date}}&nbsp;&nbsp;</p>
                                            <p class="content-box__summary--display">{{$event->time}}</p>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                    @endforeach
                @else
                    <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                        <div class="section section--form" >
                            <h2 class="page-header">Currently you are not attending any events..</h1>
                            <h4 class="promo__text">Please <a class="content-link" href="/signup">join us</a> to be notified of our next event =)</h4>
                            <p class="promo__text">Would you like to see our latest <a class="content-link" href="/recipes">recipes?</a></p>
                        </div>
                        <div class="footer__push"></div>
                    </section>
                @endif
            </div>
            <div id="myevents" class="row content-boxes__wrapper content">
                @if (Auth::check())
                    @if($e_count != 'empty')
                        @if ($paid == $confirm_paid)
                            @foreach($pEvents as $event)
                            <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                                <article class="content-box">
                                    <div class="row collapse">

                                        
                                        <a href="/event/{{$event->id}}" class="columns small-4 medium-12 end">
                                          <img src="/uploads/{{ $event_image[$event->id] }}" />
                                        </a>
                                        

                                        <section class="columns small-8 medium-12">
                                            <div class="content-box__copy">
                                                <a href="/event/{{$event->id}}" class="content-box__copy__inner">
                                                    <h5 class="content-box__title">{{$event->name}}</h5>
                                                    <p class="content-box__summary--display">{{$event->date}}&nbsp;&nbsp;</p>
                                                    <p class="content-box__summary--display">{{$event->time}}</p>
                                                </a>
                                            </div>
                                        </section>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        @else
                            <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                                <div class="section section--form" >
                                    <h2 class="page-header">Currently you are not attending any events..</h1>
                                    <h4 class="promo__text">There is an event on the horizon.. Shhh!! Don't tell anyone ;)</h4>
                                    <p class="promo__text">5 desserts being showcased.. <a class="content-link" href="/event/{{$eData[0]->id}}">Let's celebrate!</a></p>
                                </div>
                                <div class="footer__push"></div>
                            </section>
                        @endif
                    @else
                        <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                            <div class="section section--form" >
                                <h2 class="page-header">Currently you are not attending any events..</h1>
                                <h4 class="promo__text">Please <a class="content-link" href="/signup">join us</a> to be notified of our next event =)</h4>
                                <p class="promo__text">Would you like to see our latest <a class="content-link" href="/recipes">recipes?</a></p>
                            </div>
                            <div class="footer__push"></div>
                        </section>
                    @endif
                @else
                    <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                        <div class="section section--form" >
                            <h1 class="page-header">There is an event on the horizon.. Shhh!! Don't tell anyone ;)</h1>
                            <p class="promo__text">5 desserts being showcased.. <a class="content-link" href="/event/{{$eData[0]->id}}">Let's celebrate!</a></p>
                            <p class="promo__text">Please <a class="content-link" href="/login">Login</a> to save a seat at the event</p>
                        </div>
                        <div class="footer__push"></div>
                    </section>
                @endif






                
            </div>

        </section>
    </section><!--End Band Content-->
@stop


@section('_footer')
	<script type="text/javascript" src="/public/js/flexslider.js"></script>
	<script type="text/javascript" src="/public/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
@stop



<!-- <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                    <div class="section section--form" >
                        <h1 class="page-header">There is an event on the horizon.. Shhh!! Don't tell anyone ;)</h1>
                        <p class="promo__text">5 desserts being showcased.. Let's celebrate!</p>
                    </div>
                </section> -->