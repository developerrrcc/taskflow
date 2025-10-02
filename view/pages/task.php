<div class="w3-section">
    <div class="w3-row-padding">
        <div class="w3-col l3 m3 s12">
            <input id="searchInput" class="w3-input w3-section w3-border w3-small" type="text" placeholder="Buscar tarea..." oninput="filtrarTareas()">
        </div>

        <div class="w3-col m2 l3 s6">
            <select id="filtroEstado" class="w3-select w3-section w3-border w3-small" onchange="filtrarTareas()">
                <option value="">Estado</option>
                <option value="Pendiente">Pendiente</option>
                <option value="en_progreso">En progreso</option>
                <option value="completada">Completada</option>
            </select>
        </div>

        <div class="w3-col m3 l3 s6">
            <select id="filtroPrioridad" class="w3-select w3-section w3-border w3-small" onchange="filtrarTareas()">
                <option value="">Prioridad</option>
                <option value="alta">Alta</option>
                <option value="media">Media</option>
                <option value="baja">Baja</option>
            </select>
        </div>
        

        <div class="w3-col l3 m3 s6">
            <a href="new-task" class="w3-button w3-black w3-right w3-border w3-section w3-mobile w3-small ">
                REGIS. TASK <i class="fa fa-add"></i>
            </a>

        </div>

    </div>
</div>
<div class="w3-container">
    <table id="tablaTareas" class="w3-table-all w3-small">

        <thead>
            <tr class="">
                <th>#</th>
                <th>Título</th>
                <th>Fecha límite</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>

        <tbody>

            <?php

            $item = null;
            $valor = null;

            $respuesta = Controller_Task::ctrListTask($item, $valor);

            ?>

            <?php foreach ($respuesta as $key => $value): ?>

                <tr data-estado="<?php echo $value["estado"] ?>" data-prioridad="<?php echo $value["prioridad"] ?>">

                    <td><?php echo ($key + 1) ?></td>

                    <td><?php echo $value["titulo"] ?></td>

                    <td><?php echo $value["fecha_limite"] ?></td>

                    <td><span class=""><?php echo strtoupper($value["prioridad"]) ?></span></td>


                    <td style="width: 150px;">
                        <select class="w3-select w3-border estado" onchange="cambiarEstado(this)">
                            <option value="pendiente" selected>Pendiente</option>
                            <option value="en_progreso">En progreso</option>
                            <option value="completada">Completada</option>
                        </select>
                        <span class="w3-tag w3-pink w3-section estado-tag">Pendiente</span>
                    </td>
                    <td>
                        <a href="index.php?route=update-task&token=<?php echo $value["keyApi"] ?>"
                            class="w3-btn w3-tiny w3-border w3-card btnEditarTask">
                            EDITAR <i class="fa fa-edit"></i>
                        </a>

                        <button
                            class="w3-btn w3-tiny w3-border w3-card w3-info btnViewTask"
                            data-id="<?php echo $value["keyApi"] ?>"
                            onclick="document.getElementById('id01').style.display='block'">
                            VER <i class="fa fa-eye"></i>
                        </button>

                        <a
                            href="index.php?route=delete-task&token=<?php echo $value["keyApi"] ?>" class="w3-btn w3-tiny w3-border w3-card w3-danger">
                            ELIMINAR <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>
</div>

<!-- RSVP modal -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="padding:16px;max-width:600px">
        <span class="w3-button w3-tiny w3-right" onclick="document.getElementById('id01').style.display='none'"><i class="fa fa-times"></i></span>
        <div class="w3-container w3-white w3-center">
            <h2 class="w3-text-grey">
                DETALLES DE TAREA 
                <i class="fa-solid fa-list-check"></i>
            </h2>
            <!-- CONTENIDO (para insertar en el modal-body) -->
            <div class="w3-container w3-padding">

                <table class="w3-table-all w3-small" style="margin-bottom:12px">
                    <tbody>
                        <tr>
                            <td style="width:35%"><strong>ID</strong></td>
                            <td>#12345</td>
                        </tr>

                        <tr>
                            <td><strong>Estado</strong></td>
                            <td><span class="w3-tag w3-round">Completada</span></td>
                        </tr>

                        <tr>
                            <td><strong>Prioridad</strong></td>
                            <td><span class="w3-tag w3-round">Alta</span></td>
                        </tr>

                        <tr>
                            <td><strong>Fecha creación</strong></td>
                            <td>01/10/2025 14:20</td>
                        </tr>

                        <tr>
                            <td><strong>Fecha límite</strong></td>
                            <td>15/10/2025</td>
                        </tr>

                        <tr>
                            <td><strong>Asignado a</strong></td>
                            <td>Juan Pérez &lt;juan@ejemplo.com&gt;</td>
                        </tr>

                        <tr>
                            <td><strong>Tags</strong></td>
                            <td>
                                <span class="w3-tag w3-light-grey">servidor</span>
                                <span class="w3-tag w3-light-grey">urgente</span>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Título</strong></td>
                            <td>
                                Revisar correos pendientes de la empresa
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Descripción</strong></td>
                            <td>
                                <div class="w3-panel w3-pale-grey w3-round w3-padding-small" style="margin:0">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aquí va la descripción completa de la tarea: pasos, notas y enlaces útiles.
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script>
    function cambiarEstado(select) {
        let fila = select.closest("tr");
        let tag = select.parentElement.querySelector(".estado-tag");
        let estado = select.value;

        // actualizar atributo data-estado
        fila.setAttribute("data-estado", estado);

        if (estado === "pendiente") {
            tag.innerHTML = "Pendiente";
            tag.className = "w3-tag w3-pink w3-section estado-tag";
        } else if (estado === "en_progreso") {
            tag.innerHTML = "En progreso";
            tag.className = "w3-tag w3-green w3-section estado-tag";
        } else if (estado === "completada") {
            tag.innerHTML = "Completada";
            tag.className = "w3-tag w3-info w3-section estado-tag";
        }
    }

    function filtrarTareas() {
        let texto = document.getElementById("searchInput").value.toLowerCase();
        let estado = document.getElementById("filtroEstado").value;
        let prioridad = document.getElementById("filtroPrioridad").value;

        document.querySelectorAll("#tablaTareas tr").forEach(tr => {
            let titulo = tr.cells[1].innerText.toLowerCase();
            let estadoTr = tr.getAttribute("data-estado");
            let prioridadTr = tr.getAttribute("data-prioridad");

            let visible =
                (titulo.includes(texto)) &&
                (estado === "" || estadoTr === estado) &&
                (prioridad === "" || prioridadTr === prioridad);

            tr.style.display = visible ? "" : "none";
        });
    }

    
</script>