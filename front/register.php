<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>login</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<style>
  h1 {
    text-align: center;
    font-size: 200%;
    color: #fff;
    padding: 30px;
    border: #094128 1px dotted;
    border-left: coral 10px solid;
    background-color: rgb(55, 211, 55);
  }

  h2 {
    padding: 5px 20px;
    background-position: center top;
  }

  input {
    width: 100px;
  }
</style>

<body style="background-color: rgb(161, 243, 161);">
  <h1>みんなの掲示板👨‍👩‍👦‍👦新規登録ページ</h1>
  <fieldset>
    <form>
      <div>
        <label for="user_id">ユーザーID</label>
        <input type="text" id="user_id">
      </div>
      <div>
        <label for="password">パスワード</label>
        <input type="text" id="password">
      </div>
      <button type="button" id="send" style="background-color:orchid;">登録</button>
    </form>
    <a href="login.php">ログインページ</a>
  </fieldset>

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <script>
    document.getElementById('send').addEventListener('click', () => {
      // loginの処理
      // formのキーとバリューを入れる容器を準備する
      const postData = new FormData();
      // postDataに必要なパラメータを追加する
      postData.append('user_id', document.getElementById('user_id').value);
      postData.append('password', document.getElementById('password').value);
      console.log(...postData.entries());
      // 送信先urlの指定
      const loginUrl = '../api/register_act.php'
      // 送信の処理
      axios.post(loginUrl, postData)
        .then(response => {

          // 成功した時
          console.log(response);
          // レスポンスがtrueだったらメインページへ移動
          if (response.data.result == true) {

            location.href = 'index.php';
          } else {

            // falseだったら何もしない
            alert('error');
            return false;
          }

          // 入力欄を空にする処理
          document.getElementById('user_id').value = '';
          document.getElementById('password').value = '';
        })
        .catch(error => {
          // 失敗した時
          console.log(error);
          alert(error);
        })
        .finally(() => {
          // 成功失敗どちらでも実行
        });
    });
  </script>
</body>

</html>