<?php
include('functions.php');

// 必須項目のチェック
if (
  !isset($_POST['deadline']) || $_POST['deadline'] == '' ||
  !isset($_POST['cat']) || $_POST['cat'] == '' ||
  !isset($_POST['pref']) || $_POST['pref'] == '' ||
  !isset($_POST['task']) || $_POST['task'] == '' ||
  !isset($_POST['name']) || $_POST['name'] == ''
) {
  echo json_encode('param error!');
  http_response_code(500);
  exit();
}

$deadline = $_POST['deadline'];
$cat = $_POST['cat'];
$pref = $_POST['pref'];
$task = $_POST['task'];
$comment = $_POST['comment'];
$name = $_POST['name'];

$pdo = connectToDb();

$sql = 'INSERT INTO todo_table(id, deadline, cat, pref, task, comment, name, created_at, updated_at) VALUES(NULL, :deadline, :cat, :pref, :task, :comment,:name, sysdate(), sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':cat', $cat, PDO::PARAM_STR);
$stmt->bindValue(':pref', $pref, PDO::PARAM_STR);
$stmt->bindValue(':task', $task, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$status = $stmt->execute();


if ($status == false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  showSqlErrorMsg($stmt);
} else {
  echo json_encode(['msg' => 'Create successful!']);
  exit();
}
