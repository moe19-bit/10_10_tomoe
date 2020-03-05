<?php
session_start();

include('functions.php');

$pdo = connectToDb();

// 値の受け取り
$user_id = $_POST['user_id'];
$password = $_POST['password'];

$sql = 'SELECT * FROM users_table WHERE user_id=:user_id AND
  password=:password AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();


if ($status == false) {
  showSqlErrorMsg($stmt);
}

// うまくいったらデータ(1レコード)を取得 
$val = $stmt->fetch();

// 抽出データ数を取得
if ($val['id'] != '') {
  $_SESSION = array(); // 配列の初期化
  $_SESSION['session_id'] = session_id();
  //   ユーザーIDを取ってきて、BDのセッションイDに入れる
  $_SESSION['is_admin'] = $val['is_admin'];
  // $val  DBから取ってきたの意味 
  $_SESSION['user_id'] = $val['user_id'];
  echo json_encode(['result' => true, 'user_id' => $_SESSION['user_id']]);
  exit();
} else {

  echo json_encode(['result' => false]);
  exit();
}
