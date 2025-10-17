<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{$page_title}</title>
    <link rel="stylesheet" href="loginAfiliados.css" />
</head>
<body>
    <div class="header">
        <h2>{$page_title}</h2>
        <form method="post" style="display:inline;">
            <button type="submit" name="cerrar_sesion" class="btn-cerrar">Cerrar sesión</button>
        </form>
    </div>

<!-- Afiliados NO verificados -->
<h3>Afiliados no verificados</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Nickname</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Especialidad</th>
            <th>Foto perfil</th>
            <th>INE frente</th>
            <th>INE reverso</th>
            <th>Fecha registro</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    {foreach $afiliados_no_verificados as $a}
        <tr>
            <td>{$a.id}</td>
            <td>{$a.nombre} {$a.apellido_paterno} {$a.apellido_materno}</td>
            <td>{$a.nickname}</td>
            <td>{$a.email}</td>
            <td>{$a.telefono}</td>
            <td>{$a.especialidad}</td>
            <td>
                <img src="{$a.foto_perfil}" alt="Foto perfil" />
            </td>
            <td>
                <a href="{$a.ine_frente}" target="_blank">Ver INE frente</a>
            </td>
            <td>
                <a href="{$a.ine_reverso}" target="_blank">Ver INE reverso</a>
            </td>
            <td>{$a.fecha_registro}</td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="verificar_id" value="{$a.id}">
                    <button type="submit" class="btn-verificar">Verificar</button>
                </form>
                <form method="post" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este afiliado?');">
                    <input type="hidden" name="eliminar_id" value="{$a.id}">
                    <button type="submit" class="btn-eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>

<!-- Afiliados verificados -->
<h3>Afiliados verificados</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Nickname</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Especialidad</th>
            <th>Foto perfil</th>
            <th>INE frente</th>
            <th>INE reverso</th>
            <th>Fecha registro</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    {foreach $afiliados_verificados as $a}
        <tr>
            <td>{$a.id}</td>
            <td>{$a.nombre} {$a.apellido_paterno} {$a.apellido_materno}</td>
            <td>{$a.nickname}</td>
            <td>{$a.email}</td>
            <td>{$a.telefono}</td>
            <td>{$a.especialidad}</td>
            <td>
                <img src="{$a.foto_perfil}" alt="Foto perfil" />
            </td>
            <td>
                <a href="{$a.ine_frente}" target="_blank">Ver INE frente</a>
            </td>
            <td>
                <a href="{$a.ine_reverso}" target="_blank">Ver INE reverso</a>
            </td>
            <td>{$a.fecha_registro}</td>
            <td>
                <form method="post" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este afiliado?');">
                    <input type="hidden" name="eliminar_id" value="{$a.id}">
                    <button type="submit" class="btn-eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>
    <div class="container">
        <div class="admin-info">
            Bienvenido, admin: <strong>{$admin_nombre|escape:'html'}</strong>
        </div>
        {if $afiliados|@count > 0}
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre completo</th>
                        <th>Nickname</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Especialidad</th>
                        <th>Foto perfil</th>
                        <th>INE frente</th>
                        <th>INE reverso</th>
                        <th>Fecha registro</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $afiliados as $a}
                    <tr>
                        <td>{$a.id}</td>
                        <td>{$a.nombre} {$a.apellido_paterno} {$a.apellido_materno}</td>
                        <td>{$a.nickname}</td>
                        <td>{$a.email}</td>
                        <td>{$a.telefono}</td>
                        <td>{$a.especialidad}</td>
                        <td>
                            <img src="{$a.foto_perfil}" alt="Foto perfil" />
                        </td>
                        <td>
                            <a href="{$a.ine_frente}" target="_blank">Ver INE frente</a>
                        </td>
                        <td>
                            <a href="{$a.ine_reverso}" target="_blank">Ver INE reverso</a>
                        </td>
                        <td>{$a.fecha_registro}</td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="verificar_id" value="{$a.id}">
                                <button type="submit" class="btn-verificar">Verificar</button>
                            </form>
                            <form method="post" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este afiliado?');">
                                <input type="hidden" name="eliminar_id" value="{$a.id}">
                                <button type="submit" class="btn-eliminar">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="verificar_id" value="{$a.id}">
                                <button type="submit" class="btn-verificar">Verificar</button>
                            </form>
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            <p>No hay afiliados pendientes de verificación.</p>
        {/if}
    </div>
</body>
</html>