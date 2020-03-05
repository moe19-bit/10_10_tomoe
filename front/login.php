<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>login</title>
  <link rel="stylesheet" href="css/main.css">
</head>

<body style="background-color: rgb(161, 243, 161);">
  <h1>ログインページ</h1>
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
      <button type="button" id="send" style="background-color:orchid;">ログイン</button>
    </form>
    <a href="register.php">新規登録</a>
  </fieldset>

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <script>
    document.getElementById('send').addEventListener('click', () => {
      // loginの処理

      const postData = new FormData();
      // 新しいデーターを作るよ

      postData.append('user_id', document.getElementById('user_id').value);
      postData.append('password', document.getElementById('password').value);
      console.log(...postData.entries());

      const loginUrl = '../api/login_act.php'

      axios.post(loginUrl, postData)
        .then(response => {

          console.log(response);

          if (response.data.result == true) {
            location.href = 'index.php';
          } else {

            alert('error');
            return false;
          }

          document.getElementById('user_id').value = '';
          document.getElementById('password').value = '';
        })
        .catch(error => {

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