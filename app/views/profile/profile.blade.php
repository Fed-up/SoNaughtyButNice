@extends('tmpl.public')

@section('__header') 
@stop  

@section('content')   
<div class="band content">
	<div class="container "> 
		<h2 class="content__title content__title--main"><a class="content__title--link" href="/profile">{{ Auth::user()->fname }}'s Profile</a></h2>
		<section class="row">
			@foreach($rData as $recipe)
	        <div class="columns small-6 large-3">
	            <a href="/recipes#myrecipes" class="profile__image__link">
	                <img class="top-right profile__image" src="/uploads/{{ $rImage[$recipe->id] }}">
	                <p class="profile__image__link__name">My Recipes</p>
	            </a>
	        </div>
	        @endforeach

	        @foreach($collections as $index=>$collection)
	        <div class="columns small-6 large-3">
	            <a href="/collections#mycollections" class="profile__image__link">
	                <img class="bottom-right profile__image" src="/uploads/{{ $cImage[$collection->id] }}">   
	                <p class="profile__image__link__name">My Collections</p>
	            </a>
	        </div>
	        @endforeach

	        @if($e_count != 'empty')
		        @foreach($eData as $event)
		        <div class="columns small-6 large-3">
		            <a href="/events#myevents" class="profile__image__link">
		                <img class="top-right profile__image" src="/uploads/{{ $eImage[$event->id] }}">
		                <p class="profile__image__link__name">My Events</p>
		            </a>
		        </div>
		        @endforeach		
		    @else
		    	<div class="columns small-6 large-3">
		            <a href="/events#myevents" class="profile__image__link">
		                <img class="top-right profile__image" src="/uploads/{{ $eImage }}">
		                <p class="profile__image__link__name">My Events</p>
		            </a>
		        </div>	
		    @endif


			@foreach($pData as $catering)
	        <div class="columns small-6 large-3">
	            <a href="/catering#mypackages" class="profile__image__link">
	                <img class="bottom-left profile__image" src="/uploads/{{ $pImage[$catering->id] }}">
					<p class="profile__image__link__name">My Catering</p>
	            </a>
	        </div>
	        @endforeach

		</section>
		
		<section class="row ">
			<div class="columns small-12 large-3 large-push-6">
				<a class="profile__account__link" href="/events">Up Coming Events</a>		
			</div>
			<!-- <div class="columns small-12 medium-6 large-3 large-push-3">
				<a class="profile__account__link" href="/account">Account Settings</a>
			</div> -->
			<div class="columns small-12 medium-6 large-3">
				<a class="profile__account__link" href="/logout">Logout</a>
			</div>
		</section>

	</div>
</div>

@stop