   <!-- <div style="padding: 10px 20px 10px 20px; height: 80px"> 
		<div style="float:left;">
			<img src="../../images/logo_fiis.png" style="width: auto; height: 60px">
		</div>
		<div style="float:right">
			
		</div>
	</div>-->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header"  style="height: 70px">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><img src="../../images/logo_fiis.png" style="width: auto; height: 50px"></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding: 15px;">
				<ul class="nav navbar-nav">
					<!--<li>
						<a href="/">Inicio</a>
					</li>-->
					<li>
						<a href="/">Mapa de Oferta</a>
					</li>					
					<li>
						<a href="/universidades_frontend">Universidades</a>
					</li>
					<li>
						<a href="/edusys">¿EDUSYS?</a>
					</li>
					<li>
						<a href="https://fiis.unas.edu.pe" target="_blank">Website FIIS</a>
					</li>
					
					
				</ul>

				<ul class="nav navbar-nav navbar-right">


					@if (Auth::guest())
						<li>
							<a href="/auth/login">Iniciar Sesión</a>	
						</li>

					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
							    <li>
									<a href="dashboard">Mi perfil</a>
								</li>
							    

							    @permission('view-backend')
							        <li>
										<a href="admin/dashboard">Administración</a>										
									</li>
							    @endauth

								<li>
									<a href="auth/logout">Cerrar sesión</a>
									
								</li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
