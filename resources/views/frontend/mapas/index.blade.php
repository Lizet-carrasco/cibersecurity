@extends('frontend.layouts.master')

@section('page-header')
    <h1>
        Analisis de Temas en la Macroregión Centro
     </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection


@section('renderjs')
<style>


</style>

<script>

</script>
@endsection




@section('content')
	<div class="row">

		<div class="col-md-10 col-md-offset-1">
           
			<div class="panel panel-default">
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
@endsection