@extends('tmpl.public')



@section('content')


    <section class="page">
        <h2 class="content__title content__title--main"><a class="content__title--link" href="/profile">{{ Auth::user()->fname }}'s Events</a></h2>
        <div class="row content-boxes__wrapper content">
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
                                                <p class="content-box__summary--display">{{$event->date}}</p>
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
                                <p class="promo__text">5 desserts being showcased.. <a class="content-link" href="/event/{{$eData[0]->id}}">{{$eData[0]->name}}</a></p>
                            </div>                        
                        </section>
                    @endif
                @else
                    <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                        <div class="section section--form" >
                            <h2 class="page-header">Currently there are no upcoming events..</h1>
                            <h4 class="promo__text">Please <a class="content-link" href="/signup">join us</a> to be notified of our next event =)</h4>
                            <p class="promo__text">Would you like to see our latest <a class="content-link" href="/recipes">recipes?</a></p>
                        </div>
                    </section>
                @endif
            @else
                @if($e_count != 'empty')
                    <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                        <div class="section section--form" >
                            <h1 class="page-header">There is an event on the horizon.. Shhh!! Don't tell anyone ;)</h1>
                            <p class="promo__text">5 desserts being showcased.. <a class="content-link" href="/event/{{$eData[0]->id}}">{{$eData[0]->name}}</a></p>
                            <p class="promo__text">Please <a class="content-link" href="/login">Login</a> to save a seat at the event</p>
                        </div>
                    </section>
                @else
                    <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                        <div class="section section--form" >
                            <h2 class="page-header">Currently there are no upcoming events..</h1>
                            <h4 class="promo__text">Please <a class="content-link" href="/signup">join us</a> to be notified of our next event =)</h4>
                            <p class="promo__text">Would you like to see our latest <a class="content-link" href="/recipes">recipes?</a></p>
                        </div>
                    </section>
                @endif
            @endif
        </div>
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