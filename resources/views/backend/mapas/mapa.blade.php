@extends('backend.layouts.master')

@section('page-header')
    <h1>
       Tema: {{$tema->nombre}}
     </h1>
@endsection

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
                


                <?php if($ayacuchoPregrado==0){?>
                    ['pe-ju',],
                <?php }else{?>
                    ['pe-ju',<?php echo $ayacuchoPregrado ?>,25],
                <?php } ?>

                <?php if($juninPregrado==0){?>
                    ['pe-ju',],
                <?php }else{?>
                    ['pe-ju',<?php echo $juninPregrado ?>,25],
                <?php } ?>

                <?php if($huanucoPregrado==0){?>
                    ['pe-hc',],
                <?php }else{?>
                    ['pe-hc',<?php echo $huanucoPregrado ?>],
                <?php } ?>

                <?php if($pascoPregrado==0){?>
                    ['pe-pa',],
                <?php }else{?>
                    ['pe-pa',<?php echo $pascoPregrado ?>],
                <?php } ?>

                <?php if($huancavelicaPregrado==0){?>
                    ['pe-hv',],
                <?php }else{?>
                    ['pe-hv',<?php echo $huancavelicaPregrado ?>],
                <?php } ?>

                
            ]
        }]
    });
})();
</script>
@endsection


@section('content')

        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Pregrado</h3>
                
            </div>
            <div class="panel-body">
            <figure class="highcharts-figure">
                <div id="container" style="width: 65%; float:left"></div>
                <div style="width: 35%; float: right; font-size:12px">
                    <div><b>Ciudades de la Macroregión:</b></div>
                    <div>
                    @if($ayacuchoPregrado>0)
                        <div>
                            <div><b>Ayacucho ({{$ayacuchoPregrado}}):</b></div>
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

                        @if($huanucoPregrado>0)
                        <div>
                            <div><b>Huánuco ({{$huanucoPregrado}}):</b></div>
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

                        @if($pascoPregrado>0)
                        <div>
                            <div><b>Pasco ({{$pascoPregrado}}):</b></div>
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

                        @if($juninPregrado>0)
                        <div>
                            <div><b>Junin ({{$juninPregrado}}):</b></div>
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

                        @if($huancavelicaPregrado>0)
                        <div>
                            <div><b>Huancavelica({{$huancavelicaPregrado}}):</b></div>
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

       

@endsection