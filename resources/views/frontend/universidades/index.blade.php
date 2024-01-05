@extends('frontend.layouts.master')


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
                    <i class="fa fa-list"></i> Oferta Educativa en <b>Seguridad Informática y Seguridad de Información</b> por Universidades
                </div>
				<div class="panel-body">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Universidad</th>
                                <th>Sigla</th>
                                <th>Departamento</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th>Facultad</th>
                                <th>Posgrado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n=1; ?>
                            @foreach($universidades as $u)
                            <tr>
                                <td><?php echo $n; $n++; ?></td>
                                <td>{{$u->nombre}}</td>
                                <td>{{$u->sigla}}</td>
                                <td>{{$u->departamento}}</td>
                                <td>{{$u->provincia}}</td>
                                <td>{{$u->distrito}}</td>
                                <td><a href="/facultades_frontend/{{$u->id}}" class="btn btn-default btn-xs"><i class="fa fa-list"></i> Facultades</a></td>
                                <td><a href="/posgrados_frontend/{{$u->id}}" class="btn btn-default btn-xs"><i class="fa fa-list"></i> Posgrados</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div><!-- row -->
@endsection