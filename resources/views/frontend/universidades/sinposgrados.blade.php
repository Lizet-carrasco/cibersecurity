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
                    <i class="fa fa-list"></i> Oferta Educativa de <b>Seguridad Informática y Seguridad de Información</b>
                    <div class="pull-right">                        
                        <a class="btn btn-default btn-xs btn-plus"  href="/universidades_frontend"><< Regresar</a>
                    </div>
                </div>
				<div class="panel-body">
                    Sin registro
                </div>
            </div>
        </div>
	</div><!-- row -->
@endsection