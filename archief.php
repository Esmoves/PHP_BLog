<?php
require_once('./include/connection.php');
require_once('./include/include_reader.php');
require_once ('./include/include_html.php');
require_once('./include/include_menu.php');

if(isset($_GET['month']) AND (isset($_GET['year'] ))) {
  $month = $_GET['month'];
  $year = $_GET['year'];

  showblogsbymonth($month, $year);
 }

  // show blogs by selected month and year
  function showblogsbymonth($month, $year){
  global $db;
  //set from and to dates
  $from = date('Y-m-01 00:00:00', strtotime("$year-$month"));
  $to = date('Y-m-31 23:59:59', strtotime("$year-$month"));

  $sql = "SELECT blogs.datum, blogs.id AS 'blog_id'  
  FROM blogs
  WHERE datum >= :from AND datum <= :to
  ORDER BY blogs.id DESC";

  $stmt = $db->prepare($sql);
  $stmt->execute(array(
    ':from' => $from,
    ':to' => $to));
  $result = $stmt->fetchAll();
  foreach($result as $row) { 
    $blog_id = $row['blog_id'];
    getOneBlogFromDB($blog_id); 
  }
    unset($row);
 }
?>
