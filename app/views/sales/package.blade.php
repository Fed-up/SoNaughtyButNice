@extends('tmpl.public')

@section('content')
    <section class="page">
        <h2 class="content__title content__title--main"><a class="content__title--link" href="/catering">{{$pData[0]->name}} Recipes</a></h2>

        <div class="row content-boxes__wrapper">
            @foreach($pData as $package)
                @foreach($package->menuRecipes as $recipe)

               
                <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                    <article class="content-box">
                        <div class="row collapse">

                            
                            <a href="/recipe/{{$recipe->id}}" class="columns small-4 medium-12 end">
                              <img src="/uploads/{{ $recipe_image[$recipe->id] }}" />
                            </a>
                           

                            <section class="columns small-8 medium-12">
                                <div class="content-box__copy">
                                    <a href="/recipe/{{$recipe->id}}" class="content-box__copy__inner">
                                        <h5 class="content-box__title">{{$recipe->name}}</h5>
                                        <p class="content-box__summary--display">{{$recipe->pivot->amount}} pieces</p>
                                    </a>
                                </div>
                            </section>
                        </div>
                    </article>
                </div>
                @endforeach
            @endforeach
        </div>

        <div class=" row">
        <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
            <div class="section section--form" >
                <!-- <h1 class="page-header">@yield('title')</h1> -->
                {{ Form::open(array('action' => 'CateringController@packageEnquiry', 'class' => 'form-horizontal')) }}
                    <p class="package__total">Total: ${{$pData[0]->price}}</p>
                    <h2 class="content__title--main--signup">To order {{$pData[0]->name}}<br/> Please email us today =)</h2> 
                    <div class="form-group {{ ($errors->has('fname')) ? 'has-error' : '' ; }}">
                        {{ Form::label('fname', 'First Name: ', array('class' => ' content-title--sub ')) }}
                        <div class="">
                            {{ ($errors->has('fname'))? '<p>'. $errors->first('fname') .'</p>' : '' }}
                            {{ Form::text('fname', (isset($input['fname'])? Input::old('fname') : (isset($data->fname)? $data->fname : '' )), array('class' => 'input__text')) }} 
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' ; }}">
                        {{ Form::label('email', 'Email: ', array('class' => ' content-title--sub ')) }}
                        <div class="">
                            {{ ($errors->has('email'))? '<p>'. $errors->first('email') .'</p>' : '' }}
                            {{ Form::text('email', (isset($input['email'])? Input::old('email') : (isset($data->email)? $data->email : '' )), array('class' => 'input__text')) }} 
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('mobile')) ? 'has-error' : '' ; }}">
                        {{ Form::label('mobile', 'Mobile: ', array('class' => ' content-title--sub ')) }}
                        <div class="">
                            {{ ($errors->has('mobile'))? '<p>'. $errors->first('mobile') .'</p>' : '' }}
                            {{ Form::text('mobile', (isset($input['mobile'])? Input::old('mobile') : (isset($data->mobile)? $data->mobile : '' )), array('class' => 'input__text')) }} 
                        </div>
                    </div>
                    
                    <div class="form-group {{ ($errors->has('message')) ? 'has-error' : '' ; }}">
                        {{ Form::label('message', 'Detailed Message: ', array('class' => ' content-title--sub ')) }}
                        <div class="">
                            {{ ($errors->has('message'))? '<p>'. $errors->first('message') .'</p>' : '' }}
                            {{ Form::textarea('message', (isset($input['message'])? Input::old('message') : (isset($data->message)? $data->message : '' )), array('class' => 'input__text')) }} 
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="form__buttons">
                            <a href="/">
                                {{ Form::button('Cancel' ,array('class' => 'form__button--sub form__button--sub--signup')) }}
                            </a>
                            {{ Form::submit('Send Enquiry', array('class' => 'side__login__button side__login__button--signup')) }}
                        
                        </div>
                    </div>
                {{ Form::close() }}         
            </div>
        </section>
        </div>
    </section><!--End Band Content-->
@stop

@section('_footer')
	<script type="text/javascript" src="/public/js/flexslider.js"></script>
	<script type="text/javascript" src="/public/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
@stop