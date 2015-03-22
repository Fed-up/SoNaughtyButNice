@extends('tmpl.public')

@section('_header') 
    <script src="/packages/jquery-1.11.1.min/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="/packages/plupload-2.1.2/js/plupload.full.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/css/no-theme/jquery-ui-1.10.4.custom.min.css"/> 
    
    <script>
    $(function() {
      
    // $( "._mySortable" ).sortable({ 
    //   axis: "y", 
    //   opacity: 0.3,
    //   placeholder: "sortable-placeholder",
    //   // callback function
    //   update: function( event, ui ) {
    //     ui.item.css({'background':'#DBEEC9'})
    //   },
    // });
    // $( "._mySortable" ).disableSelection();
    
 
    
    
    
     //Start all Recipes 
    
    //start delete
    $('#counterRecipes').val( $('#_PackageRecipes li').length );
    $('.deleteRecipe').click(function(e) {
      e.preventDefault();
      var currentID = (this.id);
      if($("#ddi" + currentID).length == 0) {
        $('#_PackageRecipes')
            .append( $('<input>',{
              'type':'hidden',
              'name':'ddi[]',
              'id':'ddi'+currentID, /*ddi = delete data recipe*/
              'class':'form-control',
              'value':''+currentID,
            }) )
        ;
        $(this).parent('li').hide().unbind('click');       
      } else {
      //alert('this record already exists');
        $("#ddi" + currentID).closest('input').remove().unbind('click');
      }
    });
    
    //Start Recipes
    $('#counterRecipes').val( $('#_PackageRecipes li').length );
    $('#btnActionAddRecipes').click(function(e) {
      e.preventDefault();
      
      var currentID = $('#counterRecipes').val();
      
      var recipesArray = [];
      <?php
      
      $ix = 0;
      foreach ($recipes as $i=>$v) {
        echo 'recipesArray['.$ix.'] = ["'.$i.'","'.$v.'"]'."\n";
        $ix++;
      }; 

      ?>
      
      var SelectList  = $('<select>',{
            'name':'recipes[][x]',
            'id':'recipes_'+currentID,
            'class':'form__control--no-width columns small-7 medium-8',
          });
      
      $.each(recipesArray, function(key,value) {
        SelectList
          .append($('<option></option>')
          .attr('value',value[0])
          .text(value[1])); 
      });
      
      
      
      var deleteButton  = $('<button>',{
                    'class':'remove columns small-1 medium-1',
                    'content':'x '
                  });
      deleteButton.bind('click', function(e){
        e.preventDefault();
        $(this).parent('li').remove().unbind('click');
      });
      
      $('#_PackageRecipes')
        .append( $('<li>') 
        
          .append( SelectList )
          // .append( '&nbsp;' )
          .append( $('<input>',{
            'name':'amount[][x]',
            'id':'amount_'+currentID,
            'class':'form-control-amount form__control--no-width columns small-3 medium-2',
            'placeholder':'amount'
          }) )
          // .append( '&nbsp;' )
          .append( deleteButton )
          
        )
      ;
      
      $('#counterRecipes').val( parseInt(currentID, 10) + 1 );
      
    }); 
  });

    </script>
@stop

