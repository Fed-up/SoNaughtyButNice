@extends('tmpl.public')

@section('navigation')
<aside 
  data-role="panel" 
  id="right-panel" 
  data-display="push"
  data-position="right" 
  data-theme="b"
  class="side">
  <div id="navigation" class="">
    <ul class="">
      <a href="/"><li class="side--nav">Home</li></a>
      <a href="/"><li class="side--nav">{{ ((Auth::guest())? '' : ((Auth::user()->admin == 1)? HTML::link('admin', 'Profile') : HTML::link('profile', 'Profile'))) }}</li></a>
      <a class="{{((Request::segment(1) === 'collections')? 'navTab_active' : '')}}" href="/collections"><li class="side--nav">Collections</li></a>
      <a class="{{((Request::segment(1) === 'recipes')? 'navTab_active' : '')}}" href="/recipes"><li class="side--nav">Recipes</li></a>
      <a class="{{((Request::segment(1) === 'ingredients')? 'navTab_active' : '')}}" href="/ingredients"><li class="side--nav">Ingredients</li></a>
      <a class="{{((Request::segment(1) === 'events')? 'navTab_active' : '')}}" href="/events"><li class="side--nav">Events</li></a>
      <a class="{{((Request::segment(1) === 'catering')? 'navTab_active' : '')}}" href="/catering"><li class="side--nav">Catering</li></a>
    </ul>
  </div>
  <p>Right push panel.</p>
  <a href="#" data-rel="close" class="ui-btn ui-corner-all ui-shadow ui-mini ui-btn-inline ui-icon-delete ui-btn-icon-right">Close</a>

</aside><!-- /panel -->}}
@stop