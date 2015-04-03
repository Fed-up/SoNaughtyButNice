@extends('tmpl.public')



@section('content')
    <div class="page">
    @foreach($eData as $event)
        <h1 class="content__title content__title--main"><a class="tab__link" href="/events">{{$event->name}}@if($confirm_past == 1) - Past Event@endif</a></h1>
        <section class="row">
            <div class="columns small-12 medium-5 large-4">
                    <img src="/uploads/{{$hImage}}"/>
            </div>
            
            <div class="columns small-12 medium-7 large-8">
                <section class="section__box section-box--margin">
                    <p class="" > <span class="content-box__title">Date:</span>  {{$event->date}}</p><br>
                    <p class="" > <span class="content-box__title">Time:</span>  {{$event->time}}</p><br>
                    @if($confirm_past != 1)
                    <p class="" > <span class="content-box__title">Price:</span>  ${{$event->price}}</p><br>
                    <p class="" > <span class="content-box__title">Seats:</span>  {{$event->ticket_amount}}</p>
                    @endif
                    @if (Auth::check())
                        @if ($paid == $confirm_paid)
                            @for($i=0;$i<=$pCount;$i++)
                            <hr/>
                            <p class="" > <span class="content-box__title">Tickets Purchased</span> {{$quantity[$i]}}</p>
                            <p class="" > <span class="content-box__title">Purchase Date</span> {{$date[$i]}}</p>
                            <p class="" > <span class="content-box__title">Total Amount</span> ${{$purchase[$i]}}</p>
                            
                            @endfor
                        @endif
                    @endif
                </section>
            </div>

            <div class="columns small-12 medium-7 large-8">
                <section class="section-box section-box--margin">
                    @if (Auth::check())
                        @if($paid == $confirm_paid)
                            <p>Looking forward to seeeing you at the event {{ Auth::user()->fname }}</p>
                            @if($confirm_past != 1)
                                {{ Form::open(array('action' => 'CheckoutController@postAddToCart')) }}
                                    {{ Form::hidden('event_id', $event->id)}} 
                                    {{ Form::hidden('name', $event->name)}}
                                    @if(isset($hImage))
                                         {{ Form::hidden('image', $hImage ) }}
                                    @else
                                         {{ Form::hidden('image', '/images/site/logo.jpg')}}
                                    @endif
                                   
                                    {{-- Form::text('quantity', 1)--}}
                                    
                                    <div class="form-group form__group--event {{ ($errors->has('quantity')) ? 'has-error' : '' ; }}">
                                        {{ Form::label('quantity', 'Quantity: ', array('class' => ' content-title--sub ')) }}
                                        <div class="">
                                            {{ ($errors->has('quantity'))? '<p>'. $errors->first('quantity') .'</p>' : '' }}
                                            {{ Form::text('quantity', (isset($input['quantity'])? Input::old('quantity') : 1 ), array('class' => 'input__text--event')) }}
                                        </div>
                                    </div>

                                    {{ Form::hidden('price', $event->price)}}
                                    {{ Form::hidden('section', 'EVENT')}}
                                {{ Form::submit('Add to Cart', array('class' => 'form__submit__button form__submit__button--event')) }}
                            @endif
                        @else
                            @if($confirm_past != 1)
                                {{ Form::open(array('action' => 'CheckoutController@postAddToCart')) }}
                                    {{ Form::hidden('event_id', $event->id)}}
                                    {{ Form::hidden('name', $event->name)}}
                                    @if(isset($hImage))
                                         {{ Form::hidden('image', $hImage ) }}
                                    @else
                                         {{ Form::hidden('image', '/images/site/logo.jpg')}}
                                    @endif
                                   
                                    {{-- Form::text('quantity', 1)--}}
                                    <div class="form-group form__group--event {{ ($errors->has('quantity')) ? 'has-error' : '' ; }}">
                                        {{ Form::label('quantity', 'Quantity: ', array('class' => ' content-title--sub ')) }}
                                        <div class="">
                                            {{ ($errors->has('quantity'))? '<p>'. $errors->first('quantity') .'</p>' : '' }}
                                            {{ Form::text('quantity', (isset($input['quantity'])? Input::old('quantity') : 1 ), array('class' => 'input__text--event')) }}
                                        </div>
                                    </div>
                                    {{ Form::hidden('price', $event->price)}}
                                    {{ Form::hidden('section', 'EVENT')}}
                                {{ Form::submit('Add to Cart', array('class' => 'form__submit__button form__submit__button--event')) }}
                            @endif
                        @endif    
                        <!-- <p>Early bird tickets on sale next week!<br/> We can't wait to see you at the event {{ Auth::user()->fname }}</p> -->
                    @else
                        <p>Please <a class="content-link" href="/login">Login</a> or <a class="content-link" href="/signup">create an account</a> to save a seat at the event</p>
                    @endif
                </section>
            </div><!--End Nine columns-->
        </section>

        <section class="row event__information">
            <div  class="columns small-12 large-6">
                <h3 class="content__title">You Are Invited</h3>
                <section class="section__box section__box--content">
                    <!-- <p class="" >{{$event->place}}</p><br> -->
                    <div class="fluid-wrapper">
                    <iframe width="560" height="315" src="//{{$event->youtube}}" frameborder="0" allowfullscreen></iframe>

                    </div>
                </section>
            </div>
            <div class="columns small-12 large-6">
                <h3 class="content__title">Description</h3>
                <section class="section__box">
                    {{$event->why}}
                </section>
            </div>
        </section>
        <section class="row"> 
            @foreach($event->Images as $image)
                
                    <a href="#" class="columns small-4 large-2 end">
                        <div class="image-box">
                            <img class="image-box" src="/uploads/{{ $image->name }}" />
                        </div>
                    </a>
            @endforeach
        </section>

        <section class="row event__information">
            <div  class="columns small-12 large-6">
                <h3 class="content__title">Map</h3>
                <section class="section__box section__box--content">
                    <!-- <p class="" >{{$event->place}}</p><br> -->
                    <div class="fluid-wrapper">
                    <iframe src="{{$event->map}}" width="640" height="480"></iframe>

                    </div>
                </section>
            </div>
            <div class="columns small-12 large-6">
                <h3 class="content__title">What to bring</h3>
                <section class="section__box">
                    {{$event->bring}}
                </section>
            </div>
        </section>
    @endforeach
    </div>

@stop