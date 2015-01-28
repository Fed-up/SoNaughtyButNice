	<div class="band content">
		<div class="container "> <!--Recipe section-->

			<!-- Test Card 4242424242424242 All other details can be anything and date must be in the future--> 
			<!-- pk_test_L6cYa315bA9UenwUAZs4LdLN -->
			
			<h2 class="section_title">{{ Auth::user()->username }} Shopping Cart</h2>


			<div class="white_background">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th class="" >Image</th>
							<th class="" >Product Name</th>
							<th class="" >Unit Price</th>
							<th class="" >Quantity</th>
							<th class="" >Subtotal</th>
						</tr>
					</thead>
					<tbody>

						@if($cart != $confirm_cart)
							<tr>
								<td class="cart_total--default" colspan="7">
									<p>{{$products}}</p>
								</td>
							</tr>
						@else
							
							@foreach($products as $product)

								<tr>
									<td>{{$product->id}}</td>
									<td><img class="two columns cart_image" src="/uploads/{{$product->image}}"/></td>	
									<td>{{$product->name}}</td>	
									<td>${{$product->price}}.00</td>	
									<td>{{$product->quantity}}</td>	
									<td>
										${{$product->total()}}.00
										<a href="remove/{{$product->identifier}}"> X </a>
									</td>
									<td>
										<a href="/store/removeitem/{{ $product->identifier }}" >
									</td>	
								</tr>
							@endforeach
						
							<tr>
								<td class="cart_total" colspan="7">
									Total: ${{ Cart::total() }}.00
								</td>
							</tr>
							<tr>
								<td class="cart_total" colspan="7">
									<form action="/pay" method="POST"> 
										<script
											src="https://checkout.stripe.com/checkout.js" class="stripe-button"
											data-email="{{ Auth::user()->email }}"
											data-key="{{ Config::get('stripe.pk') }}"
											data-amount="{{ Cart::total() }}00"
											data-name="Demo Site"
											data-description="Your recipes"
											data-image="/128x128.png">
										</script>
										<input type="hidden" name="amount" value="{{ Cart::total() }}00" />
										
									  
									</form>
								</td>
							</tr>
						@endif	
					<tbody>
				</table>
			</div>

		</div><!--End container-->
	</div>