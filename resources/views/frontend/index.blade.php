@extends('frontend.layouts.master')

@section('renderjs')
<style>
.highcharts-figure {
    min-width: 420px;
    max-width: 900px;
    margin: 0 auto;
}

#container {
    height: 550px;
}

.loading {
    margin-top: 10em;
    text-align: center;
    color: gray;
}
/*******************************/
.footer-bs {
    background-color: #263238;
    padding: 60px 40px;
    color: rgba(255,255,255,1.00);
    margin-bottom: 20px;
    margin-top: 50px;
    border-bottom-right-radius: 6px;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 6px;
}
.footer-bs .footer-brand, .footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { padding:10px 25px; }
.footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { border-color: transparent; }
.footer-bs .footer-brand h2 { margin:0px 0px 10px; }
.footer-bs .footer-brand p { font-size:12px; color:rgba(255,255,255,0.70); }

.footer-bs .footer-nav ul.pages { list-style:none; padding:0px; }
.footer-bs .footer-nav ul.pages li { padding:5px 0px;}
.footer-bs .footer-nav ul.pages a { color:rgba(255,255,255,1.00); font-weight:bold; text-transform:uppercase; }
.footer-bs .footer-nav ul.pages a:hover { color:rgba(255,255,255,0.80); text-decoration:none; }
.footer-bs .footer-nav h4 {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom:10px;
}

.footer-bs .footer-nav ul.list { list-style:none; padding:0px; }
.footer-bs .footer-nav ul.list li { padding:5px 0px;}
.footer-bs .footer-nav ul.list a { color:rgba(255,255,255,0.80); }
.footer-bs .footer-nav ul.list a:hover { color:rgba(255,255,255,0.60); text-decoration:none; }

.footer-bs .footer-social ul { list-style:none; padding:0px; }
.footer-bs .footer-social h4 {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 3px;
}
.footer-bs .footer-social li { padding:5px 4px;}
.footer-bs .footer-social a { color:rgba(255,255,255,1.00);}
.footer-bs .footer-social a:hover { color:rgba(255,255,255,0.80); text-decoration:none; }

.footer-bs .footer-ns h4 {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom:10px;
}
.footer-bs .footer-ns p { font-size:12px; color:rgba(255,255,255,0.70); }

@media (min-width: 768px) {
    .footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { border-left:solid 1px rgba(255,255,255,0.10); }
}

/*------------Estilos TABS----------------------------------------------------*/
.panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
	border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
	margin-bottom: -1px;
}
/********************************************************************/
/*** PANEL PRIMARY ***/
.with-nav-tabs.panel-primary .nav-tabs > li > a,
.with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
    color: #fff;
}
.with-nav-tabs.panel-primary .nav-tabs > .open > a,
.with-nav-tabs.panel-primary .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
	color: #fff;
	background-color: #3071a9;
	border-color: transparent;
}
.with-nav-tabs.panel-primary .nav-tabs > li.active > a,
.with-nav-tabs.panel-primary .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li.active > a:focus {
	color: #428bca;
	background-color: #fff;
	border-color: #428bca;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #428bca;
    border-color: #3071a9;
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #fff;   
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #3071a9;
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    background-color: #4a9fe9;
}
/*---------------------Busqueda--------------------*/
.form-control-borderless {
    border: none;
}
.form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
    border: none;
    outline: none;
    box-shadow: none;
}
</style>

<script>

</script>
@endsection

@section('content')
	<div class="row">
		<div style="margin-bottom: 10px; margin-left: 10%; margin-right: 10%;">
                <img src="../../images/edusys.png" style="height: auto;" width="100%">
        </div>
		<div class="col-md-10 col-md-offset-1">
			
			<div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-map"></i> Mapa de Oferta Educativa</div>

				<div class="panel-body">
                    <form class="" method="post" class="form" role="form" action="{{route('buscar_tema_frontend')}}" enctype="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">Tema</label>
                            <select class="form-control" required="" name="tema_id" >
                                <option value="">Seleccionar</option>
                                @foreach($temas as $t)
                                    <option value="{{$t->id}}">{{$t->nombre}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" value="Maestria" name="tipo">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">Nivel</label>
                            <select class="form-control" required="" name="tipo_nivel" >
                                <option value="">Seleccionar</option>
                                <option value="1">Pregrado</option>
                                <option value="2">Posgrado</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-2">
                            <input type="submit" class="form-control btn btn-primary" value="Buscar">                
                        </div> 
                    </form>
                </div>
            </div>
        </div>




	</div><!-- row -->

	<div class="">
    <!----------- Footer ------------>
    <footer class="footer-bs">
        <div class="row">
            <div class="col-md-4 footer-brand animated fadeInLeft">
                <h2>EDUSYS</h2>
                <p>Sistema de Mapa de Oferta en Educación Superior en la Macroregión Centro del Perú.</p>
                <p>© 2023 UNAS, Todos los Derechos Reservados</p>
            </div>

            
            <div class="col-md-4 footer-social animated fadeInDown">
                <h4>Enlaces</h4>
                <ul>
                    <li><a href="#">Mapa de oferta</a></li>
                    <li><a href="#">Universidades</a></li>
                    <li><a href="#">¿EDUSYS?</a></li>
                </ul>
            </div>
            <div class="col-md-4 footer-social animated fadeInDown">
                <h4>La Universidad</h4>
                <ul>
                    <li><a href="#">UNAS</a></li>
                    <li><a href="#">Website FIIS</a></li>
                    <li><a href="#">Vicerrectorado de Investigación</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <section style="text-align:center; margin:10px auto;"><p>Desarrollado por el <a target="_blank" href="https://web.facebook.com/ReSeGTI">Grupo de Investigación en Redes, Seguridad y Gestión de TI, FIIS-UNAS</a></p></section>

</div>
@endsection

@section('after-scripts-end')
	<script>
		//Being injected from FrontendController
		console.log(test);
	</script>
@stop