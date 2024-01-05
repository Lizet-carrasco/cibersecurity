@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Panel de Administración
    </h1>
@endsection



@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Bienvenido {!! auth()->user()->name !!}!</h3>
          <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            Bienvenido al Panel de Administración del Sistema de Mapa de Oferta en Educación Superior.
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection