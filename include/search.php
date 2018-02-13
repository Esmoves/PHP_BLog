<?php
	require_once('./connection.php');

	$var1 = str_replace(array('%','_'),'',$_POST['var1']);
	if (!$var1)
	{
	    exit('Invalid form value: '.$var1);
	}

	$query = "SELECT * FROM blogs WHERE tekst LIKE :search OR excerp LIKE :search";
	global $db;
	$stmt = $db->prepare($query);
	$stmt->bindValue(':search', '%' . $var1 . '%', PDO::PARAM_INT);
	$stmt->execute();

	/* Fetch all of the remaining rows in the result set */
	print("Fetch all of the remaining rows in the result set:\n");

	$result = $stmt->fetchAll();

	foreach( $result as $row ) {
	    echo $row["id"];
	    echo $row["titel"];
}
?>