<?php
	$busca="";
	$busca=$_POST('busca');
	mysql_connect("localhost", "root");
	mysql_select_db(/*database_name*/);
	if ($busca!="") {
		$busqueda=mysql_query("select * from /*nombre_tabla*/ where /*nombre*/ like '%".$busca."%'");
	}
?>

<table width="805" border="1">
	<tr>
		<td width="225"></td>
	</tr>
</table>

<?php
	while ($muestra = mysql_fetch_array($busqueda)) {
		echo "<tr>";
		echo "<td>".$muestra['/*elemento_buscado*/'].'</td>';
	}
?>