@extends('backend.layouts.master')

@section('page-header')
    <h1>
       Número de tesis por Grupos de Investigación
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
            text: 'Mapa de Perú',
            align: 'left'
        },
        subtitle: {
            text: 'Temas',
            align: 'left'
        },
        sonification: {
            // Play marker / tooltip can make it hard to click other points
            // while a point is playing, so we turn it off
            showTooltip: false
        },
        legend: {
            layout: 'vertical',
            backgroundColor: '#fff',
            floating: true,
            verticalAlign: 'bottom',
            align: 'left',
            symbolHeight: 450
        },
        colorAxis: {
            min: 1,
            max: 1000,
            type: 'logarithmic',
            stops: [
                [0, '#0B4C63'],
                [0.5, '#7350BB'],
                [0.7, '#3CD391'],
                [0.7, '#99CC33'],
                [0.9, '#4AA0FF']
            ],
            marker: {
                color: '#343'
            }
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
            name: 'Population density',
            sonification: {
                tracks: [{
                    // First play a note to indicate new map area
                    instrument: 'vibraphone',
                    mapping: {
                        pitch: 'c7',
                        volume: 0.3
                    }
                }, {
                    mapping: {
                        // Array of notes to play. We just repeat the same note
                        // and vary the gap between the notes to indicate
                        // density. Note: Can use Array.from in modern browsers
                        pitch: Array.apply(null, Array(25)).map(function () {
                            return 'g2';
                        }),
                        gapBetweenNotes: {
                            mapTo: '-value', // Smaller value = bigger gaps
                            min: 90,
                            max: 1000,
                            mapFunction: 'logarithmic'
                        },
                        pan: 0,
                        noteDuration: 500,
                        playDelay: 150 // Make space for initial notification
                    }
                }, {
                    // Speak the name after a while
                    type: 'speech',
                    language: 'pe-PE', // Speak in French, preferably
                    mapping: {
                        text: '{point.name}',
                        volume: 0.4,
                        rate: 1.5,
                        playDelay: 1500
                    }
                }]
            },
            accessibility: {
                point: {
                    valueDescriptionFormat: '{xDescription}, {point.value} people per square kilometer.'
                }
            },
            events: {
                mouseOut: function () {
                    // Cancel sonification when mousing out of point
                    this.chart.sonification.cancel();
                }
            },
            point: {
                // Handle when to sonify and not
                events: {
                    // We require a click before we start playing, so we don't
                    // surprise users. Also some browsers will block audio
                    // until there have been interactions.
                    click: function () {
                        if (!sonifyOnHover) {
                            this.sonify();
                        } else {
                            this.series.chart.sonification.cancel();
                        }
                        sonifyOnHover = !sonifyOnHover;
                    },
                    mouseOver: function () {
                       
                        if (sonifyOnHover) {
                            this.sonify();
                        }
                    }
                }
            },
            cursor: 'pointer',
            borderColor: '#000',
            dataLabels: {
                enabled: true,
                format: '{point.name}',
            },
            data: [
                ['pe-uc', 189],
                ['pe-ic', 111],
                ['pe-cs', 1021],
                ['pe-md', 97],
                ['pe-sm', 123],
                ['pe-am', 119],
                ['pe-lo', 66],
                ['pe-ay', 59],
                ['pe-145', 72],
                ['pe-hv', 115],
                ['pe-ju', 82],
                ['pe-lr', 162],
                ['pe-lb', 344],
                ['pe-tu', 1],
                ['pe-ap', 3],
                ['pe-ar', 323],
                ['pe-pu', 14],
                ['pe-mq', 236],
                ['pe-ta', 236],
                ['pe-an', 236],
                ['pe-cj', 236],
                ['pe-hc', 3],
                ['pe-3341', 236],
                ['pe-ll', 236],
                ['pe-pa', 236],
                ['pe-pi', 236]
            ]
        }]
    });
})();
</script>
@endsection


@section('content')

        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Tesis por Grupos</h3>
                
            </div>
            <div class="panel-body">

            <figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        This audio map can be interacted with by clicking the map regions. The demo illustrates one way to use the sonification module with maps. Repeated sounds play with varying speed to indicate the population density of a region. After a while, the name of the region is announced with speech. A notification sound plays when moving between regions.
    </p>
</figure>




            </div>
          </div>

       

@endsection