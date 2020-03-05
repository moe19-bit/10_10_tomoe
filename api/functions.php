<?php
function connectToDb()
{
  $dbn = 'mysql:dbname=gsacfd05_10;charset=utf8;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';
  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    exit('dbError:' . $e->getMessage());
  }
}


function showSqlErrorMsg($stmt)
{
  $error = $stmt->errorInfo();
  echo json_encode($error[2]);
  http_response_code(500);
  exit();
}
// ログインしているかどうかのチェック→毎回id再生成 function check_session_id() {
// 失敗時はログイン画面に戻る(セッションidがないor一致しない) 

function check_session_id()
{
  if (
    !isset($_SESSION['session_id']) ||
    $_SESSION['session_id'] != session_id()
  ) {
    header('Location: login.php'); // ログイン画面へ移動
  } else {
    session_regenerate_id(true); // セッションidの再生成
    $_SESSION['session_id'] = session_id(); // セッション変数に格納 }
  }
}
