
<style>
  .tab-btn { cursor:pointer; }
  .active-tab { border-bottom: 3px solid #2196F3; color:#2196F3 !important; }
</style>

<body class="w3-light-grey">

<div class="w3-container w3-padding-16">
  <h2><i class="fa-solid fa-user-gear"></i> Mi Cuenta</h2>
</div>

<!-- Navegación -->
<div class="w3-bar w3-white w3-border-bottom">
  <button class="w3-bar-item w3-button tab-btn active-tab" onclick="openTab(event,'perfil')">
    <i class="fa-solid fa-id-card"></i> Perfil
  </button>
  <button class="w3-bar-item w3-button tab-btn" onclick="openTab(event,'clave')">
    <i class="fa-solid fa-key"></i> Cambiar contraseña
  </button>
  <button class="w3-bar-item w3-button tab-btn" onclick="openTab(event,'preferencias')">
    <i class="fa-solid fa-sliders"></i> Preferencias
  </button>
  <button class="w3-bar-item w3-button tab-btn" onclick="openTab(event,'actividad')">
    <i class="fa-solid fa-clock-rotate-left"></i> Actividad
  </button>
</div>

<!-- Contenido -->
<div class="w3-container w3-section w3-padding">

  <!-- PERFIL -->
  <div id="perfil" class="tab-content">
    <div class="w3-card w3-white w3-padding">
      <h3 class="w3-border-bottom w3-padding-8"><i class="fa-solid fa-id-card"></i> Información del Usuario</h3>
      <p><b>Nombre:</b> <?php echo $_SESSION["nombres"] ?></p>
      <p><b>Correo:</b> <?php echo $_SESSION["email"] ?></p>
      <p class="w3-tag w3-green"><b>Rol:</b> <?php echo $_SESSION["rol"] ?></p>
      <p><b>Fecha de registro:</b> <?php echo $_SESSION["fecha_registro"] ?></p>
    </div>
  </div>

  <!-- CAMBIAR CLAVE -->

  <?php 

    $item = "id";
    $valor = $respuesta["id"];
    $responsePass = Controller_User::ctrListUser($item, $valor);
  
  ?>
  <div id="clave" class="tab-content" style="display:none">
    <div class="w3-card w3-white w3-padding">
      <h3 class="w3-border-bottom w3-padding-8"><i class="fa-solid fa-key"></i> Cambiar Contraseña</h3>
      <form method="post" class="w3-container">
        <label>Nueva Contraseña</label>
        <input type="password" name="nuevoPassword" class="w3-input w3-border w3-round w3-margin-bottom">
        <input type="hidden" name="keyApiU" id="keyApiU" value="<?php echo $respuesta["keyApiU"] ?>">
        <input type="hidden" name="idUser" id="idUser" value="<?php echo $respuesta["id"] ?>">
        <button type="submit" class="w3-button w3-dark-grey w3-round"><i class="fa-solid fa-floppy-disk"></i> GUARDAR CAMBIOS</button>
      </form>
      <?php 

        $changePass = new Controller_User();
        $changePass -> ctrChangePass();
      
      ?>
    </div>
  </div>

  <!-- PREFERENCIAS -->
  <div id="preferencias" class="tab-content" style="display:none">
    <div class="w3-card w3-white w3-padding">
      <h3 class="w3-border-bottom w3-padding-8"><i class="fa-solid fa-gear"></i> Preferencias</h3>
      <p>
        <label><input type="checkbox" class="w3-check"> Activar tema oscuro</label>
      </p>
      <p>
        <label><input type="checkbox" class="w3-check" checked> Recibir notificaciones</label>
      </p>
      <button class="w3-button w3-green w3-round"><i class="fa-solid fa-save"></i> Guardar preferencias</button>
    </div>
  </div>

  <!-- ACTIVIDAD -->
  <div id="actividad" class="tab-content" style="display:none">
    <div class="w3-card w3-white w3-padding">
      <h3 class="w3-border-bottom w3-padding-8"><i class="fa-solid fa-chart-column"></i>
 Última actividad</h3>
      <ul class="w3-ul">
        <li><i class="fa-solid fa-check text-green"></i> Completó la tarea #12 (2025-10-01)</li>
        <li><i class="fa-solid fa-key"></i> Último Inició sesión <?php echo $_SESSION["fecha_ingreso"] ?></li>
        <li><i class="fa-solid fa-pen"></i> ¿Editó perfil? <span class="w3-tag w3-blue">SI</span></li>
      </ul>
    </div>
  </div>

</div>

<script>
function openTab(evt, tabName) {
  let i, x, tablinks;
  x = document.getElementsByClassName("tab-content");
  for (i = 0; i < x.length; i++) { x[i].style.display = "none"; }
  tablinks = document.getElementsByClassName("tab-btn");
  for (i = 0; i < tablinks.length; i++) { tablinks[i].classList.remove("active-tab"); }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.classList.add("active-tab");
}
</script>