@section('content')

    

    <section class="page">
        <nav class="tabs subnav" data-tab data-options="deep_linking:true; scroll_to_content: false">
            <h2 class="content-title--main content__title--main--tabs {{(isset($active)? '' : 'active')}}"><a class="tab__link" href="#catering">Packages</a></h2> |
            <h2 class="content-title--main content__title--main--tabs {{(isset($active)? 'active' : '')}}"><a class="tab__link" href="#custom">Create Package</a></h2> 
        </nav>
        <section class="tabs-content">
        <!-- <h2 class="content__title content__title--main">Catering Packages</h2> -->

            <div id="catering" class="content {{(isset($active)? '' : 'active')}}">
                <div class="row content-boxes__wrapper">
                    @if (Session::has('message'))
                       <div class="message__alert">{{ Session::get('message') }}</div>
                    @endif
                    @foreach($cData as $index=>$package)
                    <div class="columns small-12 medium-6 large-4 xlarge-3 xxlarge-2 end">
                        <article class="content-box">
                            <div class="row collapse">

                                
                                <a href="/package/{{$package->id}}" class="columns small-4 medium-12 end">
                                  <img src="/uploads/{{$catering_image[$package->id]}}" />
                                </a>
                                

                                <section class="columns small-8 medium-12">
                                    <div class="content-box__copy">
                                        <a href="/package/{{$package->id}}" class="content-box__copy__inner">
                                            <h5 class="content-box__title">{{$package->name}}</h5>
                                            <p class="content-box__summary--display">{{$package->quantity}} pieces</p>
                                        </a>
                                        
                                    </div>
                                </section>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div class=" row">
                <section class="columns small-12 medium-10 medium-push-1 large-8 large-push-2 xlarge-6 xlarge-push-3">
                    <div class="section section--form" >
                        <!-- <h1 class="page-header">@yield('title')</h1> -->
                        
                        @if(isset($user->id))
                             {{ Form::open(array('action' => 'CateringController@packageEnquiry', 'class' => 'form-horizontal')) }}
                        @else
                             {{ Form::open(array('action' => 'CateringController@packageEnquiry', 'class' => 'form-horizontal')) }}
                        @endif
                            <h2 class="content__title--main--signup">@if (Auth::check()) Hi {{ Auth::user()->fname }}, @endif To order a catering package please click on a catering package above.<br/><br/>Otherwise <a class="content-link" href="/login">login</a> & click 'Ceate Package' in the top left corner to design your own package.<br/><br/>To email us directly for a catering package please email us below with the product selection you require =)</h2> 
                            <div class="form-group {{ ($errors->has('fname')) ? 'has-error' : '' ; }}">
                                {{ Form::label('fname', 'Your Name: ', array('class' => ' content-title--sub ')) }}
                                <div class="">
                                    {{ ($errors->has('fname'))? '<p class="error_message">'. $errors->first('fname') .'</p>' : '' }}
                                    {{ Form::text('fname', (isset($input['fname'])? Input::old('fname') : (isset(Auth::user()->fname)? Auth::user()->fname : '' )), array('class' => 'input__text')) }} 
                                </div>
                            </div>
                            
                            <div class="form-group {{ ($errors->has('date')) ? 'has-error' : '' ; }}">
                                {{ Form::label('date', 'Delivery Date: ', array('class' => ' content-title--sub ')) }}
                                <div class="">
                                    {{ ($errors->has('date'))? '<p class="error_message">'. $errors->first('date') .'</p>' : '' }}
                                    {{ Form::text('date', (isset($input['date'])? Input::old('date') : (isset($user->date)? $user->date : '' )), array('class' => 'input__text', 'placeholder' => 'DD / MM / YYYY')) }} 
                                </div>
                            </div>
                            <div class="form-group {{ ($errors->has('time')) ? 'has-error' : '' ; }}">
                                {{ Form::label('time', 'Delivery Time: ', array('class' => ' content-title--sub ')) }}
                                <div class="">
                                    {{ ($errors->has('time'))? '<p class="error_message">'. $errors->first('time') .'</p>' : '' }}
                                    {{ Form::text('time', (isset($input['time'])? Input::old('time') : (isset($user->time)? $user->time : '' )), array('class' => 'input__text')) }} 
                                </div>
                            </div>

                            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' ; }}">
                                {{ Form::label('email', 'Email: ', array('class' => ' content-title--sub ')) }}
                                <div class="">
                                    {{ ($errors->has('email'))? '<p class="error_message">'. $errors->first('email') .'</p>' : '' }}
                                    {{ Form::text('email', (isset($input['email'])? Input::old('email') : (isset(Auth::user()->email)? Auth::user()->email : '' )), array('class' => 'input__text')) }} 
                                </div>
                            </div>
                            <div class="form-group {{ ($errors->has('mobile')) ? 'has-error' : '' ; }}">
                                {{ Form::label('mobile', 'Mobile: ', array('class' => ' content-title--sub ')) }}
                                <div class="">
                                    {{ ($errors->has('mobile'))? '<p class="error_message">'. $errors->first('mobile') .'</p>' : '' }}
                                    {{ Form::text('mobile', (isset($input['mobile'])? Input::old('mobile') : (isset($user->mobile)? $user->mobile : '' )), array('class' => 'input__text')) }} 
                                </div>
                            </div>
                            
                            <div class="form-group {{ ($errors->has('message')) ? 'has-error' : '' ; }}">
                                {{ Form::label('message', 'Detailed Message: ', array('class' => ' content-title--sub ')) }}
                                <div class="">
                                    {{ ($errors->has('message'))? '<p class="error_message">'. $errors->first('message') .'</p>' : '' }}
                                    {{ Form::textarea('message', (isset($input['message'])? Input::old('message') : ''), array('class' => 'input__text', 'placeholder' => 'Example: 12 Chocolate Strawberries, 30 Banana Smoothies and can I please get 12 Rasberry Mousse desserts, for my wedding, except in stead of rasberries I would love it to be made with blueberries =)')) }} 
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form__buttons">
                                    <a href="/">
                                        {{ Form::button('Cancel' ,array('class' => 'form__button--sub form__button--sub--signup')) }}
                                    </a>
                                    {{ Form::submit('Send Enquiry', array('name' => 'email_enquiry','class' => 'side__login__button side__login__button--signup')) }}
                                
                                </div>
                            </div>
                        {{ Form::close() }}         
                    </div>
                </section>
                </div>
            </div>

            <div id="custom" class="row content-boxes__wrapper content {{(isset($active)? 'active' : '')}}">
                @if(isset($confirmation_message))
                               <div class="message__alert">{{ $confirmation_message }}</div>
                            @endif
                @if(Auth::check())
                    <section class="columns small-12 medium-10 medium-push-1 large-8 large-push-2 xlarge-6 xlarge-push-3">
                        {{ Form::open(array('action' => 'CateringController@getCreatePackage', 'class' => 'form-horizontal')) }} 
                            <h2 class="content__title--main--signup">@if (Auth::check()) Hi {{ Auth::user()->fname }}, @endif To create a catering package please select the treats you would like, followed by the amount.<br/><br/>Clicking 'Get Price' will estimate the price of the package for you, this does not include delivery costs and the final prie price may change depending on seasonal avaliability =)</h2> 
                            <div class="col-sm-1">
                                <a id="btnActionAddRecipes" class="add">+ Add</a>
                                <a>{{ Form::submit('Get Price', array('name' => 'public__calc','class' => 'public__calc')) }}</a>
                                <a>{{ Form::submit('Cancel' ,array('name' => 'cancel','class' => 'public__calc--cancel')) }}</a><!-- <p class="public__calc--cancel">Cancel</p> -->
                                {{ Form::hidden('counterRecipes',null,array('id'=>'counterRecipes')) }} 

                            </div>
                            <hr/>
                            @if(isset($last_price))<h4 class="package__total--create-package">Estimated Price: ${{$last_price}}</h4>@endif
                            <div class="form-group {{ ($errors->has('recipes')) ? 'has-error' : '' ; }}">
                                {{ ($errors->has('recipes'))? '<p>'. $errors->first('recipes') .'</p>' : '' }}
                                <ul id="_PackageRecipes" class="_mySortable">
                                    <?php $x = 0; ?>
                                    @if(isset($package_array))
                                        @foreach($package_array as $package)
                                            <li>
                                                <select name="recipes[][{{ $x }}]" id="recipes_{{ $x }}" class="form__control--no-width columns small-7 medium-8"/>
                                                    @foreach($recipes as $i=>$v)                                    
                                                    <option value="{{ $i }}" @if ($package['recipe_id'] == $i) selected="selected" @endif >{{ $v }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                
                                                <input name="amount[][{{ $x }}]" id="recipes_{{ $x }}" class="form-control-amount form__control--no-width columns small-3 medium-2" value="{{ $package['amount'] }}" />
                                              
                                                <button id="{{ $x }}" class="deleteRecipe remove columns small-1 medium-1" content="x"></button>                                                    
                                            </li>
                                            <?php $x++; ?>  
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        

                    </section>
                    
                    <br/>
                    <!-- The Divs below are set there as the row for the larger sections -->
                    @if(isset($package_array))
                    </div><div class=" row">
                    <section class="columns small-12 medium-10 medium-push-1 large-8 large-push-2 xlarge-6 xlarge-push-3">
                        <div class="section section--form form__box" ><!--class = form__box for when the margin needs to be applied instead of padding-->
                            <!-- <h1 class="page-header">@yield('title')</h1> -->
                                <h2 class="content__title--main--signup">@if (Auth::check()) Hi {{ Auth::user()->fname }}, @endif Thank you for creating a catering package!<br/><br/>To confirm your catering package please complete the form below to email us today with the selection you require =)</h2> 
                                <div class="form-group {{ ($errors->has('pname')) ? 'has-error' : '' ; }}">
                                    {{ Form::label('pname', 'Package Name: ', array('class' => ' content-title--sub ')) }}
                                    <div class="">
                                        {{ ($errors->has('pname'))? '<p class="error_message">'. $errors->first('pname') .'</p>' : '' }}
                                        @if(isset($pname_error))<p class="error_message">{{$pname_error}}</p>@endif
                                        {{ Form::text('pname', (isset($input['pname'])? Input::old('pname') : (isset($pname)? $pname : '' )), array('class' => 'input__text', 'placeholder' => 'Short name for the package =)')) }} 
                                    </div>
                                </div>

                                <div class="form-group {{ ($errors->has('fname')) ? 'has-error' : '' ; }}">
                                    {{ Form::label('fname', 'Your Name: ', array('class' => ' content-title--sub ')) }}
                                    <div class="">
                                        {{ ($errors->has('fname'))? '<p class="error_message">'. $errors->first('fname') .'</p>' : '' }}
                                        {{ Form::text('fname', (isset($input['fname'])? Input::old('fname') : (isset(Auth::user()->fname)? Auth::user()->fname : '' )), array('class' => 'input__text')) }} 
                                    </div>
                                </div>
                                
                                <div class="form-group {{ ($errors->has('date')) ? 'has-error' : '' ; }}">
                                    {{ Form::label('date', 'Delivery Date: ', array('class' => ' content-title--sub ')) }}
                                    <div class="">
                                        {{ ($errors->has('date'))? '<p class="error_message">'. $errors->first('date') .'</p>' : '' }}
                                        @if(isset($date_error))<p class="error_message">{{$date_error}}</p>@endif
                                        {{ Form::text('date', (isset($input['date'])? Input::old('date') : (isset($date)? $date : '' )), array('class' => 'input__text', 'placeholder' => 'DD / MM / YYYY')) }} 
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('time')) ? 'has-error' : '' ; }}">
                                    {{ Form::label('time', 'Delivery Time: ', array('class' => ' content-title--sub ')) }}
                                    <div class="">
                                        {{ ($errors->has('time'))? '<p class="error_message">'. $errors->first('time') .'</p>' : '' }}
                                        @if(isset($time_error))<p class="error_message">{{$time_error}}</p>@endif
                                        {{ Form::text('time', (isset($input['time'])? Input::old('time') : (isset($time)? $time : '' )), array('class' => 'input__text')) }} 
                                    </div>
                                </div>

                                <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' ; }}">
                                    {{ Form::label('email', 'Email: ', array('class' => ' content-title--sub ')) }}
                                    <div class="">
                                        {{ ($errors->has('email'))? '<p class="error_message">'. $errors->first('email') .'</p>' : '' }}
                                        {{ Form::text('email', (isset($input['email'])? Input::old('email') : (isset(Auth::user()->email)? Auth::user()->email : '' )), array('class' => 'input__text')) }} 
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('mobile')) ? 'has-error' : '' ; }}">
                                    {{ Form::label('mobile', 'Mobile: ', array('class' => ' content-title--sub ')) }}
                                    <div class="">
                                        {{ ($errors->has('mobile'))? '<p class="error_message">'. $errors->first('mobile') .'</p>' : '' }}
                                        {{ Form::text('mobile', (isset($input['mobile'])? Input::old('mobile') : (isset($mobile)? $mobile : '' )), array('class' => 'input__text')) }} 
                                    </div>
                                </div>
                                
                                <div class="form-group {{ ($errors->has('message')) ? 'has-error' : '' ; }}">
                                    {{ Form::label('message', 'Detailed Message: ', array('class' => ' content-title--sub ')) }}
                                    <div class="">
                                        {{ ($errors->has('message'))? '<p class="error_message">'. $errors->first('message') .'</p>' : '' }}
                                        @if(isset($d_message_error))<p class="error_message">{{$d_message_error}}</p>@endif
                                        {{ Form::textarea('message', (isset($input['message'])? Input::old('message') : (isset($d_message)? $d_message : '' )), array('class' => 'input__text', 'placeholder' => 'Can I please get 12 Rasberry Mousse desserts, for my wedding, except in stead of rasberries I would love it to be made with blueberries =)')) }} 
                                    </div>
                                </div>
                                {{-- Form::hidden('custom_enquiry', 'custom_enquiry') --}}
                                {{ Form::hidden('user_id', Auth::user()->id) }}
                                <div class="form-group">
                                    <div class="form__buttons">
                                        <a href="/">
                                            {{ Form::button('Cancel' ,array('class' => 'form__button--sub form__button--sub--signup')) }}
                                        </a>
                                        {{ Form::submit('Send Enquiry', array('name' => 'custom_enquiry','class' => 'side__login__button side__login__button--signup')) }}
                                    
                                    </div>
                                </div>
                            {{ Form::close() }}         
                        </div>
                    </section>
                    @endif
                

                    
                @else
                  
                    <section class="columns small-12 medium-8 medium-push-2 large-6 large-push-3 xlarge-4 xlarge-push-4">
                        <div class="section section--form" >
                            <h1 class="content__title--main--signup">Create Catering Packages</h1>
                            <p>Please <a class="content-link" href="/login">Login</a> or <a class="content-link" href="/signup">create an account</a> to create a personalised catering package</p>
                        </div>
                    </section>
                @endif
                
            </div>

        </section>
    </section><!--End Band Content-->    
    <div class="footer__push"></div>   
    	   
@stop

@section('_footer')
	<script type="text/javascript" src="/public/js/flexslider.js"></script>
	<script type="text/javascript" src="/public/js/tabs.js"></script>
    <script type="text/javascript" src="/js/gallery.js"></script>
@stop
