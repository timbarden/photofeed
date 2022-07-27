<nav class="navbar navbar-expand-md bg-dark text-white">
	<div class="container">
		<div>
			<a class="navbar-brand" href="{{ url('/') }}">
				{{ config('app.name', 'Laravel') }}
			</a>
			<a href="http://tim-barden.co.uk/?videos" target="_blank">Videos</a>
		</div>

		<div id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			
			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
					<li class="nav-item">
						<a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
				@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<li>
								<a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>
							</li>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</ul>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>