<?php

function generarClave()
{
    $base = "Peru";
    $numero = rand(1000, 9999);
    return $base . $numero;
}

?>
<div class="w3-section">

    <form id="new_user" method="post">
        <div class="w3-row-padding">

            <div class="w3-col l4 m3 s12">

                <input id="searchInput" class="w3-input w3-section w3-border w3-small" type="text" placeholder="Nombre Completo">
            </div>

            <div class="w3-col m2 l4 s6">
                <input id="email" class="w3-input w3-section w3-border w3-small" type="email" placeholder="Email">
            </div>

            <div class="w3-col m3 l2 s6">
                <input id="pass_temp" class="w3-input w3-section w3-border w3-small" type="text" value="<?php $clave = generarClave();
                echo $clave; ?>" readonly>
            </div>


            <div class="w3-col l2 m3 s6">

                <button type="submit" class="w3-button w3-dark-grey w3-right w3-border w3-section w3-mobile w3-small ">
                    USUARIO <i class="fa fa-add"></i>
                </button>

            </div>

        </div>
    </form>

</div>

<div class="w3-container">
    <table id="tablaTareas" class="w3-table-all w3-small">

        <thead>
            <tr class="">
                <th>#</th>
                <th>Nombres</th>
                <th>Email</th>
                <th>Clave cambiada</th>
                <th>Estado</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>

    </table>
</div>