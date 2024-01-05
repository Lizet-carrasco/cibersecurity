@extends('backend.layouts.master')

@section('page-header')
    <h1>
       Administración de Universidades
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
                <h3 class="panel-title">Lista de Universidades</h3>     
                <div class="pull-right">
                  <button class="btn btn-default btn-xs btn-plus" data-toggle="modal" data-target="#squarespaceModal"><span class="glyphicon glyphicon-plus"></span> Nueva Universidad</button>
                </div>           
            </div>
            <div class="panel-body">
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th>N</th>
                        <th>Nombre</th>
                        <th>Sigla</th>
                        <th>Departamento</th>
                        <th>Provincia</th>
                        <th>Distrito</th>
                        <th>Facultades</th>
                        <th>Posgrados</th>
                        <th style="width: 12%;">Editar</th>   
                        <th style="width: 12%;">Eliminar</th>                        
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
                    <td><a href="/facultades/{{$u->id}}" class="btn btn-default btn-xs"><i class="fa fa-plus"></i> Facultades</a></td>
                    <td><a href="/posgrados/{{$u->id}}" class="btn btn-default btn-xs"><i class="fa fa-plus"></i> Posgrados</a></td>
                    <td><a href="/editar_universidad/{{$u->id}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Editar</a></td>
                    <td><a href="/eliminar_universidad/{{$u->id}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Eliminar</a></td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
            </div>
          </div>

    
          
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Registrar nueva Universidad</h3>
        </div>
        <div class="modal-body">
            
            <!-- content goes here -->
            <form class="" method="post" class="form" role="form" action="{{route('store_universidad')}}" enctype="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Nombre</label>
                <input class="form-control" name="nombre" id="nombre" required=""/>
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Sigla</label>
                <input class="form-control" name="sigla" id="sigla" required=""/>
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Departamento</label>
                <select class="form-control" name="departamento" id="departamento" required="">
                  <option value="">SELECCIONAR</option>
                  <option value="AYACUCHO">AYACUCHO</option>
                  <option value="HUÁNUCO">HUÁNUCO</option>
                  <option value="JUNIN">JUNÍN</option>
                  <option value="HUANCAVELICA">HUANCAVELICA</option>
                  <option value="PASCO">PASCO</option>
                </select>

                
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Provincia</label>
                <input class="form-control" name="provincia" id="provincia" required=""/>
              </div>
              <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Distrito</label>
                <input class="form-control" name="distrito" id="distrito" required=""/>
              </div>             
			        <input type="submit" class="btn btn-success" value="Guardar" />   
            </form>

        </div>
       
    </div>
  </div>
</div>

@endsection