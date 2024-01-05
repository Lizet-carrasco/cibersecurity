@extends('frontend.layouts.master')

@section('page-header')
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection


@section('renderjs')
<style>


</style>

<script>
    new DataTable('#example');
</script>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
           
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <i class="fa fa-list"></i> Oferta Educativa de <b>Seguridad Informática y Seguridad de Información</b> en posgrados (Diplomados, maestria y doctorados) de la {{$universidad->nombre}}
                    <div class="pull-right">                        
                        <a class="btn btn-default btn-xs btn-plus"  href="/universidades_frontend"><< Regresar</a>
                    </div>
                </div>
				<div class="panel-body">

                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr class="filters">
                                <th>N</th>
                                <th>Posgrados</th>
                                <th>Tipo</th>
                                <th>Tema</th>
                                <th>Plan de estudios</th>
                                <th>Periodo</th>
                                <th>Curso(s)</th>                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n=1; ?>
                            @foreach($planes as $pl)
                                <tr>
                                    <td><?php echo $n; $n++; ?></td>
                                    <td>{{$pl->posgrado}}</td>
                                    <td>{{$pl->tipo}}</td>
                                    <td>{{$pl->tema}}</td>
                                    <td><a href="{{$pl->enlace_plan}}" target="_blank">{{$pl->nombre}}</a></td>
                                    <td>{{$pl->periodo_inicio}}-{{$pl->periodo_fin}}</td>
                                    <td>{{$pl->cursos}}</td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
           
                </div>
            </div>
        </div>
	</div><!-- row -->
@endsection