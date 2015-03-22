@extends('tmpl.public')

@section('__header') 
@stop  

@section('content')   
<div class="band content">
	<div class="container "> 
		<h2 class="content__title content__title--main"><a class="content__title--link" href="/profile">@if (Auth::check()) Sorry {{ Auth::user()->fname }} =(</a></h2> @else Error Page =(</a></h2> @endif
		<div class="row">
			<section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
	            <div class="section section--form" >
	                <h1 class="content__title--main--signup">Whoops Tom Made a Mistake =(</h1>
	                <p class="form__box_p">Please go <a class="content-link" href="{{ URL::previous() }}">Back</a> and try again, if the error persists <a class="content-link" href="{{ URL::previous() }}">let Tom know</a>, he appeciates the feedback so he can make this website, as delicious as possible for you =)</p>
	            </div>
	        </section>
	        <div class="footer__push"></div>  
	    </div>
	</div>
</div>

@stop