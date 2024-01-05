@extends('backend.layouts.master')

@section('page-header')
    <h1>
       Editar Relación del Tema con el plan de estudios
       <br><b style="font-size:14px">{{$escuela->nombre}}</b>
       <br><b style="font-size:14px">{{$universidad->nombre}}</b>
     </h1>
@endsection



@section('renderjs')
  <style>
    .filterable {
    margin-top: 15px;
    }
    .filterable .panel-heading .pull-right {
      margin-top: -20px;
    }
    .filterable .filters input[disabled] {
      background-color: transparent;
      border: none;
      cursor: auto;
      box-shadow: none;
      padding: 0;
      height: auto;
    }
    .filterable .filters input[disabled]::-webkit-input-placeholder {
      color: #333;
    }
    .filterable .filters input[disabled]::-moz-placeholder {
      color: #333;
    }
    .filterable .filters input[disabled]:-ms-input-placeholder {
      color: #333;
    }

    .center {
    margin-top:50px;   
    }

    .modal-header {
    padding-bottom: 5px;
    }

    .modal-footer {
        padding: 0;
    }
    
    .modal-footer .btn-group button {
    height:40px;
    border-top-left-radius : 0;
    border-top-right-radius : 0;
    border: none;
    border-right: 1px solid #ddd;
    }
    
    .modal-footer .btn-group:last-child > button {
    border-right: 0;
    }
  </style>
  <script>
      $(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
  </script>
@endsection


@section('content')

        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Editar Tema</h3>
                <div class="pull-right">
                    <a class="btn btn-default btn-xs" href="/planes_temas/{{$escuela->id}}"><span class="glyphicon glyphicon"></span> Regresar</a>                                      
                </div>
            </div>
            <div class="panel-body">
            
            <form class="" method="post" class="form" role="form" action="{{route('update_plan')}}" enctype="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Nombre</label>
                <select class="form-control" name="tema_id" id="tema_id" required="">
                  <option value="{{$plan->tema_id}}">{{$plan->tema}}</option>
                  @foreach($temas as $t)
                    @if($t->id!=$plan->tema_id)
                      <option value="{{$t->id}}">{{$t->nombre}}</option>
                    @endif
                  @endforeach
                </select>
                <input type="hidden" value="{{$plan->escuela_id}}" name="escuela_id" id="escuela_id">
                <input type="hidden" value="{{$plan->id}}" name="id" id="id">
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Plan de estudios</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$plan->nombre}}" required="">                
              </div>
              <div class="form-group col-lg-6">
                <label for="exampleInputEmail1">Periodo de inicio</label>
                <input type="text" class="form-control" id="periodo_inicio" name="periodo_inicio" value="{{$plan->periodo_inicio}}" required="">                
              </div>
              <div class="form-group col-lg-6">
                <label for="exampleInputEmail1">Periodo de fin</label>
                <input type="text" class="form-control" id="periodo_fin" name="periodo_fin" value="{{$plan->periodo_fin}}" required="">                
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Enlace</label>
                <input type="text" class="form-control" id="enlace_plan" name="enlace_plan" value="{{$plan->enlace_plan}}" required="">                
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Cursos</label>
                <input type="text" class="form-control" id="curso" name="curso" value="{{$plan->curso}}" required="">                
              </div>

              <input type="submit" class="btn btn-primary" value="Actualizar" />
            </form>


            </div>
          </div>

       

@endsection