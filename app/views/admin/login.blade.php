@extends('tmpl.public')

@section('__header') 
@stop  

@section('content')   
<div class="band page">

    <h2 class="content__title content__title--main"><a class="content__title--link" href="/profile">Hello!! Get excited, healthy desserts are near</a></h2>
    <div class="container row"> <!--Sign up section-->
        <section class="columns small-12 medium-8 medium-push-2 large-8 large-push-2 xlarge-6 xlarge-push-3">
            <div class="section section--form" >
            	{{ Form::open(array('url' => 'login', 'class' => 'form-signin')) }}
                    <a href="/signup" class="side__member__button side__member__button--login">Become a Member</a> 
                	<h2 class="content__title--login">Please Login</h2>    
                    <div class="form__input--side--login">
                        {{ Form::label('email', 'Email: ', array('class' => 'content-title--sub')) }}
                        {{ Form::email('email', '', array('placeholder'=>'Email', 'class'=>'input__text' ) ) }}
                    </div>
                    <div class="form__input--side--login">
                      {{ Form::label('password', 'Password: ', array('class' => 'content-title--sub')) }}
                      {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'input__text' ) ) }}
                    </div>
                    <a href="/">
                        {{ Form::button('Cancel' ,array('class' => 'form__button--sub')) }}
                    </a>
                    {{ Form::submit('Login', array('class' => 'side__login__button')) }}

                {{ Form::close() }}
            </div>
        </section>
    </div>
</div>

@stop