<div <?php if (!DEBUG_VISIBLE) echo 'style="display:none;"'; ?>>
	<script language="javascript">
    function toggleDiv(div)
    {
        if (document.getElementById(div).style.display == '') 
        {
            document.getElementById(div).style.display = 'none';
        }
        else
        {
            document.getElementById(div).style.display = '';
        }
    }
    </script>
    <?php
    $time_for_execution = $time_end - $time_start;	//TIME FOR FULL PAGE TO EXECUTE
	function convert($size)
	 {
		$unit=array('b','kb','mb','gb','tb','pb');
		return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
	 }
	 
    ?>
    <hr />
    <p>
    Time of execution: <?php echo $time_for_execution;?><br>
    Memory Usage: <?php echo convert(memory_get_usage()); ?><br />
    Connections to database: <?php echo $GLOBALS['database_initialization'];?><br>
    <a href="javascript:toggleDiv('queries');">QUERIES</a>
    <div style="display:none;" id="queries">
    <table width="100%" border="1" cellspacing="3" cellpadding="7">
      <tr>
        <td>Error</td>
        <td>Query</td>
        <td>Results</td>
        <td>Time</td>
        <td>Insert ID</td>
        <td>Fields</td>
        <td>Affected Rows</td>
        
      </tr>
      <?php 
      $queries	= unserialize($GLOBALS['queries']);
      $time		= 0;
      $q		= 0;
      foreach ($queries as $query)
      { 
        $time	+= $query['time'];
        $q++;
      ?>
          <tr>
            <td><?php montanaPrint($query['error']);?></td>
            <td><?php echo $query['query'];?></td>
            <td><?php echo $query['num_rows'];?></td>
            <td><?php echo $query['time'];?></td>
            <td><?php echo $query['insert_id'];?></td>
            <td><?php echo $query['num_fields'];?></td>
            <td><?php echo $query['affected_rows'];?></td>
          </tr>
      <?php
      }
      ?>
    </table><br>
    
    Total time: <?php echo $time;?><br>
    Number of SQL: <?php echo $q;?><br>
    </div>
    </p>
    <p>
    <a href="javascript:toggleDiv('session');">SESSION</a>
    <div style="display:none;" id="session">
        <em>
            <?php montanaPrint($_SESSION); ?>
        </em>
    </div>
    </p>
    <p>
    <a href="javascript:toggleDiv('post');">POST</a>
    <div style="display:none;" id="post">
        <em>
            <?php montanaPrint($_POST); ?>
        </em>
    </div>
    </p>
    <p>
    <a href="javascript:toggleDiv('get');">GET</a>
    <div style="display:none;" id="get">
        <em>
            <?php montanaPrint($GLOBALS["GET"]); ?>
        </em>
    </div>
    </p>
    <p>
    <a href="javascript:toggleDiv('files');">FILES</a>
    <div style="display:none;" id="files">
        <em>
            <?php montanaPrint($_FILES); ?>
        </em>
    </div>
    </p>
</div>
