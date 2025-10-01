<div class="w3-content">
    <h3 class="w3-center animate__animated animate__fadeInDown">
        <b>NUEVA TASK</b> 
        <i class="fa-solid fa-list-check"></i>
    </h3>
    
    <section id="new_task" class="w3-padding">

        <div class="w3-content" style="max-width: 500px; margin-top: 8px;" id="new_add_task">

            <form method="post" id="formTask" class="w3-padding-16 w3-round">

               <div class="w3-row-padding">
                
                    <div class="w3-col l12">

                        <label for="task_name" class="w3-small w3-text-grey">Título</label>

                        <input class="w3-input w3-border w3-small w3-margin-bottom" type="text" name="task_name" id="task_name" placeholder="Ingresar Título">

                    </div>

               </div>

               <div class="w3-row-padding">

                    <div class="w3-col l6">

                        <label for="limit_date" class="w3-small w3-text-grey">Fecha Límite</label>

                        <input class="w3-input w3-border w3-small w3-margin-bottom" id="limit_date" type="date" name="nombre">

                    </div>

                    <div class="w3-col l6">
                        <label for="selPrioridad" class="w3-small w3-text-grey">Prioridad</label>

                        <select name="selPrioridad" class="w3-select w3-border" id="selPrioridad">

                            <option selected disabled>Seleccionar...</option>
                            <option value="alta">Alta</option>
                            <option value="media">Media</option>
                            <option value="baja">Baja</option>

                        </select>
                    </div>

               </div>

               <div class="w3-row-padding">

                    <div class="w3-col l12">
                        <p></p>
                        <textarea name="descripcion" id="descripcion" class="w3-input w3-border">

                        </textarea>

                    </div>

               </div>

               <div class="w3-row-padding">

                    <div class="w3-col l12">
                        <p>
                            <input type="submit" class="w3-button w3-card w3-block w3-danger" value="Registrar Task">
                        </p>
                    </div>

               </div>

            </form>

        </div>

    </section>

</div>

<script src="view/js/task.js"></script>