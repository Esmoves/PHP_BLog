<?php
require_once('./connection.php');

if (isset($_POST['keyword'])) {
	global $db;
    $keyword = htmlentities($_POST['keyword']);
    $keywordsql = "%" . $keyword . "%";
    
    $sql = "SELECT id, titel, excerp, tekst 
    FROM blogs 
    WHERE tekst LIKE '$keywordsql'
    OR titel LIKE '$keywordsql'
    OR excerp LIKE '$keywordsql'
    ORDER BY titel LIMIT 20";    
	
	$result = $db->query($sql);
	$row = $result->fetch();
	if ( ! $row) {
		$end_result = '<li>Nothing to show.</li>';
    }
    else{
    	$end_result = '';
    	foreach($db->query($sql) as $row){ 
	        $result = $row['titel'];
	        $link = "<a href='./blog.php?blog=" .$row['id']. "'>";
	        // we will use this to bold the search word in result
	        $bold = '<strong>' . $keyword . '</strong>';    
	        $end_result .= '<li>' .$link. str_ireplace($keyword, $bold, $result) . '</a></li>';
	    }
	 }
	 echo $end_result;
	 } 













/*

define("ROW_PER_PAGE",10);

$search_keyword = '';
if(!empty($_POST['search']['keyword'])) {
	$search_keyword = mysql_real_escape_string($_POST['search']['keyword']);
	$search_keyword = htmlentities($search_keyword);
	//searchresult($search_keyword);
}	

function searchresult ($search_keyword){
	global $db;
	$sql = 'SELECT * FROM blogs WHERE titel LIKE :keyword OR excerp LIKE :keyword OR tekst LIKE :keyword ORDER BY id DESC ';
	

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
		$link = "<a href='../blog.php?blog=" .$row['id']. "'>";
		echo "<table class='excerp'><th>Search result</th>";
		echo "<tr><td>";
		echo $link;	
		echo $row["titel"];
		echo "</a></td><td>";
		echo $row["excerp"];
		echo "</tr>";
		echo "</table>"
	;	}
	} else {
	echo 'There is nothing to show';
	}
}
*/
?>
