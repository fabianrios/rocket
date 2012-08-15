<?php
require_once(CONTROL_VIEW . "session_header.php");
?>
<div id="contenido">
  <h2>Seleccione la opci&oacute;n a administrar</h2>
  <div class="accesos">
  <div class="acceso_rapido"><img src="imgcontrol/home.jpg" alt="MM Control" />
      <h4><a href="javascript:void(0);">Contactos</a></h4>
      <p>&nbsp;</p>
      <div class="acceso_rapido_links"><a target="_blank" href="index.php?contact.controller/export">Export to XLS</a></div>
      <div class="clear"></div>
    </div>        
    <div class="clear"></div>
  </div>
</div>
<?php
require_once(CONTROL_VIEW . "footer.php");
?>