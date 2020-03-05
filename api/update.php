<?php
include('functions.php');

if (
  !isset($_POST['deadline']) || $_POST['deadline'] == '' ||
  !isset($_POST['cat']) || $_POST['cat'] == '' ||
  !isset($_POST['pref']) || $_POST['pref'] == '' ||
  !isset($_POST['task']) || $_POST['task'] == '' ||
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_GET['id']) || $_GET['id'] == ''
) {
  echo json_encode('param error');
  http_response_code(500);
  exit();
}

$deadline = $_POST['deadline'];
$cat = $_POST['cat'];
$pref = $_POST['pref'];
$task = $_POST['task'];
$comment = $_POST['comment'];
$name = $_POST['name'];
$id = $_GET['id'];


$pdo = connectToDb();

$sql = 'UPDATE todo_table SET deadline=:deadline, cat=:cat, pref=:pref, task=:task, comment=:comment, name=:name, updated_at=sysdate() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':cat', $cat, PDO::PARAM_STR);
$stmt->bindValue(':pref', $pref, PDO::PARAM_STR);
$stmt->bindValue(':task', $task, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


if ($status == false) {

  showSqlErrorMsg($stmt);
} else {
  echo json_encode(['msg' => 'Update successful!']);
  exit();
}
