 @foreach($recipe->MenuCategories as $category)
                                    <pre>{{$category->id}}</pre>
                                @endforeach


@if(!empty($category[$recipe->id]))
    <a href="/collection/{{$category[$recipe->id]->id}}" class="content-box__tag">{{$category[$recipe->id]->name}}</a>
@else
    <a href="/collections" class="content-box__tag">Collection</a>
@endif

<pre>{{print_r($category[$recipe->id])}}</pre>


<li>
                        <a class="content-link" href="/ingredient/{{$rIngredients->MenuIngredients->id}}">
                            
                                @if ($paid == $confirm_paid)
                                    {{ $rIngredients->display }}
                                    {{--$rIngredients->amount--}}
                                    {{--$rIngredients->Metric->name--}} 
                                    {{--$rIngredients->MenuIngredients->name--}}
                                @else
                                    {{$rIngredients->MenuIngredients->name}}
                                @endif   
                            
                        </a>
                        </li>




		foreach($uData as $paid_data){	

			// echo '<pre>'; print_r($paid_data); echo '</pre>';exit;			

			if(empty($paid_data->menuRecipes[0])){
					$recipe_confirm_paid = 0;
					$recipe_paid = 1;
					$cRecipe = ""; //Confirmed Recipe
					$recipe_message = "You have not purchased any recipes yet";
						
			}else{


				foreach($paid_data->menuRecipes as $recipe){

					// echo '<pre>'; print_r($recipe); echo '</pre>';exit;

					// echo '<pre>'; print_r($recipe->pivot->paid); echo '</pre>';exit;

					$recipe_paid = $recipe->pivot->paid;
					
					if($recipe_paid == 1){
						$recipe_confirm_paid = 1;
						$cRecipe[] = $recipe;
						$recipe_message = null;
					}else{
						$recipe_confirm_paid = 0;
						$recipe_paid = 1;
						$cRecipe = ""; //Confirmed Recipe
						$recipe_message = "You have not purchased recipes yet";
					}	
				}
			}


			if(empty($paid_data->Events[0])){
					$event_confirm_paid = 0;
					$event_paid = 1;
					$events = ""; //Confirmed Recipe
					$event_message = "You have not purchased any events yet";
						
			}else{


				foreach($paid_data->Events as $event){

					// echo '<pre>'; print_r($recipe); echo '</pre>';exit;

					// echo '<pre>'; print_r($recipe->pivot->paid); echo '</pre>';exit;

					$event_paid = $recipe->pivot->paid;
					
					if($event_paid == 1){
						$event_confirm_paid = 1;
						$events[] = $event;
						$event_message = null;
					}else{
						$event_confirm_paid = 0;
						$event_paid = 1;
						$events = ""; //Confirmed Recipe
						$event_message = "You have not purchased any events yet";
					}	
				}
			}

		}




		$uData = User::where('id', '=', $user_id)->where('active', '=', 1)
			->with(array('menuRecipes' => function($query) use ($user_id)
			{
				$query->where('paid.paid', '=', 1)->where('paid.user_id', '=', $user_id)->where('paid.type', '=', 'RECIPE')
					->with(array('Images' => function($query)
					{
						$query->where('ordering', '=', 0)->where('section', '=', 'RECIPE');
					}));
			}))
			->with(array('Events' => function($query) use ($user_id){
				// echo '<pre>'; print_r($user_id); echo '</pre>';exit;
				$query->where('paid.paid', '=', 1)->where('paid.user_id', '=', $user_id)->where('paid.type', '=', 'EVENT')

				->with(array('Images' => function($query){
					$query->where('images.ordering', '=', 0)->where('section', '=', 'EVENT');
				}));
			}))
		->get();



		// echo '<pre>'; print_r($uData); echo '</pre>';exit;


		
		$recipe_paid = 0;
		$recipe_confirm_paid = 1;
		$event_paid = 0;
		$event_confirm_paid = 1;
		$cRecipe = ""; //Confirmed Recipe
		$events = ""; //Confirmed event!

		           	// if ($count == $total_paid) {
           	// 	$confirm_paid = 1;
           	// 	//echo '<pre>'; print_r("Collection Paid"); echo '</pre>';exit;
           	// }
           					// $count = count($collection->menuRecipes);
				// $total_paid = 0;
    //            	foreach($collection->menuRecipes as $recipe){
    //            		$paid = 0;
				// 	$confirm_paid = 1;
				// 	// echo '<pre>'; print_r($recipe); echo '</pre>';exit;
				// 	foreach($recipe->User as $pivot){
				// 		if( $pivot->pivot->type == 'RECIPE'){
				// 			$paid = $pivot->pivot->paid;
				// 		}
						
				// 		// echo '<pre>'; print_r($paid); echo '</pre>';exit;
				// 		if($paid == 1){
				// 			$total_paid++;
				// 		}else{
				// 			$confirm_paid = 0;
				// 			$paid = 1;
				// 		}
				// 	}
    //            }


            <!-- @if (Auth::check()) -->
            <!-- <p>{{$paid}}</p> -->
            <!-- <p>{{$confirm_paid}}</p> -->
            <!-- @if ($paid == $confirm_paid)
                <p>PRINT COLLECTION - You have paid for book</p>
            @else
                @foreach($cData as $collection)
                    {{ Form::open(array('action' => 'CheckoutController@postAddToCart')) }}
                    {{ Form::hidden('collection_id', $collection->id)}}
                    {{ Form::hidden('name', $collection->name)}}
                    {{ Form::hidden('image', $collection->menuRecipes[0]->Images()->first()->name)}}
                    {{ Form::hidden('quantity', 1)}}
                    {{ Form::hidden('price', 5)}}
                    {{ Form::hidden('section', 'COLLECTION')}}
                    {{ Form::submit('Add to Collection to Cart', array('class' => 'btn btn-success')) }}
                @endforeach
            
            @endif -->
       <!--  @else
            <p>PRINT COLLECTION - You have paid for book</p>
        @endif -->



         <!-- @if ($paid == $confirm_paid)
                                    {{-- $rIngredients->display --}}
                                    {{$rIngredients->amount}}
                                    {{$rIngredients->Metric->name}} 
                                    {{$rIngredients->name}}
                                @else
                                    {{$rIngredients->name}}
                                @endif  -->  



                        <!-- @if ($paid == $confirm_paid)
                            
                                @foreach($recipe->MenuRecipesMethods as $rMethods)
                                    <p>
                                        {{$rMethods->description}}
                                    </p>
                                @endforeach
                            
                        @else
                            {{ Form::open(array('action' => 'CheckoutController@postAddToCart')) }}
                            {{ Form::hidden('recipe_id', $recipe->id)}}
                            {{ Form::hidden('name', $recipe->name)}}
                            {{ Form::hidden('image', $hImage->name)}}
                            {{ Form::hidden('quantity', 1)}}
                            {{ Form::hidden('price', 2)}}
                            {{ Form::hidden('section', 'RECIPE')}}

                            
                            {{ Form::submit('Add to Cart', array('class' => 'btn btn-success')) }}
                        @endif -->



                                                <!-- <p>{{$paid}}</p> -->
                        <!-- <p>{{$confirm_paid}}</p> -->
                        

@foreach($recipe->MenuRecipesIngredients as $rIng)
                    	{{--'<pre>'; print_r($rIngredients); echo '</pre>';--}}
                        <li>
                        <a class="content-link" href="/ingredient/{{$rIng->id}}">
                            {{--$rIngredients->amount--}}
                            {{--$rIngredients->Metric->name--}} 
                            {{--$rIngredients->name--}}
                            {{$rIngredients[$rIng->id]}}
                        </a>
                        </li>
                    @endforeach



                        @else
                            {{ Form::open(array('action' => 'CheckoutController@postAddToCart')) }}
                                {{ Form::hidden('event_id', $event->id)}}
                                {{ Form::hidden('name', $event->name)}}
                                @if(isset($hImage->name));
                                     {{ Form::hidden('image', $hImage->name)}}
                                @else
                                     {{ Form::hidden('image', 'o_18uaul8ai1b071b194f1na11a7u8.JPG')}}
                                @endif
                               
                                {{ Form::hidden('quantity', 1)}}
                                {{ Form::hidden('price', $event->price)}}
                                {{ Form::hidden('section', 'EVENT')}}
                            {{ Form::submit('Add to Cart', array('class' => 'btn btn-success')) }}
                        @endif                    