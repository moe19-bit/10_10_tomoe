<?php
include('functions.php');

$searchWord = $_GET['searchWord'];

$pdo = connectToDb();


$sql = "SELECT * FROM todo_table WHERE task LIKE '%{$searchWord}%'";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ表示
$view = '';
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {

  echo json_encode($stmt->fetchAll());
  exit();
}
