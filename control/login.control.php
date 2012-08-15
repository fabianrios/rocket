<?php
require_once(CONTROL_VIEW . "header.php");
?>
<script language="javascript">
document.observe("dom:loaded", function() { validInst = new Validator(2, 'alert', true); });
</script>
<div id="contenido">
  <h2>Ingreso al Panel de Control</h2>
  <div class="login_box">
    <div class="aviso00 aviso01" id="alert" style="display:none"></div>
    <div class="loginbox02">
      <form method="post" id="validable" action="index.php?control_user.controller">
        <label> <span class="spanlab">Email</span>
        <input name="user_email" title="Email" type="text" />
        </label>
        <label> <span class="spanlab">Contrase&ntilde;a</span>
        <input name="user_password" title="Contraseña" type="password" />
        </label>
        <label><span class="spanlab">&nbsp;</span>
        <input type="submit" name="button" id="button" value="Entrar" />
        </label>
        <input type="hidden" name="action" value="login" />
      </form>
      <p>Si tiene problemas para ingresar al M&oacute;dulo de Administraci&oacute;n, comun&iacute;quese con el Administrador General: <a href="mailto:email@email.com">email@email.com</a></p>
    </div>
    <!---div class="login_news">
      <h4>Novedades</h4>
      <ul>
        <li>00/00/0000 <a href="#">Lorem Ipsum sit amet sit dolor sit amet</a> </li>
        <li>00/00/0000 <a href="#">Lorem Ipsum sit amet</a> </li>
        <li>00/00/0000 <a href="#">Lorem Ipsum sit amet</a> </li>
      </ul>
    </div--->
  </div>
</div>
<?php
require_once(CONTROL_VIEW . "footer.php");
?>