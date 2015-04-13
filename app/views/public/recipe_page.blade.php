@extends('tmpl.public')

@section('content')
    <div class="page">
    @foreach($rData as $recipe)
        <h2 class="content__title content__title--recipe"><a class="content__title--link" href="/recipes">{{$recipe->name}}</a></h2>
        <section class="row">
            {{--'<pre>'; dd($rImage[0][$recipe->id]); echo '</pre>';--}}
            <div class="columns small-9 medium-4">
                    <img src="/uploads/{{ $hImage }}" />	
            </div><!--End Five columns-->
            
            <div class="columns small-3 medium-2 medium-push-6 large-2 large-push-6 xlarge-1 xlarge-push-7">
                <div class="">
                    <div class="content__side__icon" > <span class="icon-clock recipe__icon"></span><span class="icon__text"> {{$recipe->length}}</span></div>
                    <div class="content__side__icon" > <span class="icon-bars recipe__icon"></span><span class="icon__text"> {{$recipe->difficulty}}</span></div>
                    <div class="content__side__icon" > <span class="icon-food recipe__icon"></span><span class="icon__text"> {{$recipe->serve}}</span></div>
                </div> 
            </div>
            <div class="columns small-12 medium-6 medium-pull-2 large-6 large-pull-2 xlarge-7 xlarge-pull-1">
                <section class="section__box section__box--fresh-fact">
                    @foreach($recipe->MenuRecipesFacts as $rfact) 
                        <p>{{$rfact->description}}</p>
                    @endforeach
                </section> 
            </div>

            <div class="columns small-12 medium-12 medium-push-12 large-6 large-pull-2 xlarge-7 xlarge-pull-1">
                <section class="section__box section__box--nutrition-panel">
                    @if (Auth::check())
                        <p> Nutritional Panel is coming</p>
                        <br/>
                    @else
                        <p>Please <a class="content-link" href="/login">Login</a> or <a class="content-link" href="/signup">create an account</a> to view Recipe</p>
                        <!-- <a class=" trigger-menu"><span class="logo__image"></span></a> -->

                    @endif
                        
                    
                </section>
            </div>

        </section>


    	<section class="row">
            <div class="columns small-12 medium-6 ">
        		<h3 class="content__title">The Ingredients</h3> 
            	<section class="section__box">
                    <ul>
                    @foreach($rIngredients as $index=>$ingredient)
                        @if($ingredient->MenuIngredients->active == 1)
                            @if(auth::check())
                                @if(Auth::user()->user_type != 'B2B')
                                    @if($recipe->exclusive == 1)
                                        <li>
                                            <a class="content-link" href="/ingredient/{{$ingredient->MenuIngredients->id}}">
                                                {{$ingredient->MenuIngredients->name}}
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            {{$ingredient->amount}} 
                                            {{$ingredient->Metric->name}}
                                            <a class="content-link" href="/ingredient/{{$ingredient->MenuIngredients->id}}">
                                                {{$ingredient->MenuIngredients->name}}
                                            </a>
                                        </li>
                                    @endif
                                @else
                                    <li>
                                        <a class="content-link" href="/ingredient/{{$ingredient->MenuIngredients->id}}">
                                            {{$ingredient->MenuIngredients->name}}
                                        </a>
                                    </li>
                                @endif
                           
                            @else
                                <li>
                                    <a class="content-link" href="/ingredient/{{$ingredient->MenuIngredients->id}}">
                                        {{$ingredient->MenuIngredients->name}}
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endforeach


                    

                    <ul>
                </section>	
            </div>
            <div class="columns small-12 medium-6 ">
                @if(auth::check())
                    @if(Auth::user()->user_type != 'B2B')
                        @if($recipe->exclusive == 1)
                            <h3 class="content__title">Exclusive Recipe</h3>
                        @else
                            <h3 class="content__title">The Method</h3>
                        @endif
                    @else
                        <h3 class="content__title">Purchase Information</h3>
                    @endif
                @else
                    @if($recipe->exclusive == 1)
                        <h3 class="content__title">Exclusive Recipe</h3>
                    @else
                        <h3 class="content__title">The Method</h3>
                    @endif    
        	    @endif

                <section class="section__box">
                    @if(auth::check())
                        @if(Auth::user()->user_type != 'B2B')
                            @if($recipe->exclusive == 1)
                               <p>This is a <a class="content-link" href="/">SoNaughtyButNice.com</a> exclusive recipe, we may teach you how to make it at up comming <a class="content-link" href="/events">events</a> or you can include it in your next <a class="content-link" href="/catering">catering package</a></p>
                            @else
                                @if(Auth::check())
                                    @foreach($recipe->MenuRecipesMethods as $rMethods)
                                        <p>
                                            {{$rMethods->description}}
                                        </p><br/>
                                    @endforeach
                                @else
                                    <p>Please <a class="content-link" href="/login">Login</a> or <a class="content-link" href="/signup">create an account</a> to view Method</p>
                                @endif 
                            @endif
                        @else
                            @if($sales_count == 0)
                                <p>This product is still being perfected, please email us directly if you are interested in it, as we want to accomodate to your needs promptly.<br/>Regards,<br/> So Naughty But Nice</p>
                            @else
                                <p><span class="content-link">Ideal amount:</span>&nbsp; &nbsp; {{$sales_data[0]->sales_amount}}</p>
                                <p><span class="content-link">Ideal grams:</span>&nbsp; &nbsp; {{$sales_data[0]->total_recipe_grams}}g</p>
                                <p><span class="content-link">Ideal cost:</span>&nbsp; &nbsp; $ {{$sales_data[0]->B2B_total_recipe_revenue}}</p><br/>

                                <p><span class="content-link">Total grams per piece:</span>&nbsp; &nbsp; {{$sales_data[0]->total_grams_per_piece}}g</p>
                                <p><span class="content-link">Total cost per piece:</span>&nbsp; &nbsp; ${{$sales_data[0]->B2B_sales_price}}</p>
                                <hr>
                                <p>All products are handmade to perfection, we are able to tailor this product to your specific requirements at no additional cost. 
                                <br/>Our prices are formulated, so the cost to produce is 30%, ensuring you recieve the same value every time you purchase these delicious creations</p>
                            @endif
                        @endif
                    @else
                        @if($recipe->exclusive == 1)
                           <p>This is a <a class="content-link" href="/">SoNaughtyButNice.com</a> exclusive recipe, we may teach you how to make it at up comming <a class="content-link" href="/events">events</a> or you can include it in your next <a class="content-link" href="/catering">catering package</a></p>
                        @else
                            @if(Auth::check())
                                @foreach($recipe->MenuRecipesMethods as $rMethods)
                                    <p>
                                        {{$rMethods->description}}
                                    </p><br/>
                                @endforeach
                            @else
                                <p>Please <a class="content-link" href="/login">Login</a> or <a class="content-link" href="/signup">create an account</a> to view Method</p>
                            @endif 
                        @endif   
                    @endif
                    
                </section>  	 
            </div> 
        </section>


        <section class="row"> 
    
            @foreach($recipe->Images as $image)
                
                    <a href="#" class="columns small-4 large-2 end">
                        <div class="image-box">
                            <img class="image-box" src="/uploads/{{ $image->name }}" />
                        </div>
                    </a>
                 
            @endforeach
            
        </section>
        
        @if(Auth::check())
            @if(Auth::user()->user_type != 'B2B')
                @if($recipe->exclusive != 1)
                    <section class="row">
                        <div class="columns small-12 "> 
                            <div class=" ">
                                <h3 class="content__title">Little Extras</h3>
                                <section class="section__box">
                                    @if (Auth::check())
                                        @foreach($recipe->MenuRecipesExtras as $rExtras)
                                            <p>
                                                {{$rExtras->description}}
                                            </p><br/>
                                        @endforeach 
                                    @else
                                        <p>Please <a class="content-link" href="/login">Login</a> or <a class="content-link" href="/signup">create an account</a> to view Little Extras</p>
                                    @endif 
                                </section>
                            </div>         
                        </div>            
                    </section>
                @endif
            @endif
        @else
            <p>Please <a class="content-link" href="/login">Login</a> or <a class="content-link" href="/signup">create an account</a> to view Little Extras</p>
        @endif
   
        <section class="row content-boxes__wrapper">
            <h5 class="content__title">{{$recipe->name}}'s cousins</h5>
            @foreach($category->menuRecipes as $recipe)
                
                 {{--'<pre>'; print_r($recipe ); echo '</pre>';--}}


                <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                    <article class="content-box">
                        <div class="row collapse">

                            @foreach($recipe->Images as $image)
                                <a href="/recipe/{{$recipe->id}}" class="columns small-4 medium-12">
                                  <img src="/uploads/{{ $crImage[$recipe->id] }}" />
                                </a>
                            @endforeach

                            <section class="columns small-8 medium-12">
                                <div class="content-box__copy">
                                    <a href="/recipe/{{$recipe->id}}" class="content-box__copy__inner--recipe">
                                        <h5 class="content-box__title">{{$recipe->name}}</h5>
                                        <!-- <p class="content-box__summary">{{$recipe->summary}}</p> -->
                                    </a>
                                    <a href="/collection/{{$recipe->MenuCategories->id}}" class="content-box__tag">{{$recipe->MenuCategories->name}}</a>
                                </div>
                            </section>
                        </div>
                    </article>
                </div> 
            @endforeach 
        </section>

    @endforeach  
  	</div><!--End Band Content-->
   
@stop

@section('_footer')

@stop


