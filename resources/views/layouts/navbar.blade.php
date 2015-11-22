		<nav class="navbar navbar-white" role="navigation">
			<div class = "header-container">
		        <!-- Brand and toggle get grouped for better mobile display -->
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		            <span class="nav-menu-name">{{ translang('Menu') }}</span>
		        <!--
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		        -->
		          </button>
		          <a class="navbar-brand" href="{{ route('home') }}">LuckyBird</a>
		        </div>
		      
		        <!-- Collect the nav links, forms, and other content for toggling -->
		        <div class="collapse navbar-collapse navbar-ex1-collapse">
		          <ul class="nav navbar-nav">
		            <li @if(Route::is('home')) class="active" @endif ><a href="{{ route('home') }}">{{ translang('Post') }}</a></li>
		            <li @if(Route::is('category')) class="active" @endif ><a href="{{ route('category') }}">{{ translang('Category') }}</a></li>
		            <li @if(Route::is('tag')) class="active" @endif ><a href="{{ route('tag') }}">{{ translang('Tag') }}</a></li>

		          </ul>
		          <ul class="nav navbar-nav navbar-right">

		            @if (Auth::guest())
						<li @if(Route::is('getLogin')) class="active" @endif ><a href="{{ route('getLogin') }}">{{ translang('Login') }}</a></li>
						<li @if(Route::is('getRegister')) class="active" @endif ><a href="{{ route('getRegister') }}">{{ translang('Register') }}</a></li>
										
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<span class="caret pull-right nav-dropdown-icon"></span>
								<span class="nav-user-name">{{ Auth::user()->name }}</span> 
								
							</a>
							<ul class="dropdown-menu nav-dropdown-list" role="menu">
								
								<li><a href="{{ route('getPostMine') }}">{{ translang('My Posts') }}</a></li>
								<li><a href="{{ route('getPostCreate') }}" class="reload-button">{{ translang('Create Post') }}</a></li>
								<li><a href="{{ route('getCategoryCreate') }}">{{ translang('Add Category') }}</a></li>
								<li><a href="{{ route('getLogout') }}">{{ translang('Logout')}}</a></li>
							</ul>
						</li>
					@endif
		          </ul>
		        </div><!-- /.navbar-collapse -->
		    </div>
		</nav>
