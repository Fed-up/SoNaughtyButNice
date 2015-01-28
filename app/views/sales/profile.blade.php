@extends('tmpl.public')

@section('__header') 
@stop  

@section('content')   
	<div class="band content">
		<div class="container "> <!--Recipe section-->

			<h2 class="section_title">{{ Auth::user()->username }} Recipes</h2>
			<div class="hp_recipe">
				@if (Auth::check())
	                @if ($paid == $confirm_paid)  
	                	{{-- '<pre>'; print_r($recipe->Images ); echo '</pre>'; --}}
	                   	<div class="four columns recipe_box">
	                    	<a href="/recipe/{{$recipe->id}}">
	                            @foreach($recipe->Images as $image)
	                                <img src="/uploads/{{ $image->name }}" />
	                            @endforeach
	                            <h4 class="recipe_title">{{$recipe->name}}</h4>
	                            <p class="recipe_box_summary">{{$recipe->summary}}</p>
	                       	</a>
	                       	<a href="/collection/{{$recipe->MenuCategories->id}}" class="category_tag">{{$recipe->MenuCategories->name}}</a>
	                    </div><!--End column-->     
	                @else
	                    <p>You have not paid for any recipes</p>
	                @endif

                @else
                    <p>Please Sign In to view method</p>
                @endif




                	
            </div><!--End hp_recipe-->
		</div>
	</div>

	<main class="main page">
		<h2 class="section_title">{{ Auth::user()->username }} Recipes</h2>
		@if (Auth::check())
            @if ($paid == $confirm_paid)  
            	{{-- '<pre>'; print_r($recipe->Images ); echo '</pre>'; --}}
               	<div class="four columns recipe_box">
                	<a href="/recipe/{{$recipe->id}}">
                        @foreach($recipe->Images as $image)
                            <img src="/uploads/{{ $image->name }}" />
                        @endforeach
                        <h4 class="recipe_title">{{$recipe->name}}</h4>
                        <p class="recipe_box_summary">{{$recipe->summary}}</p>
                   	</a>
                   	<a href="/collection/{{$recipe->MenuCategories->id}}" class="category_tag">{{$recipe->MenuCategories->name}}</a>
                </div><!--End column-->     
            @else
                <p>You have not paid for any recipes</p>
            @endif

        @else
            <p>Please Sign In to view method</p>
        @endif
	    <section class="row content-boxes__wrapper">
	        @foreach($iData as $ingredient)
	        <div class="columns small-12 medium-6 large-4 xlarge-2 end">
	            <article class="content-box content-box-- ">
	                <div class="row collapse">

	                    @foreach($ingredient->Images as $image)
	                    <a href="/ingredients" class="columns medium-12" >
	                        <div class="hp-image--background" style="background-image: url(/uploads/{{ $image->name }}); height:8rem; background-position: center; width:100%; background-repeat: no-repeat;">
	                                
	                        </div>
	                    </a>
	                    
	                    <a href="/ingredients" class="columns small-4 medium-12">
	                        <div class="hp-image--square">
	                            <img src="/uploads/{{ $image->name }}" />
	                        </div>
	                    </a>
	                    @endforeach
	                    
	                   
	                        <section class="columns small-8 medium-12">
	                            <a href="/ingredients" class="content-box__copy">
	                                <div class="content-box__copy__inner content-box__copy__inner--homepage">
	                                    <h5 class="content-box__title content-box__title--homepage">Ingredients</h5>
	                                </div>
	                            
	                            </a>
	                        </section>
	                    
	                </div>
	            </article>
	        </div>
	        @endforeach
	    </section>
	<main>
@stop