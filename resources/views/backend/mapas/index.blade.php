@extends('backend.layouts.master')

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

        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Seleccionar Tema</h3>
                
            </div>
            <div class="panel-body">
            <form class="" method="post" class="form" role="form" action="{{route('buscar_tema')}}" enctype="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group col-lg-12">
                    <label for="exampleInputEmail1">Tema</label>
                    <select class="form-control" required="" name="tema_id" >
                        <option value="">Seleccionar</option>
                        @foreach($temas as $t)
                        <option value="{{$t->id}}">{{$t->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-2">
                   <input type="submit" class="form-control btn btn-primary" value="Buscar">                
                </div> 
            </form>
            </div>
          </div>

       

@endsection