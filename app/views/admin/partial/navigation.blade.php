    <?php //echo Request::segment(2); ?>
    
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li class="tophead">{{ HTML::link('admin/menu/recipes', 'Menu') }}</li>
      </ul>
      <ul class="nav nav-sidebar">
		@if(Auth::user()->user_type === 'Manager' || Auth::user()->user_type === 'ADMIN' )
        	@if (Request::segment(2) === 'menu')
            <li <?php echo (Request::segment(3) === 'categories')? 'class="active"' : 'class=""' ; ?>>{{ HTML::link('admin/menu/categories', 'Categories') }}</li>
            <li <?php echo (Request::segment(3) === 'recipes')? 'class="active"' : 'class=""' ; ?>>{{ HTML::link('admin/menu/recipes', 'Recipes') }}</li>
            <li <?php echo (Request::segment(3) === 'ingredients')? 'class="active"' : 'class=""' ; ?>>{{ HTML::link('admin/menu/ingredients', 'Ingredients') }}</li>
            <li <?php echo (Request::segment(3) === 'metric')? 'class="active"' : 'class=""' ; ?>>{{ HTML::link('admin/menu/metric', 'Metric') }}</li>
            @endif
        @endif
     	</ul>
        
        <ul class="nav nav-sidebar">
        	<li class="head">{{ HTML::link('admin/user/members', 'Users') }}</li>
      	</ul>
      	<ul class="nav nav-sidebar">
        @if (Request::segment(2) === 'user')
       	@if(Auth::user()->user_type === 'Manager' || Auth::user()->user_type === 'ADMIN' )
            <li <?php echo (Request::segment(3) === 'members')? 'class="active"' : 'class=""' ; ?>>{{ HTML::link('admin/user/members', 'Members') }}</li>
            <li <?php echo (Request::segment(3) === 'comments')? 'class="active"' : 'class=""' ; ?>>{{ HTML::link('admin/user/comments', 'Comments') }}</li>
        @endif 
        @endif
        </ul>

		<ul class="nav nav-sidebar">
        	<li class="head">{{ HTML::link('admin/products/catering/packages', 'Products') }}</li>
      	</ul>
      	<ul class="nav nav-sidebar">
        @if (Request::segment(2) === 'products')
         	@if(Auth::user()->user_type === 'Manager' || Auth::user()->user_type === 'ADMIN' )
              <li <?php echo (Request::segment(3) === 'catering')? 'class="active"' : 'class=""' ; ?>>{{ HTML::link('admin/products/catering/packages', 'Catering Packages') }}</li>
              <li <?php echo (Request::segment(3) === 'events')? 'class="active"' : 'class=""' ; ?>>{{ HTML::link('admin/products/events', 'Events') }}</li>
          @endif 
        @endif
        </ul>
        
       	@if(Auth::user()->user_type === 'Manager' || Auth::user()->user_type === 'ADMIN' )
        <ul class="nav nav-sidebar">
        	<li class="head">{{ HTML::link('admin/website/header', 'Website') }}</li>
      	</ul>
      	<ul class="nav nav-sidebar">
        @if (Request::segment(2) === 'website')
            <li <?php echo (Request::segment(3) === 'header')? 'class="active"' : 'class=""' ; ?>>{{ HTML::link('admin/website/header', 'Header Images') }}</li>
            <li <?php echo (Request::segment(3) === 'quotes')? 'class="active"' : 'class=""' ; ?>>{{ HTML::link('admin/website/quotes', 'Quotes') }}</li>
            
        @endif 
       </ul>
        @endif
       <ul class="nav nav-sidebar">
        	<li class="head">{{ HTML::link('logout', 'Logout') }}</li>
      	</ul>
    </div>