@extends('backend.layouts.master')

@section('page-header')
    <h1>
       {{$universidad->nombre}}
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
                <h3 class="panel-title">Editar datos de la Universidad</h3>
                <div class="pull-right">
                    <a class="btn btn-default btn-xs" href="/universidades"><span class="glyphicon glyphicon"></span> Regresar</a>                                      
                </div>
            </div>
            <div class="panel-body">
            
            <form class="" method="post" class="form" role="form" action="{{route('update_universidad')}}" enctype="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$universidad->nombre}}" required="">
                <input type="hidden" value="{{$universidad->id}}" name="id" id="id">
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Sigla</label>
                <input type="text" class="form-control" id="sigla" name="sigla" value="{{$universidad->sigla}}" required="">
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Departamento</label>
                <input type="text" class="form-control" id="departamento" name="departamento" value="{{$universidad->departamento}}" required="">
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Provincia</label>
                <input type="text" class="form-control" id="provincia" name="provincia" value="{{$universidad->provincia}}" required="">
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Distrito</label>
                <input type="text" class="form-control" id="distrito" name="distrito" value="{{$universidad->distrito}}" required="">
              </div>

              <input type="submit" class="btn btn-primary" value="Actualizar" />
            </form>


            </div>
          </div>

       

@endsection