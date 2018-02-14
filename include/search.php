<?php
	require_once('./connection.php');
	define("ROW_PER_PAGE",2);

	$search_keyword = '';
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	
	$sql = 'SELECT * FROM blogs WHERE titel LIKE :keyword OR excerp LIKE :keyword OR tekst LIKE :keyword ORDER BY id DESC ';
	
	/* Pagination Code starts */
	$per_page_html = '';
	$page = 1;
	$start=0;
	if(!empty($_POST["page"])) {
		$page = $_POST["page"];
		$start=($page-1) * ROW_PER_PAGE;
	}
	$limit=" limit " . $start . "," . ROW_PER_PAGE;
	$pagination_statement = $db->prepare($sql);
	$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pagination_statement->execute();

	$row_count = $pagination_statement->rowCount();
	if(!empty($row_count)){
		$per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
		$page_count=ceil($row_count/ROW_PER_PAGE);
		if($page_count>1) {
			for($i=1;$i<=$page_count;$i++){
				if($i==$page){
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
				} else {
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
				}
			}
		}
		$per_page_html .= "</div>";
	}
	
	$query = $sql.$limit;
	$stmt = $db->prepare($query);
	$stmt->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$stmt->execute();
	if ($stmt->rowCount() > 0) { 
		$result = $stmt->fetchAll();

		foreach( $result as $row ) {
		echo "<table class='excerp'><th>Search result</th>";
		echo "<tr><td>";	
		echo $row["titel"];
		echo "</td><td>";
		echo $row["excerp"];
		echo "</tr>";
		echo "</table>";
		}
	} else {
	echo 'There is nothing to show';
	}


}
?>
