<div class="w3-section">
    <div class="w3-row-padding">
        <div class="w3-col l3 m3 s12">
            <input id="searchInput" class="w3-input w3-section w3-border w3-small" type="text" placeholder="Buscar tarea..." oninput="filtrarTareas()">
        </div>

        <div class="w3-col m3 l3 s6">
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
            <a href="new-task" class="w3-btn w3-round w3-black w3-section w3-mobile w3-small w3-right animate__heartBeat">
                Nueva Tarea 
                <i class="fa fa-add"></i>
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

        <?php foreach($respuesta as $key => $value): ?>

            <tr data-estado="<?php echo $value["estado"] ?>" data-prioridad="<?php echo $value["prioridad"] ?>">

                <td><?php echo ($key+1) ?></td>

                <td><?php echo $value["titulo"] ?></td>

                <td><?php echo $value["fecha_limite"] ?></td>

                <?php if($value["prioridad"] == "alta"): ?>

                    <td><span class="w3-tag w3-danger">Alta</span></td>

                    <?php elseif($value["prioridad"] == "media"): ?>

                        <td><span class="w3-tag w3-pink">Media</span></td>

                    <?php else: ?>

                        <td><span class="w3-tag w3-blue">Baja</span></td>

                <?php endif ?>


                <td  style="width: 150px;">
                    <select class="w3-select w3-border estado" onchange="cambiarEstado(this)">
                        <option value="pendiente" selected>Pendiente</option>
                        <option value="en_progreso">En progreso</option>
                        <option value="completada">Completada</option>
                    </select>
                    <span class="w3-tag w3-pink w3-section estado-tag">Pendiente</span>
                </td>
                <td>
                    <a href="index.php?route=update-task&token=<?php echo $value["keyApi"]?>"
                        class="w3-btn w3-tiny w3-border w3-card btnEditarTask">
                            EDITAR <i class="fa fa-edit"></i>
                    </a>

                    <button 
                        class="w3-btn w3-tiny w3-border w3-card w3-info"
                        data-id="<?php echo $value["keyApi"] ?>"
                        onclick="document.getElementById('id01').style.display='block'"
                        >
                            VER <i class="fa fa-eye"></i>
                    </button>

                    <a 
                        href="index.php?route=delete-task&token=<?php echo $value["keyApi"]?>" class="w3-btn w3-tiny w3-border w3-card w3-pink">
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
  <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="padding:32px;max-width:600px">
    <div class="w3-container w3-white w3-center">
      <h2 class="w3-wide">DETALLES DE TAREA <i class="fa-solid fa-list-check"></i></h2>
      <hr>
      <form>
        
      </form>
      <p><i>Sincerely, John & Jane</i></p>
      <div class="w3-row">
        <div class="w3-half">
          <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-block w3-green">Going</button>
        </div>
        <div class="w3-half">
          <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-block w3-red">Can't come</button>
        </div>
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