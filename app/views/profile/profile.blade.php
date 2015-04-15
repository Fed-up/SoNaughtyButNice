@extends('tmpl.public')

@section('__header') 
@stop  

@section('content')   
<div class="band content">
	<div class="container "> 
		<nav class="tabs subnav" data-tab data-options="deep_linking:true; scroll_to_content: false">
            <h2 class="content-title--main content__title--main--tabs"><a class="tab__link" href="#settings">Settings</a></h2> |
            <h2 class="content-title--main content__title--main--tabs active"><a class="tab__link" href="#profile">{{ Auth::user()->fname }}'s Profile</a></h2>
        </nav>
		@if (Session::has('message'))
           <div class="message__alert">{{ Session::get('message') }}</div>
        @endif
		<section class="tabs-content"> 
            <div id="profile" class="row content-boxes__wrapper content active">
				<section class="row">
					@foreach($rData as $recipe)
			        <div class="columns small-6 large-3">
			            <a href="/recipes#myrecipes" class="profile__image__link">
			                <img class="top-right profile__image" src="/uploads/{{ $rImage[$recipe->id] }}">
			                <p class="profile__image__link__name">Nutrients</p>
			            </a>
			        </div>
			        @endforeach

			        @foreach($collections as $index=>$collection)
			        <div class="columns small-6 large-3">
			            <a href="/collections#mycollections" class="profile__image__link">
			            	@if($collection_check == 1)
			                	<img class="bottom-right profile__image" src="/uploads/{{ $cImage[$collection->id] }}">  
			                @else
			                	<img class="bottom-right profile__image" src="/uploads/{{ $cImage }}">  
			                @endif 
			                <p class="profile__image__link__name">Collections</p>
			            </a>
			        </div>
			        @endforeach

			        @if($e_count != 'empty')
				        @foreach($eData as $event)
				        <div class="columns small-6 large-3">
				            <a href="/profile/events" class="profile__image__link">
				                <img class="top-right profile__image" src="/uploads/{{ $eImage[$event->id] }}">
				                <p class="profile__image__link__name">Events</p>
				            </a>
				        </div>
				        @endforeach		
				    @else
				    	<div class="columns small-6 large-3">
				            <a href="/profile/events" class="profile__image__link">
				                <img class="top-right profile__image" src="/uploads/{{ $eImage }}">
				                <p class="profile__image__link__name">Events</p>
				            </a>
				        </div>	
				    @endif


					@foreach($pData as $catering)
			        <div class="columns small-6 large-3">
			            <a href="/catering#fndtn-custom" class="profile__image__link">
			                <img class="bottom-left profile__image" src="/uploads/{{ $pImage[$catering->id] }}">
							<p class="profile__image__link__name">Catering</p>
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

			<div id="settings" class="row content-boxes__wrapper content ">
				<section class="columns small-12 medium-8 medium-push-2 large-10 large-push-1 xlarge-8 xlarge-push-2">
                    <div class="section section--form" >
				  		{{ Form::open(array('action' => 'UserProfileController@postUpdateUser', 'class' => 'form-horizontal')) }}
				        
				        <h2 class="content__title--main--signup">Update your account information</h2> 
			         	<div class="form-group {{ ($errors->has('fname')) ? 'has-error' : '' ; }} columns small-12 large-6 xlarge-6">
				        	{{ Form::label('fname', 'First Name: ', array('class' => ' content-title--sub ')) }}
				            <div class="">
				                {{ ($errors->has('fname'))? '<p>'. $errors->first('fname') .'</p>' : '' }}
				                {{ Form::text('fname', (Auth::user()->fname)? Auth::user()->fname : '' , array('class' => 'input__text')) }} 
				            </div>
				        </div>
				        <div class="form-group {{ ($errors->has('fname')) ? 'has-error' : '' ; }} columns small-12 large-6 xlarge-6">
				        	{{ Form::label('lname', 'Last Name: ', array('class' => ' content-title--sub ')) }}
				            <div class="">
				                {{ ($errors->has('lname'))? '<p>'. $errors->first('lname') .'</p>' : '' }}
				                {{ Form::text('lname', (Auth::user()->lname)? Auth::user()->lname : '' , array('class' => 'input__text')) }} 
				            </div>
				        </div>
			            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' ; }} columns small-12">
				            {{ Form::label('email', 'Email: ', array('class' => ' content-title--sub ')) }}
				            <div class="">
				                {{ ($errors->has('email'))? '<p>'. $errors->first('email') .'</p>' : '' }}
				                {{ Form::text('email', (Auth::user()->email)? Auth::user()->email : '' , array('class' => 'input__text')) }} 
				            </div>
				        </div>
				        <hr>
			            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' ; }} columns small-12 large-6 xlarge-6">
			            	{{ Form::label('password', 'Password: ', array('class' => ' content-title--sub ')) }}
			                <div class="">
			                    {{ ($errors->has('password'))? '<p>'. $errors->first('password') .'</p>' : '' }}
			                    {{ Form::password('password', array('class'=>'input__text' ) ) }}
			                </div>
			            </div>
			            
			            <div class="form-group {{ ($errors->has('password_match')) ? 'has-error' : '' ; }} columns small-12 large-6 xlarge-6">
			            	{{ Form::label('password_match', 'Password Match: ', array('class' => ' content-title--sub ')) }}
			                <div class="">
			                    {{ ($errors->has('password_match'))? '<p>'. $errors->first('password_match') .'</p>' : '' }}
			                    {{ Form::password('password_match', array('class'=>'input__text' ) ) }}
			                </div>
			            </div>
			            <hr>
			            <div class="form-group {{ ($errors->has('unsubscribe')) ? 'has-error' : '' ; }}">
			            	{{ Form::label('unsubscribe', 'Unsubscribe: ', array('class' => ' content-title--sub ')) }}
			                <div class="">
			                    {{ ($errors->has('unsubscribe'))? '<p>'. $errors->first('unsubscribe') .'</p>' : '' }}
			                    <input type="checkbox" name="unsubscribe" class="input__checkbox" @if(Auth::User()->active == 0)checked="on"@endif /> 
			                    {{-- Form::radio('unsubscribe', array('class'=>'input__checkbox' ) ) --}}
			                </div>
			            </div>
			            
			            <div class="form-group">
				            <div class="form__buttons--profile_update">
					            {{ Form::submit('Update info', array('class' => 'side__login__button side__login__button--signup')) }}
				            
				            </div>
				        </div>
						{{ Form::close() }}  

                    </div>
                </section>
			</div>


		</section>
	</div>
</div>

@stop