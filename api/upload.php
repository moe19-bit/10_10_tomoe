<?php
include('functions.php');
header('Access-Control-Allow-Origin: *');


// Fileアップロードチェック
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {

  $uploadedFileName = $_FILES['upfile']['name'];
  $tempPathName  = $_FILES['upfile']['tmp_name'];    //アップロード先のTempフォルダ
  $fileDirectoryPath = 'upload/';                    //画像ファイル保管先のディレクトリ名，自分で設定する
  //File名の変更
  $extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);              //拡張子取得
  $uniqueName = date('YmdHis') . md5(session_id()) . "." . $extension;       //ユニークファイル名作成
  $savedFileName = $fileDirectoryPath . $uniqueName;                         //ファイル名とパス
  // FileUpload開始
  if (is_uploaded_file($tempPathName)) {
    if (move_uploaded_file($tempPathName, $savedFileName)) {
      chmod($savedFileName, 0644);
    } else {
      echo json_encode(['error' => 'アップロードできませんでした']);
      http_response_code(500);
      exit();
    }
  } else {
    echo json_encode(['error' => 'ファイルが見つかりません']);
    http_response_code(500);
    exit();
  }
  // FileUpload終了
} else {

  $savedFileName = '';
}

// 必須項目のチェック
if (
  !isset($_POST['deadline']) || $_POST['deadline'] == '' ||
  !isset($_POST['cat']) || $_POST['cat'] == '' ||
  !isset($_POST['pref']) || $_POST['pref'] == '' ||
  !isset($_POST['task']) || $_POST['task'] == '' ||
  !isset($_POST['name']) || $_POST['name'] == ''
) {
  echo json_encode(['error' => 'param error']);
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

$sql = 'INSERT INTO todo_table(id, deadline, cat, pref, task, comment, image, name, created_at, updated_at) VALUES(NULL, :deadline, :cat, :prefs, :task, :comment, :image, :name, sysdate(), sysdate())';

// SQL実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':cat', $cat, PDO::PARAM_STR);
$stmt->bindValue(':pref', $pref, PDO::PARAM_STR);
$stmt->bindValue(':task', $task, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':image', $fileNameToSave, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  showSqlErrorMsg($stmt);
} else {
  echo json_encode(['msg' => 'Upload successful!']);
  exit();
}
