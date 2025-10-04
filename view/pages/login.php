<div class="w3-content w3-card-4 w3-padding-16 w3-round-xlarge" style="margin-top: 64px; max-width: 450px;">
    <h3 class="w3-center w3-section">
        <b>INICIO DE SESIÓN</b> 
        <i class="fa-solid fa-lock"></i>
    </h3>
    
    <section id="new_task" class="w3-padding">

        <div class="w3-content" style="max-width: 450px;" id="new_add_task">

            <form method="post" class="w3-padding-16 w3-round">

               <div class="w3-row-padding">
                
                    <div class="w3-col l12">

                        <label for="task_name" class="w3-small w3-text-grey">TU Email</label>

                        <input class="w3-input w3-border w3-small w3-margin-bottom" type="email" name="email_user" id="email_user" value="" placeholder="Ingresar Email">
                    </div>

               </div>

               <div class="w3-row-padding">
                
                    <div class="w3-col l12">

                        <label for="task_name" class="w3-small w3-text-grey">Tu Password</label>

                        <input class="w3-input w3-border w3-small w3-margin-bottom" type="email" name="email_user" id="email_user" value="" placeholder="Ingresar Email">
                    </div>

               </div>

               <div class="w3-row-padding">
                
                    <div class="w3-col l12">
                        <input type="submit" class="w3-button w3-block w3-dark-grey" value="INGRESAR">
                    </div>

               </div>

               <div class="w3-row-padding">

                <?php 

                    $login = new Controller_User();
                    $login -> ctrSingIn();
                
                ?>

               </div>

            </form>

        </div>

    </section>

</div>
