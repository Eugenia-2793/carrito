<?php
include_once("../../estructura/cabecera.php");
$objAbmUsuario = new AbmUsuario();
//$listaUsuario = $objAbmUsuario->buscar(null);   
$listaUsuario = $objAbmUsuario->listarUsuarios(null);

?>
<section>
    <h2>Listar Usuarios</h2>
    <div class="col-9 mt-2 mb-2">
        <!-- Tabla Usuarios -->
        <table id="dg" title="Usuarios" class="easyui-datagrid" url="listarUser.php" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idusuario" width="20">ID</th>
                    <th field="usnombre" width="50">Nombre</th>
                    <th field="uspass" width="120">Contraseña</th>
                    <th field="usmail" width="60">Email</th>
                    <th field="usdeshabilitado" width="70">Deshabilitado</th>
                </tr>
            </thead>
        </table>
        <!-- Botones Edición -->
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoUsuario()">Nuevo
                Usuario</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarUsuario()">Editar
                Usuario</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deshabilitarUsuario()">Eliminar
                Usuario</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Datos Usuario</h3>
                <div style="margin-bottom:10px">
                    <input name="usnombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
                </div>
                <div>
                    <input name="uspass" class="easyui-textbox" type="hidden">
                </div>
                <div style="margin-bottom:10px">
                    <input name="usmail" class="easyui-textbox" required="true" label="E-mail:" style="width:100%">
                </div>
                <div>
                    <input name="idusuario" value="idusuario" type="hidden">
                </div>
                <div>
                    <input name="usdeshabilitado" value="usdeshabilitado" type="hidden">
                </div>

            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarUsuario()" style="width:90px">OK</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        </div>

        </br>

        <table id="dgRol" title="UsuarioRol" class="easyui-datagrid p-3" url="../action/admin/listarUsuarioRol.php" toolbar="#toolbar2" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idusuario" width="50">ID</th>
                    <th field="usnombre" width="50">Usuario</th>
                    <th field="idrol" width="50">Rol</th>
                    <th field="roldescripcion" width="50">Descripcion</th>
                </tr>
            </thead>
        </table>

        <div id="toolbar2">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoUsuarioRol()">Nuevo
                Rol Usuario</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarUsuarioRol()">Eliminar Rol Usuario</a>
        </div>

        <div id="dlgRol" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgRol-buttons'">
            <form id="fmRol" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion UsuarioRol</h3>
                <div style="margin-bottom:10px">
                    <input name="idusuario" class="easyui-textbox" required="true" label="ID Usuario:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="idrol" class="easyui-textbox" required="true" label="ID Rol:" style="width:100%">
                </div>
            </form>
        </div>
        <div id="dlgRol-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarUR()" style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRol').dialog('close')" style="width:90px">Cancelar</a>
        </div>

        </br>

        <table id="dgRoll" title="Rol" class="easyui-datagrid mb-2" url="../roles/listar.php" toolbar="#toolbar3" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idrol" width="50">ID</th>
                    <th field="roldescripcion" width="50">Descripcion</th>
                </tr>
            </thead>
        </table>

        <div id="toolbar3">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoRol()">Nuevo
                Rol</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarRol()">Editar
                Rol</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarRol()">Eliminar Rol</a>
        </div>

        <div id="dlgRoll" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgRoll-buttons'">
            <form id="fmRoll" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Datos Rol</h3>
                <div style="margin-bottom:10px">
                    <input name="roldescripcion" class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
                </div>
                <div>
                    <input name="idrol" value="idrol" type="hidden">
                </div>
            </form>
        </div>
        <div id="dlgRoll-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarRol()" style="width:90px">OK</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRoll').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
    var url;

    function nuevoUsuario() {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Usuario');
        $('#fm').form('clear');
        url = 'alta_user.php';
    }

    function editarUsuario() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Usuario');
            $('#fm').form('load', row);
            url = 'edit_user.php';
        }
    }

    function guardarUsuario() {
        $('#fm').form('submit', {
            url: url,
            iframe: false,
            onSubmit: function() {
                return $(this).form('validate');
            },
            success: function(result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {
                    $('#dlg').dialog('close');
                    $('#dg').datagrid('reload');
                }
            }
        });
    }

    function deshabilitarUsuario() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirmar', '¿Desea cambiar el estado del Usuario?', function(r) {
                if (r) {
                    $('#fm').form('load', row);
                    url = 'baja_user.php';
                    $('#fm').form('submit', {
                        url: url,
                        iframe: false,
                        onSubmit: function() {
                            return $(this).form('validate');
                        },
                        success: function(result) {
                            var result = eval('(' + result + ')');
                            if (result.errorMsg) {
                                $.messager.show({
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            } else {
                                $('#dg').datagrid('reload');
                            }
                        }
                    });
                }
            });
        }
    }

    // UsuarioRol

    function nuevoUsuarioRol() {
        $('#dlgRol').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Usuario Rol');
        $('#fmRol').form('clear');
        url = '../action/admin/createUsuarioRol.php';
    }

    function guardarUR() {
        $('#fmRol').form('submit', {
            url: url,
            iframe: false,
            onSubmit: function() {
                return $(this).form('validate');
            },
            success: function(result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {
                    $('#dlgRol').dialog('close');
                    $('#dgRol').datagrid('reload');
                }
            }
        });
    }

    function eliminarUsuarioRol() {
        var row = $('#dgRol').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirmar', '¿Está seguro que quiere eliminar la selección?', function(r) {
                if (r) {
                    $.post('../action/admin/deleteUsuarioRol.php', {
                        idusuario: row.idusuario,
                        idrol: row.idrol
                    }, function(result) {
                        if (result.respuesta) {
                            $('#dgRol').datagrid('reload');
                        } else {
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        }
                    }, 'json');
                }
            });
        }
    }

    // Rol

    function nuevoRol() {
        $('#dlgRoll').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Rol');
        $('#fmRoll').form('clear');
        url = '../action/admin/createRol.php';
    }

    function editarRol() {
        var row = $('#dgRoll').datagrid('getSelected');
        if (row) {
            $('#dlgRoll').dialog('open').dialog('center').dialog('setTitle', 'Editar Rol');
            $('#fmRoll').form('load', row);
            url = '../action/admin/updateRol.php?idrol=' + row.id;
        }
    }

    function guardarRol() {
        $('#fmRoll').form('submit', {
            url: url,
            iframe: false,
            onSubmit: function() {
                return $(this).form('validate');
            },
            success: function(result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {
                    $('#dlgRoll').dialog('close');
                    $('#dgRoll').datagrid('reload');
                }
            }
        });
    }

    function eliminarRol() {
        var row = $('#dgRoll').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirmar', '¿Desea eliminar la selección?', function(r) {
                if (r) {
                    $.post('../action/admin/deleteRol.php', {
                        idrol: row.idrol
                    }, function(result) {
                        console.log(result);
                        if (result.respuesta) {
                            $('#dgRoll').datagrid('reload');
                        } else {
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        }
                    }, 'json');
                }
            });
        }
    }
</script>

<?php

include_once("../../estructura/pie.php");
?>