<?php
include('functions.php');

$id = $_GET['id'];


$pdo = connectToDb();


$sql = "SELECT * FROM todo_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ出力
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  // fetch()でSQL実行結果を1件取得できる
  echo json_encode($stmt->fetch());
  exit();
}
