<?php

header('Content-Type: text/xml; charset=ISO-8859-1'); 
include "conex.php";
// Check connection
if (mysqli_connect_errno())
  {
 	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
else
{	
		mysqli_query($con,"UPDATE juegos SET POSEEDOR ='".$_POST['var1']."', FECHA_ENTREGA='".$_POST['var2']."', ESTADO='".$_POST['var3']."' WHERE TITULO = '".$_POST['var4']."'");
		mysqli_query($con,"UPDATE  `juegos` SET POSEEDOR = REPLACE( POSEEDOR,  'ñ',  '�' )");
		$x=1;
		$result = mysqli_query($con,"SELECT * FROM juegos");
		
		echo"<script>document.getElementById('confirm').style.display='inherit'</script>";
		echo "<table border='1' style='width:100%'>
		<tr bgcolor='#A9E2F3'>
		<th>Juego</th>
		<th>Poseedor</th>
		<th>Fecha</th>
		<th>Estado</th>
		</tr>";
		$bgcolor="";
		$r=0;
		while($row = mysqli_fetch_array($result))
		{ 
		  $y=date("Y",strtotime($row['FECHA_ENTREGA']));
		  if($y==-0001)
		  {
		   $z="<font style='color:red'>No entregado</font>";	
		  }
		  else
		  {
		   $z=date("d-m-Y",strtotime($row['FECHA_ENTREGA']));
		  }
		   if($x==0)
		 {	$bgcolor="bgcolor='#E0E0F8'";
		    $x++;
		 }
		  else
		 {
			$bgcolor="";
			$x=0;
		 }
		  echo "<tr ".$bgcolor." onclick='document.getElementById(\"PROGI\").style.display=\"inherit\";document.getElementById(\"titulo\").value=\"".$row['TITULO']."\";' height='40'>";
		  echo "<td >" . $row['TITULO'] . "</td>";
		  echo "<td align='center'>".$row['POSEEDOR']."</td>";
		  echo "<td align='center'>" .$z. "</td>";
		  echo "<td align='center'>" . $row['ESTADO'] . "</td>";
		  echo "</tr>";
		  $r++;
		}
		echo "</table>";
	}
	
?>