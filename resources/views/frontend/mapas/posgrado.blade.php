@extends('frontend.layouts.master')



@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection


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
(async () => {
    let sonifyOnHover = false;

    const topology = await fetch(
        '/js/pe-all.topo.json'
    ).then(response => response.json());

    // Instantiate the map
    Highcharts.mapChart('container', {
        chart: {
            map: topology
        },
        title: {
            text: 'Departamentos de Macroregión Centro: Ayacucho, Huánuco, Huancavelica, Junin y Pasco',
            align: 'left'
        },
        subtitle: {
            text: '',
            align: 'left'
        },
        sonification: {
            // Play marker / tooltip can make it hard to click other points
            // while a point is playing, so we turn it off
            showTooltip: false
        },


        responsive: {
            rules: [{
                condition: {
                    maxWidth: 580
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        floating: false,
                        align: 'center',
                        symbolHeight: 10
                    }
                }
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        series: [{
            name: 'Macroregión Centro',

            accessibility: {
                point: {
                    valueDescriptionFormat: '{xDescription}, {point.value} people per square kilometer.'
                }
            },

            dataLabels: {
                enabled: true,
                format: '{point.name}',
            },
            point: {
                // Handle when to sonify and not
                events: {
                    // We require a click before we start playing, so we don't
                    // surprise users. Also some browsers will block audio
                    // until there have been interactions.
                    
                    click: function () {

                        document.location = '/universidades';

                    }
                }
            },

            cursor: 'pointer',
            borderColor: '#000',
            data: [
                
                <?php if($ayacuchoPosgrado==0){?>
                    ['pe-ay',],
                <?php }else{?>
                    ['pe-ay',<?php echo $ayacuchoPosgrado ?>],
                <?php } ?>

                <?php if($juninPosgrado==0){?>
                    ['pe-ju',],
                <?php }else{?>
                    ['pe-ju',<?php echo $juninPosgrado ?>],
                <?php } ?>

                <?php if($huanucoPosgrado==0){?>
                    ['pe-hc',],
                <?php }else{?>
                    ['pe-hc',<?php echo $huanucoPosgrado ?>],
                <?php } ?>

                <?php if($pascoPosgrado==0){?>
                    ['pe-pa',],
                <?php }else{?>
                    ['pe-pa',<?php echo $pascoPosgrado ?>],
                <?php } ?>

                <?php if($huancavelicaPosgrado==0){?>
                    ['pe-hv',],
                <?php }else{?>
                    ['pe-hv',<?php echo $huancavelicaPosgrado ?>],
                <?php } ?>

                
            ]
        }]
    });
})();
</script>
@endsection


@section('content')
<div class="row">
    <div style="margin-bottom: 10px; margin-left: 10%; margin-right: 10%;">
        <img src="../../images/banner_title.jpg" style="height: auto;" width="100%">
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-map"></i> Mapa de Oferta Educativa - Posgrado (Tema: <b>{{$tema->nombre}}</b>)</br>
          
                <div class="pull-right"> 
                    <a class="btn btn-default btn-xs btn-plus" href="/"> <b><<</b> Regresar</a>
                </div> 
            </div>
            <div class="panel-body">
            <figure class="highcharts-figure">
                <div>
                    <form class="" method="post" class="form" role="form" action="{{route('buscar_tema_frontend')}}" enctype="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <select class="" name="tipo">
                            <option value="">Seleccionar</option>
                            <option value="Maestria">Maestria</option>
                            <option value="Doctorado">Doctorado</option>
                            <option value="Diplomado">Diplomado</option>
                        </select>
                        <input type="hidden" value="{{$tema->id}}" name="tema_id"/>
                        <input type="submit" class="btn btn-primary btn-xs" value="Buscar">
                    </form>
                </div>
                <div style="width: 100%; font-size:22px"><b>>>Analisis Respecto a {{$tipo}}s</b></div>
                
                <div id="container" style="width: 65%; float:left"></div>
                <div style="width: 35%; float: right; font-size:12px">
                                        
               
                    <div><b>Ciudades de la Macroregión:</b></div>
                    
                    <div>

                        @if($ayacuchoPosgrado>0)
                        <div>
                            <div><b>Ayacucho ({{$ayacuchoPosgrado}}):</b></div>
                            <div>
                                <ul>
                                    @foreach($universidades_ayacucho as $hu)
                                    <li style="font-size: 10px !important;">
                                        <a href="{{$hu->enlace_plan}}" target="_blank">{{$hu->nombre}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if($huanucoPosgrado>0)
                        <div>
                            <div><b>Huánuco ({{$huanucoPosgrado}}):</b></div>
                            <div>
                                <ul>
                                    @foreach($universidades_huanuco as $hu)
                                    <li style="font-size: 10px !important;">
                                        <a href="{{$hu->enlace_plan}}" target="_blank">{{$hu->nombre}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if($pascoPosgrado>0)
                        <div>
                            <div><b>Pasco ({{$pascoPosgrado}}):</b></div>
                            <div>
                                <ul>
                                    @foreach($universidades_pasco as $pa)
                                    <li style="font-size: 10px !important;">
                                        <a href="{{$pa->enlace_plan}}" target="_blank">{{$pa->nombre}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if($juninPosgrado>0)
                        <div>
                            <div><b>Junin ({{$juninPosgrado}}):</b></div>
                            <div>
                                <ul>
                                    @foreach($universidades_junin as $ju)
                                    <li style="font-size: 10px !important;">
                                        <a href="{{$ju->enlace_plan}}" target="_blank">{{$ju->nombre}}</a>
                                    </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                        @endif

                        @if($huancavelicaPosgrado>0)
                        <div>
                            <div><b>Huancavelica({{$huancavelicaPosgrado}}):</b></div>
                            <div>
                                <ul>
                                    @foreach($universidades_huancavelica as $hua)
                                    <li style="font-size: 10px !important;">
                                        <a href="{{$hua->enlace_plan}}" target="_blank">{{$hua->nombre}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </figure>
            </div>
        </div>
    </div>
</div>   


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