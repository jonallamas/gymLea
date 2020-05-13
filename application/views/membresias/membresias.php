<div class="jumbotron">
	<div class="row menuInfoModulo">
		<div class="col-sm-6">
			<h2><?php echo $titulo; ?></h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quia repudiandae, est placeat.</p>
		</div>
		<div class="col-sm-6 text-right">
			<div class="menuBotones">
                <!-- Botoncitos -->
			</div>
		</div>
	</div>
</div>


<div class="row">
    <div class="col-sm-3">
        <div class="panel panel-default">
        <div class="panel-body text-center">
            <small><strong>Total de clientes</strong></small> 
            <h4><?php echo $total_clientes->total; ?></h4>
        </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
        <div class="panel-body text-center">
            <small><strong>Clientes activos</strong></small> 
            <h4><?php echo $total_clientes_activos; ?></h4>
        </div>
        </div>
    </div>

    <div class="col-sm-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#activas" aria-controls="activas" role="tab" data-toggle="tab">Activas</a></li>
            <li><a href="#vencidas" aria-controls="vencidas" role="tab" data-toggle="tab">Vencen hoy</a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="activas">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de membresías activas</div>
                    <table class="table table-striped" id="tabla_membresias" width="100%">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th width="1%">Ident.</th>
                                <th width="95%">Cliente</th>
                                <th width="1%">Membresía</th>
                                <th width="1%">Estado</th>
                                <th width="1%">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="vencidas">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de membresías por vencerse</div>
                    <table class="table table-striped" id="tabla_membresias_vencidas" width="100%">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th width="1%">Ident.</th>
                                <th width="95%">Cliente</th>
                                <th width="1%">Membresía</th>
                                <th width="1%">Estado</th>
                                <th width="1%">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        // Datatable
        $('#tabla_membresias').DataTable({
            "autoWidth": false,
            "language": {
                "url": base_url+"scripts/script_tablas/spanish.json"
            },
            serverSide: true,
            columns: [
                { data: 'id', 'visible':false, 'orderable': true, 'searchable': false },
                { data: 'icono', 'visible':true,    'orderable': false, 'searchable': false },
                { data: 'identificacion',   'visible':true,     'orderable': true, 'searchable': true},
                { data: 'nombre_completo', 'visible':true,    'orderable': false, 'searchable': true },
                { data: 'plan_nombre', 'visible':true,     'orderable': false, 'searchable': true, 'render': function(val, type, row)
                    {
                        return '<span class="mismalinea">'+row.plan_nombre+'</span>';
                    }
                },
                { data: 'estado', 'visible':true,     'orderable': false, 'searchable': true, 'render': function(val, type, row)
                    {
                        return '<span class="label label-success">Activo</span>';
                    }
                },
                { data: 'id', 'visible':true, 'searchable':false, 'orderable': false, 'render': function (val, type, row)
                    {
                        var opciones = '<div class="mismalinea">';
                        opciones += '<a href="membresias/cuenta/'+row.id+'" class="btn btn-sm btn-default">Cuenta</i></a> ';
                        opciones += '</div>';

                        return opciones;
                    }
                }
            ],
            order: [
                [ 0, 'desc' ]
            ],
            ajax: {
                url: 'membresias/lista',
                type: 'POST'
            }
        });

        $('#tabla_membresias_vencidas').DataTable({
            "autoWidth": false,
            "language": {
                "url": base_url+"scripts/script_tablas/spanish.json"
            },
            serverSide: true,
            columns: [
                { data: 'id', 'visible':false, 'orderable': true, 'searchable': false },
                { data: 'icono', 'visible':true,    'orderable': false, 'searchable': false },
                { data: 'identificacion',   'visible':true,     'orderable': true, 'searchable': true},
                { data: 'nombre_completo', 'visible':true,    'orderable': false, 'searchable': true },
                { data: 'plan_nombre', 'visible':true,     'orderable': false, 'searchable': true, 'render': function(val, type, row)
                    {
                        return '<span class="mismalinea">'+row.plan_nombre+'</span>';
                    }
                },
                { data: 'estado', 'visible':true,     'orderable': false, 'searchable': true, 'render': function(val, type, row)
                    {
                        return '<span class="label label-warning">Por vencerse</span>';
                    }
                },
                { data: 'id', 'visible':true, 'searchable':false, 'orderable': false, 'render': function (val, type, row)
                    {
                        var opciones = '<div class="mismalinea">';
                        opciones += '<a href="membresias/cuenta/'+row.id+'" class="btn btn-sm btn-default">Cuenta</i></a> ';
                        opciones += '</div>';

                        return opciones;
                    }
                }
            ],
            order: [
                [ 0, 'desc' ]
            ],
            ajax: {
                url: 'membresias/lista_vencidas',
                type: 'POST'
            }
        });
    });

</script>