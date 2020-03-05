<?php
include('functions.php');

$pdo = connectToDb();


$sql = 'SELECT * FROM todo_table';
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
