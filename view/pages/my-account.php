<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Mi Cuenta</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .tab-btn { cursor:pointer; }
    .active-tab { border-bottom: 3px solid #2196F3; color:#2196F3 !important; }
  </style>
</head>
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
<div class="w3-container w3-padding">

  <!-- PERFIL -->
  <div id="perfil" class="tab-content">
    <div class="w3-card w3-white w3-padding">
      <h3 class="w3-border-bottom w3-padding-8"><i class="fa-solid fa-id-card"></i> Información del Usuario</h3>
      <p><b>Nombre:</b> <?php echo $_SESSION["nombres"] ?></p>
      <p><b>Correo:</b> <?php echo $_SESSION["email"] ?></p>
      <p><b>Rol:</b> Administrador</p>
      <p><b>Fecha de registro:</b> 2025-09-01</p>
    </div>
  </div>

  <!-- CAMBIAR CLAVE -->
  <div id="clave" class="tab-content" style="display:none">
    <div class="w3-card w3-white w3-padding">
      <h3 class="w3-border-bottom w3-padding-8"><i class="fa-solid fa-key"></i> Cambiar Contraseña</h3>
      <form class="w3-container">
        <label>Contraseña actual</label>
        <input type="password" class="w3-input w3-border w3-round w3-margin-bottom">
        <label>Nueva contraseña</label>
        <input type="password" class="w3-input w3-border w3-round w3-margin-bottom">
        <label>Confirmar nueva contraseña</label>
        <input type="password" class="w3-input w3-border w3-round w3-margin-bottom">
        <button class="w3-button w3-dark-grey w3-round"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
      </form>
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
        <li><i class="fa-solid fa-key"></i> Inició sesión (2025-10-02)</li>
        <li><i class="fa-solid fa-pen"></i> Editó perfil (2025-09-25)</li>
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

</body>
</html>
