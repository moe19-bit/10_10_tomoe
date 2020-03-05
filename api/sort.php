<?php
include('functions.php');

// データ受け取り
$columnName = $_GET['columnName'];


$pdo = connectToDb();


$sql = "SELECT * FROM todo_table ORDER BY {$columnName} ASC";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ表示
$view = '';
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  // fetchAll()でSQL実行結果を全件取得できる
  echo json_encode($stmt->fetchAll());
  exit();
}
