@extends('tmpl.public')

@section('__header') 
@stop  

@section('content')  

	<section class="page">
    	<h2 class="content__title--main">{{ Auth::user()->fname }}'s' Purchases</h2>
		
		<pre>{{--dd(array_ke$products[0])--}}</pre>

		@if($cart == $confirm_cart)
			<div class="row content-boxes__wrapper">
	            @foreach($products as $product)
		            <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
		                <article class="content-box">
		                    <div class="row collapse">

		                        
		                        <a href="/event/{{$product->id}}" class="columns small-4 medium-12 end">
		                          <img src="/uploads/{{ $product->image }}" />
		                        </a>
		                        

		                        <section class="columns small-8 medium-12">
		                            <div class="content-box__copy">
		                                <a href="/event/{{$product->id}}" class="content-box__copy__inner">
		                                    <h5 class="content-box__title">{{$product->name}}</h5>
		                                    <p class="content-box__summary--quantity">x {{$product->quantity}}</p>
		                                    <p class="content-box__summary--price">${{$product->price}}.00</p>
		                                    <a href="/remove/{{ $product->identifier }}" class="content-box__tag">remove</a>
		                                </a>
		                            </div>
		                        </section>
		                    </div>
		                </article>
		            </div>
	            @endforeach
			</div>
			<section class="row checkout__section">	

				<div class="checkout__content">
					<div class="cart__total" >
						Total: ${{ Cart::total() }}.00
					</div>

					<div class="cart__total cart__total__button">
						<form action="/pay" method="POST"> 
							<script
								src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								data-email="{{ Auth::user()->email }}"
								data-key="{{ Config::get('stripe.pk') }}"
								data-label="pay with card"
								data-amount="{{ Cart::total() }}00"
								data-name="{{$product->name}}"
								data-description="confirmation will be emailed"
								data-image="/images/site/logo.jpg">
							</script>
							<input type="hidden" name="amount" value="{{ Cart::total() }}00" />
							@foreach($products as $product)
								<input type="hidden" name="quantity[{{$product->id}}]" value="{{$product->quantity}}" />
							@endforeach
						  
						</form>
					</div><br/>
					<div class="pay_icon">
						<img src="/images/site/visaicon.png" width="50px" height="30px"></img>
						<img src="/images/site/mastercard.png" width="50px" height="30px"></img>
						<img src="/images/site/trusteicon.png" width="75px" height="30px"></img>
					</div>
				</div>
			</section>	
		@else
			<div class="row content-boxes__wrapper">
				<section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
	                <div class="section section--form" >
	                    <h1 class="page-header">This is your checkout page</h1>
	                    <p class="promo__text">Please feel free to keep exploring.. <br/> <a class="content-link" href="/recipes">recipes</a> or <a class="content-link" href="/events">upcoming events</a> :)</p>
	                </div>
	            </section>
	        </div>
			
		@endif	
	</section>





           

@stop