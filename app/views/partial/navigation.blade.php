    @section('_head')
		    
    @stop
   <div id="nav">
      <div class="navbar navbar-default navbar-static">
        <div class="container">
          <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
          <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="glyphicon glyphicon-bar"></span>
            <span class="glyphicon glyphicon-bar"></span>
            <span class="glyphicon glyphicon-bar"></span>
          </a>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li class="divider">{{ (Auth::user())? HTML::link('admin', 'Profile') : HTML::link('login', 'Sign In') }}</li>
              <li><a href="#"></a></li>
              <li><a href="/collections">Collections</a></li>
              <li><a href="/recipes">Recipes</a></li>
              <li><a href="#">Ingredients</a></li>
              <li><a href="#">Events</a></li>
              <li><a href="#">Catering</a></li>
              <li><a href="#">Books</a></li>
            </ul>
            <ul class="nav navbar-nav divider pull-right">
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Instagram</a></li>
              <li><a href="#">YouTube</a></li>
            </ul>
          </div>		
        </div>
      </div><!-- /.navbar -->
    </div>



