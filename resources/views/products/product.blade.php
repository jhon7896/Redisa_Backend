@extends('layout.template')

@section('title')
    <title>ZeroGRUPS | Producto</title>
@endsection

@section('titulo')
    Productos
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('bienvenido.index') }}">Bienvenido</a></li>
    <li class="breadcrumb-item active">Producto</li>
@endsection

@section('contenido')
    <div class="card-header">
        <h3 class="card-title">Productos</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true">Lista de Productos</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Nuevo Producto</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3></h3>
                    <br>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="tabla-product" class="table table-hover display nowrap" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th data-priority="1" class="text-center">Código</th>
                                            <th class="text-center">Categoría</th>
                                            <th class="text-center">Sub Categoría</th>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Precio</th>
                                            <th data-priority="2" class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h3></h3>
                    <br>
                    <form id="registro-product">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Categoría</label>
                                    <select class="form-control" name="create_cate_id" id="create_cate_id">
                                        <option value="0">Seleccione ...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->cate_id }}">{{ $category->cate_description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Categoría</label>
                                    <select class="form-control" name="create_subc_id" id="create_subc_id">
                                        <option value="0">Seleccione ...</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Código</label>
                                    <input type="text" class="form-control" id="create_prod_code" name="create_prod_code"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Producto</label>
                                    <input type="text" class="form-control" id="create_prod_name" name="create_prod_name"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Precio</label>
                                    <input type="text" class="form-control" id="create_prod_price"
                                        name="create_prod_price" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stock</label>
                                    <input type="text" class="form-control" id="create_prod_stock"
                                        name="create_prod_stock" aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción</label>
                            <textarea class="form-control textarea" name="create_prod_description"
                                id="create_prod_description"></textarea>
                        </div>



                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="cate_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Editar Categoría</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="product_edit_form">

                            <div class="modal-body">
                                @csrf
                                <input type="hidden" id="update_prod_id" name="update_prod_id">

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Categoría</label>
                                            <select class="form-control" name="update_cate_id" id="update_cate_id">
                                                <option value="0">Seleccione ...</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->cate_id }}">
                                                        {{ $category->cate_description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Sub Categoría</label>
                                            <select class="form-control" name="update_subc_id" id="update_subc_id">
                                                <option value="0">Seleccione ...</option>
                                                @foreach ($sub_categories as $sub_category)
                                                    <option value="{{ $sub_category->subc_id }}">
                                                        {{ $sub_category->subc_description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Código</label>
                                            <input type="text" class="form-control" id="update_prod_code"
                                                name="update_prod_code" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Producto</label>
                                            <input type="text" class="form-control" id="update_prod_name"
                                                name="update_prod_name" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Precio</label>
                                            <input type="text" class="form-control" id="update_prod_price"
                                                name="update_prod_price" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Stock</label>
                                            <input type="text" class="form-control" id="update_prod_stock"
                                                name="update_prod_stock" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control textarea" name="update_prod_description"
                                        id="update_prod_description"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Modal eliminar -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Desea eliminar el registro seleccionado?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="btnEliminar" name="btnEliminar"
                                class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--fin container-->

    </div>
    <div class="card-footer">

    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <style>
        table thead {
            background-color: black;
            color: white;
        }

        #tabla-product tbody td:eq(0) {
            text-align: left;
        }

        #tabla-product tbody td {
            text-align: center;
        }

    </style>
@endsection
@section('js')
    <script src="{{ asset('js/prod_select.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-product').DataTable({
                serverSide: true,
                responsive: true,
                "language": {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad",
                        "collection": "Colección",
                        "colvisRestore": "Restaurar visibilidad",
                        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                        "copySuccess": {
                            "1": "Copiada 1 fila al portapapeles",
                            "_": "Copiadas %ds fila al portapapeles"
                        },
                        "copyTitle": "Copiar al portapapeles",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Mostrar todas las filas",
                            "_": "Mostrar %d filas"
                        },
                        "pdf": "PDF",
                        "print": "Imprimir",
                        "renameState": "Cambiar nombre",
                        "updateState": "Actualizar",
                        "createState": "Crear Estado",
                        "removeAllStates": "Remover Estados",
                        "removeState": "Remover",
                        "savedStates": "Estados Guardados",
                        "stateRestore": "Estado %d"
                    },
                    "autoFill": {
                        "cancel": "Cancelar",
                        "fill": "Rellene todas las celdas con <i>%d<\/i>",
                        "fillHorizontal": "Rellenar celdas horizontalmente",
                        "fillVertical": "Rellenar celdas verticalmentemente"
                    },
                    "decimal": ",",
                    "searchBuilder": {
                        "add": "Añadir condición",
                        "button": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "clearAll": "Borrar todo",
                        "condition": "Condición",
                        "conditions": {
                            "date": {
                                "after": "Despues",
                                "before": "Antes",
                                "between": "Entre",
                                "empty": "Vacío",
                                "equals": "Igual a",
                                "notBetween": "No entre",
                                "notEmpty": "No Vacio",
                                "not": "Diferente de"
                            },
                            "number": {
                                "between": "Entre",
                                "empty": "Vacio",
                                "equals": "Igual a",
                                "gt": "Mayor a",
                                "gte": "Mayor o igual a",
                                "lt": "Menor que",
                                "lte": "Menor o igual que",
                                "notBetween": "No entre",
                                "notEmpty": "No vacío",
                                "not": "Diferente de"
                            },
                            "string": {
                                "contains": "Contiene",
                                "empty": "Vacío",
                                "endsWith": "Termina en",
                                "equals": "Igual a",
                                "notEmpty": "No Vacio",
                                "startsWith": "Empieza con",
                                "not": "Diferente de",
                                "notContains": "No Contiene",
                                "notStarts": "No empieza con",
                                "notEnds": "No termina con"
                            },
                            "array": {
                                "not": "Diferente de",
                                "equals": "Igual",
                                "empty": "Vacío",
                                "contains": "Contiene",
                                "notEmpty": "No Vacío",
                                "without": "Sin"
                            }
                        },
                        "data": "Data",
                        "deleteTitle": "Eliminar regla de filtrado",
                        "leftTitle": "Criterios anulados",
                        "logicAnd": "Y",
                        "logicOr": "O",
                        "rightTitle": "Criterios de sangría",
                        "title": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "value": "Valor"
                    },
                    "searchPanes": {
                        "clearMessage": "Borrar todo",
                        "collapse": {
                            "0": "Paneles de búsqueda",
                            "_": "Paneles de búsqueda (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "Sin paneles de búsqueda",
                        "loadMessage": "Cargando paneles de búsqueda",
                        "title": "Filtros Activos - %d",
                        "showMessage": "Mostrar Todo",
                        "collapseMessage": "Colapsar Todo"
                    },
                    "select": {
                        "cells": {
                            "1": "1 celda seleccionada",
                            "_": "%d celdas seleccionadas"
                        },
                        "columns": {
                            "1": "1 columna seleccionada",
                            "_": "%d columnas seleccionadas"
                        },
                        "rows": {
                            "1": "1 fila seleccionada",
                            "_": "%d filas seleccionadas"
                        }
                    },
                    "thousands": ".",
                    "datetime": {
                        "previous": "Anterior",
                        "next": "Proximo",
                        "hours": "Horas",
                        "minutes": "Minutos",
                        "seconds": "Segundos",
                        "unknown": "-",
                        "amPm": [
                            "AM",
                            "PM"
                        ],
                        "months": {
                            "0": "Enero",
                            "1": "Febrero",
                            "10": "Noviembre",
                            "11": "Diciembre",
                            "2": "Marzo",
                            "3": "Abril",
                            "4": "Mayo",
                            "5": "Junio",
                            "6": "Julio",
                            "7": "Agosto",
                            "8": "Septiembre",
                            "9": "Octubre"
                        },
                        "weekdays": [
                            "Dom",
                            "Lun",
                            "Mar",
                            "Mie",
                            "Jue",
                            "Vie",
                            "Sab"
                        ]
                    },
                    "editor": {
                        "close": "Cerrar",
                        "create": {
                            "button": "Nuevo",
                            "title": "Crear Nuevo Registro",
                            "submit": "Crear"
                        },
                        "edit": {
                            "button": "Editar",
                            "title": "Editar Registro",
                            "submit": "Actualizar"
                        },
                        "remove": {
                            "button": "Eliminar",
                            "title": "Eliminar Registro",
                            "submit": "Eliminar",
                            "confirm": {
                                "_": "¿Está seguro que desea eliminar %d filas?",
                                "1": "¿Está seguro que desea eliminar 1 fila?"
                            }
                        },
                        "error": {
                            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                        },
                        "multi": {
                            "title": "Múltiples Valores",
                            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                            "restore": "Deshacer Cambios",
                            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                        }
                    },
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "stateRestore": {
                        "creationModal": {
                            "button": "Crear",
                            "name": "Nombre:",
                            "order": "Clasificación",
                            "paging": "Paginación",
                            "search": "Busqueda",
                            "select": "Seleccionar",
                            "columns": {
                                "search": "Búsqueda de Columna",
                                "visible": "Visibilidad de Columna"
                            },
                            "title": "Crear Nuevo Estado",
                            "toggleLabel": "Incluir:"
                        },
                        "emptyError": "El nombre no puede estar vacio",
                        "removeConfirm": "¿Seguro que quiere eliminar este %s?",
                        "removeError": "Error al eliminar el registro",
                        "removeJoiner": "y",
                        "removeSubmit": "Eliminar",
                        "renameButton": "Cambiar Nombre",
                        "renameLabel": "Nuevo nombre para %s",
                        "duplicateError": "Ya existe un Estado con este nombre.",
                        "emptyStates": "No hay Estados guardados",
                        "removeTitle": "Remover Estado",
                        "renameTitle": "Cambiar Nombre Estado"
                    }
                },
                ajax: {
                    url: "{{ route('products.index') }}",
                },
                columns: [{
                        data: 'prod_code'
                    },
                    {
                        data: 'cate_description'
                    },
                    {
                        data: 'subc_description'
                    },
                    {
                        data: 'prod_name'
                    },
                    {
                        data: 'prod_price'
                    },
                    {
                        data: 'prod_stock'
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ]
            });
        });
    </script>

    {{-- CREAR --}}
    <script>
        $('#registro-product').submit(function(e) {
            e.preventDefault();

            var create_prod_code = $('#create_prod_code').val();
            var create_prod_name = $('#create_prod_name').val();
            var create_prod_description = $('#create_prod_description').val();
            var create_prod_price = $('#create_prod_price').val();
            var create_prod_stock = $('#create_prod_stock').val();
            var create_subc_id = $('#create_subc_id').val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('products.store') }}",
                type: "POST",
                data: {
                    prod_code: create_prod_code,
                    prod_name: create_prod_name,
                    prod_description: create_prod_description,
                    prod_price: create_prod_price,
                    prod_stock: create_prod_stock,
                    subc_id: create_subc_id,
                    _token: _token

                },
                success: function(response) {
                    if (response) {
                        $('#registro-product')[0].reset();
                        toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {
                            timeOut: 3000
                        });
                        $('#tabla-product').DataTable().ajax.reload();
                    }
                }
            });

        });
    </script>

    {{-- EDITAR --}}
    <script>
        function editProduct(prod_id) {
            $.get('products/' + prod_id + '/edit', function(product) {
                $('#update_prod_id').val(product[0].prod_id);
                $('#update_prod_code').val(product[0].prod_code);
                $('#update_prod_name').val(product[0].prod_name);
                $('#update_prod_description').val(product[0].prod_description);
                $('#update_prod_price').val(product[0].prod_price);
                $('#update_prod_stock').val(product[0].prod_stock);
                $('#update_subc_id').val(product[0].subc_id);
                $('#update_cate_id').val(product[0].cate_id);
                $("input[name=_token]").val();
                $('#cate_edit_modal').modal('toggle');
            })
        }
    </script>

    {{-- ACTUALIZAR --}}
    <script>
        $('#product_edit_form').submit(function(e) {

            e.preventDefault();
            var update_prod_id = $('#update_prod_id').val();
            var update_prod_code = $('#update_prod_code').val();
            var update_prod_name = $('#update_prod_name').val();
            var update_prod_description = $('#update_prod_description').val();
            var update_prod_price = $('#update_prod_price').val();
            var update_prod_stock = $('#update_prod_stock').val();
            var update_subc_id = $('#update_subc_id').val();
            var _token2 = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('products.actualizar') }}",
                type: "POST",
                data: {
                    prod_id: update_prod_id,
                    prod_code: update_prod_code,
                    prod_name: update_prod_name,
                    prod_description: update_prod_description,
                    prod_price: update_prod_price,
                    prod_stock: update_prod_stock,
                    subc_id: update_subc_id,
                    _token: _token2
                },
                success: function(response) {
                    if (response) {
                        $('#cate_edit_modal').modal('hide');
                        toastr.info('El registro fue actualizado correctamente.',
                            'Actualizar Registro', {
                                timeOut: 3000
                            });
                        $('#tabla-product').DataTable().ajax.reload();
                    }
                }

            })

        });
    </script>

    {{-- ELIMINAR --}}
    <script>
        var prod_id;
        $(document).on('click', '.delete', function() {
            prod_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#btnEliminar').click(function() {
            $.ajax({
                url: "product/eliminar/" + prod_id,
                beforeSend: function() {
                    $('#btnEliminar').text('Eliminando...');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        toastr.error('El registro fue eliminado correctamente.',
                            'Eliminar Registro', {
                                timeOut: 3000
                            });
                        $('#tabla-product').DataTable().ajax.reload();

                    }, 2000);
                    $('#btnEliminar').text('Eliminar');
                }
            });
        });
    </script>
@endsection
