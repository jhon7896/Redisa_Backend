@extends('layout.template')

@section('title')
    <title>ZeroGRUPS | SubCategoría</title>
@endsection

@section('titulo')
    Sub Categorías
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('bienvenido.index') }}">Bienvenido</a></li>
    <li class="breadcrumb-item active">Sub Categoría</li>
@endsection

@section('contenido')
    <div class="card-header">
        <h3 class="card-title">Sub Categorías</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true">Lista de Sub Categorías</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Nueva Sub Categoría</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3></h3>
                    <br>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="tabla-subcategory" class="table table-hover display nowrap" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th data-priority="1" class="text-center">ID</th>
                                            <th class="text-center">Categoría</th>
                                            <th class="text-center">Sub Categoría</th>
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
                    <form id="registro-subcategory">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Categoría</label>
                            <select class="form-control" name="create_cate_id" id="create_cate_id">
                                <option value="0">Seleccione ...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->cate_id }}">{{ $category->cate_description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Sub Categoría</label>
                            <input type="text" class="form-control" id="create_subc_description"
                                name="create_subc_description" aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="sub_cate_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Editar Categoría</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="sub_category_edit_form">

                            <div class="modal-body">
                                @csrf
                                <input type="hidden" id="update_subc_id" name="update_subc_id">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Categoría</label>
                                    <select class="form-control" name="update_cate_id" id="update_cate_id">
                                        <option value="0">Seleccione ...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->cate_id }}">{{ $category->cate_description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Categoría</label>
                                    <input type="text" class="form-control" id="update_subc_description"
                                        name="update_subc_description" aria-describedby="emailHelp">
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

        #tabla-subcategory tbody td:eq(0) {
            text-align: left;
        }

        #tabla-subcategory tbody td {
            text-align: center;
        }

    </style>
@endsection
@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-subcategory').DataTable({
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
                    url: "{{ route('sub-categories.index') }}",
                },
                columns: [{
                        data: 'subc_id'
                    },
                    {
                        data: 'subc_description'
                    },
                    {
                        data: 'cate_description'
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
        $('#registro-subcategory').submit(function(e) {
            e.preventDefault();

            var create_subc_description = $('#create_subc_description').val();
            var create_cate_id = $('#create_cate_id').val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('sub-categories.store') }}",
                type: "POST",
                data: {
                    subc_description: create_subc_description,
                    cate_id: create_cate_id,
                    _token: _token

                },
                success: function(response) {
                    if (response) {
                        $('#registro-subcategory')[0].reset();
                        toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {
                            timeOut: 3000
                        });
                        $('#tabla-subcategory').DataTable().ajax.reload();
                    }
                }
            });

        });
    </script>

    {{-- EDITAR --}}
    <script>
        function editSubCategory(subc_id) {
            $.get('sub-categories/' + subc_id + '/edit', function(sub_category) {
                $('#update_subc_id').val(sub_category[0].subc_id);
                $('#update_subc_description').val(sub_category[0].subc_description);
                $('#update_cate_id').val(sub_category[0].cate_id);
                $("input[name=_token]").val();
                $('#sub_cate_edit_modal').modal('toggle');
            })
        }
    </script>

    {{-- ACTUALIZAR --}}
    <script>
        $('#sub_category_edit_form').submit(function(e) {

            e.preventDefault();
            var update_subc_id = $('#update_subc_id').val();
            var update_subc_description = $('#update_subc_description').val();
            var update_cate_id = $('#update_cate_id').val();
            var _token2 = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('sub-categories.actualizar') }}",
                type: "POST",
                data: {
                    subc_id: update_subc_id,
                    subc_description: update_subc_description,
                    cate_id: update_cate_id,
                    _token: _token2
                },
                success: function(response) {
                    if (response) {
                        $('#sub_cate_edit_modal').modal('hide');
                        toastr.info('El registro fue actualizado correctamente.',
                            'Actualizar Registro', {
                                timeOut: 3000
                            });
                        $('#tabla-subcategory').DataTable().ajax.reload();
                    }
                }

            })

        });
    </script>

    {{-- ELIMINAR --}}
    <script>
        var subc_id;
        $(document).on('click', '.delete', function() {
            subc_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#btnEliminar').click(function() {
            $.ajax({
                url: "sub-category/eliminar/" + subc_id,
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
                        $('#tabla-subcategory').DataTable().ajax.reload();

                    }, 2000);
                    $('#btnEliminar').text('Eliminar');
                }
            });
        });
    </script>
@endsection
