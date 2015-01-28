@extends('tmpl.public')

@section('__header') 
@stop  

@section('content') 
	<div class="band content">
		<div class="container "> 
			{{dd(Cart::totalItems());}}
			
			<!-- <table>
				<tr>
					<th>#</th>
					<th>Product Name</th>
					<th>Unit Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
				</tr>

				@foreach($products as $product)
				<tr>
					<td>$product->id</td>	
					<td>
						$product->name
					</td>	
					<td>$product->price</td>	
					<td>$product->quantity</td>	
					<td>$product->price</td>
					<td>
						<a href="/store/removeitem/{{ $product->identifier }}" >
					</td>	
				</tr>

				<tr>
					<td colspan="5">
						Subtotal: {{ Cart::total() }}
						Total: {{ Cart::total() }}
					</td>
				</tr>
			</table> -->
			<!-- <form action="/checkout" method="POST">
				<script
					src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					data-key="{{ Config::get('stripe.pk') }}"
					data-image="/images/site/Avocado.jpg"
					data-name="Demo Site"
					data-email=""
					data-description="2 widgets ($20.00)"
					data-amount="2000"> /*Amount in cents = $20*/
				</script>
				<input type="hidden" name="amount" value="2000" />
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			</form> -->
		</div>
	</div>
@stop 

