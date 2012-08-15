<?php 
require_once('session_header.php'); 

$_GET[0] = (isset($_GET[0]) && $_GET[0] != '') ? escape($_GET[0]) : 'tree_date_planting';

$page = isset($_GET[1]) ? $_GET[1] : 1;

$filter = " AND user_id = 0 ORDER by  " . $_GET[0] ;

$trees = TreeHelper::selectTrees($filter);

$system_name = 'uploadTree';

//permissions

$update = "<a href=\"javascript:void(0);\" onclick=\"SimpleAJAXCall('index.php?form_popup.control/updateTrees', loadFormLayer, 'GET', 'window2')\" class=\"cont_administrar2\">Cargar Arboles</a>";

$pager = new Pager($_GET[0], '', '', 'index.php?tree_list.control', 20, $trees['num_rows'], $page); 

$limit = ' LIMIT ' . $pager->arrayStartNumber . ',' . $pager->resultSize; 

$trees = TreeHelper::retrieveTrees($filter . $limit);

?>

<div id="contenido">

	<h2>Arboles</h2>

	<div class="divider" style="background:none;">

	<div class="clear"></div>

    <div id="mainContent">

		<div id="alertBox">

 	       <?php 

		   $alert = (isset($alert)) ? $alert : array();

		   AlertHelper::placeAlerts($alert); 

		   ?>  

        </div>

		<?php 

            echo $update;

        ?>

        <h3>Listado de Arboles</h3>

        <div class="ruta">

           <a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?tree_list.control">Arboles</a>

        </div>

        <table border="0" cellpadding="0" cellspacing="0">

            <tr>

                <th>&nbsp;</th>

                <th><a href="index.php?tree_list.control/specie_id">Especie</a></th>
				
				<th><a href="index.php?tree_list.control/planting_id">Plantacion</a></th>
				
				<th><a href="index.php?tree_list.control/tree_date_planting">Fecha Plantacion</a></th>

            </tr>

            <?php

            foreach($trees as $tree)
            {
				$specieName 	= new Specie($tree->__get('specie_id'));
				$plantingName	= new Planting($tree->__get('planting_id'));
            ?>
               <tr>
                    <td class="table03"><img src="imgcontrol/ico_tree2.gif" width="12" height="12" /></td>
                    <td><?=$specieName->__get('specie_name')?></td>
					<td><?=$plantingName->__get('planting_review')?></td>
					<td><?=$tree->__get('tree_date_planting')?></td>
                </tr>
            <?php

            }

            ?>

        </table>

        <?php $pager->display()?>

    </div>

	</div>

</div>

<?php require_once('footer.php'); ?>