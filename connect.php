<?php	
	
	$host="mysql.hostinger.in";
	$user="u820891166_hele";
	$pass="rum-273#";
	$db="u820891166_hele";
	$sql=new mysqli($host,$user,$pass,$db);
	if($sql->connect_error)
		die("Failed: ".$sql->connect_error);
	
	$result=$sql->query("show tables");
	while($row=$result->fetch_assoc()) {
		echo $row["Tables_in_u820891166_hele"]."\n";
	}
?>
