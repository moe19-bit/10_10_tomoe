<?php
session_start();
include('../api/functions.php');
// セッションにuser_idがなければログインページへ移動 
check_session_id();
// あればログアウトのリンクを張ってページ表示
echo "<p>user_id: {$_SESSION['user_id']}</p>";
echo '<a href="../api/logout.php">log out</a>';
?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>php_db_api</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<style>
  h1 {
    text-align: center;
    font-size: 300%;
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
  <button id="getSession">getSession</button>
  <h1>ジモトモ広場👨‍👩‍👦‍👦みんなの掲示板</h1>
  <div style="text-align:center;font-size: 20px;">
    <span>皆さんサイトのルールを良く守って利用しましょう。</span>
  </div>
  <fieldset>
    <legend>search form</legend>
    <form>
      <div>
        <label for="search">search</label>
        <input type="text" id="search" style="background-color:plum;">
      </div>
    </form>
  </fieldset>
  <fieldset>
    <legend>投稿内容</legend>
    <form>
      <div>
        <label for="deadline">締め切り日</label>
        <input type="date" id="deadline">
      </div>
      <p>
        <label for="select">カテゴリー</label>
        <select id="select" name=’cat’ style="background-color:plum;">
          <option value="selected">選択してください</option>
          <option value="助け合い">助け合い</option>
          <option value="メンバー募集">メンバー募集</option>
          <option value="里親募集">里親募集</option>
          <option value="売り買い">売り買い</option>
        </select>
      </p>

      <div>
        <label for="pref">都道府県/市区</label>
        <input type="text" id="pref">
      </div>
      <div>
        <label for="task">ジャンル</label>
        <input type="text" id="task">
      </div>
      <div>
        <label for="comment">コメント</label>
        <textarea name="" id="comment" cols="30" rows="10"></textarea>
      </div>
      <div>
        <label for="image">image</label>
        <input type="file" id="image" accept="image/*">
      </div>
      <div>
        <label for="name">投稿者</label>
        <input type="name" id="name">
      </div>
      <button type="button" id="send" style="background-color:orchid;">投稿</button>
    </form>
  </fieldset>

  <fieldset>
    <legend>data table</legend>
    <table>
      <thead>
        <tr>
          <th></th>
          <th>id</th>
          <th>deadline</th>
          <th>cat</th>
          <th>pref</th>
          <th>task</th>
          <th>comment</th>
          <th>image</th>
          <th>name</th>
          <th>updated_at</th>
        </tr>
      </thead>
      <tbody id="echo"></tbody>
    </table>
  </fieldset>

  <div id="modal" class="modal">
    <div class="modal-content">
      <fieldset>
        <legend>edit form</legend>
        <form>
          <div>
            <label for="deadlineEdit">締め切り日</label>
            <input type="date" id="deadline">

          </div>
          <div>
            <label for="selectEdit">カテゴリー</label>
            <<select id="select" name=’cat’>
              <option value="1">助け合い</option>
              <option value="2" selected>メンバー募集</option>
              <option value="3" selected>里親募集</option>
              <option value="4" selected>売り買い</option>
              <option value="5" selected>選択してください</option>
              </select>
          </div>
          <div>
            <label for="prefEdit">都道府県/市区</label>
            <input type="date" id="deadlineEdit">
          </div>
          <div>
            <label for="taskEdit">ジャンル</label>
            <input type="text" id="taskEdit">
          </div>

          <div>
            <label for="commentEdit">コメント</label>
            <textarea name="" id="commentEdit" cols="30" rows="10"></textarea>
          </div>

          <div>
            <label for="nameEdit">投稿者</label>
            <input type="name" id="name">
          </div>
          <input type="hidden" name="" id="hiddenId">
          <button type="button" id="updateButton">update</button>
        </form>
      </fieldset>
    </div>
  </div>

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <script>
    // モーダルの黒い部分クリックで閉じる処理
    document.getElementById('modal').addEventListener('click', e => {
      // モーダルのフォームクリック時には閉じないように条件を分ける
      if (e.target == document.getElementById('modal')) {
        document.getElementById('modal').style.display = 'none';
      }
    });

    const createUrl = '../api/create.php';
    const readUrl = '../api/read.php';
    // ↓テスト用
    // const readUrl = '../api/test.json';

    // 配列をタグに入れていい感じの形にする関数
    const convertArraytoListTag = array => {
      return array.map(x => {
        return `<tr>
                  <td>
                    <button type="button" class="editButton" value=${x.id}>edit</button>
                    <button type="button" class="deleteButton" value=${x.id}>delete</button>
                  </td>
                 <td>${x.id}</td>
                          <td>${x.deadline}</td>
                          <td>${x.cat}</td>
                          <td>${x.pref}</td>
                          <td>${x.task}</td>
                          <td>${x.comment}</td>
                  <td>
                    <img src="../api/${x.image}" height="50px" onerror='this.style.display = "none"'>
                  </td>
                  <td>${x.name}</td>
                  <td>${x.created_at}</td>
                  <td>${x.updated_at}</td>
                </tr>`;
      }).join('');
    }

    // readの処理をする関数を定義
    const readData = url => {
      axios.get(url)
        .then(response => {
          // 成功した時
          console.log(response);
          // テーブルタグの中身を生成して表示
          document.getElementById('echo').innerHTML = convertArraytoListTag(response.data);


          document.querySelectorAll('.editButton').forEach(x => {
            x.addEventListener('click', e => {
              const id = e.target.value;
              const requestUrl = `../api/edit.php?id=${id}`;
              axios.get(requestUrl)
                .then(response => {
                  console.log(response.data);
                  // updateフォームに値を設定
                  document.getElementById('deadlineEdit').value = response.data.deadline;
                  document.getElementById('catEdit').value = response.data.select;
                  document.getElementById('prefEdit').value = response.data.pref;
                  document.getElementById('taskEdit').value = response.data.task;
                  document.getElementById('commentEdit').value = response.data.comment;
                  document.getElementById('nameEdit').value = response.data.name;
                  document.getElementById('hiddenId').value = response.data.id;
                })
                .catch(error => {
                  // 失敗した時

                  console.log(error);
                  alert(error);
                })
                .finally(() => {
                  // 成功失敗どちらでも実行

                });;
              // モーダルの表示
              document.getElementById('modal').style.display = 'block';
            });
          });
          // 削除ボタンクリック時の処理
          // phpにデータを送信してdbのデータを削除してもらう
          document.querySelectorAll('.deleteButton').forEach(x => {
            x.addEventListener('click', e => {
              if (window.confirm('Are you sure?')) {
                const id = e.target.value;
                const requestUrl = `../api/delete.php?id=${id}`;
                axios.delete(requestUrl)
                  .then(response => {

                    console.log(response.data);
                    alert('deleted!');
                    // 最新のデータを取得
                    readData(readUrl);
                  })
                  .catch(error => {
                    // 失敗した時

                    console.log(error);
                    alert(error);
                  })
                  .finally(() => {

                  });;
              }
            });
          });
          return response;
        })
        .catch(error => {

          console.log(error);
          alert(error);
        })
        .finally(() => {});
    }


    document.getElementById('send').addEventListener('click', () => {
      // createの処理

      const postData = new FormData();
      // postDataに必要なパラメータを追加する
      postData.append('deadline', document.getElementById('deadline').value);
      postData.append('cat', document.getElementById('cat').value);
      postData.append('pref', document.getElementById('pref').value);
      postData.append('task', document.getElementById('task').value);
      postData.append('comment', document.getElementById('comment').value);
      postData.append('upfile', document.getElementById('image').files[0]);
      postData.append('name', document.getElementById('name').value);
      console.log(...postData.entries());

      const fileUpLoadUrl = '../api/upload.php'

      axios.post(fileUpLoadUrl, postData)
        .then(response => {
          alert("3");
          console.log(response);
          readData(readUrl);

          document.getElementById('deadline').value = '';
          document.getElementById('cat').value = '';
          document.getElementById('pref').value = '';
          document.getElementById('task').value = '';
          document.getElementById('comment').value = '';
          document.getElementById('name').value = '';
        })
        .catch(error => {
          alert("4");
          console.log(error);
          alert(error);
        })
        .finally(() => {
          alert("5");
        });
    });

    // phpにデータを送信してdbのデータを更新してもらう
    document.getElementById('updateButton').addEventListener('click', e => {
      // 更新したいレコードのidを取得
      const updateId = document.getElementById('hiddenId').value;

      const updateData = new FormData();

      updateData.append('deadline', document.getElementById('deadlineEdit').value);
      updateData.append('cat', document.getElementById('catEdit').value);
      updateData.append('pref', document.getElementById('prefEdit').value);
      updateData.append('task', document.getElementById('taskEdit').value);
      updateData.append('comment', document.getElementById('commentEdit').value);
      updateData.append('name', document.getElementById('nameEdit').value);
      // PUTメソッドの設定
      const config = {
        headers: {
          'X-HTTP-Method-Override': 'PUT',
        }
      }

      const requestUrl = `../api/update.php?id=${updateId}`;

      axios.post(requestUrl, updateData, config)
        .then(response => {
          alert("6");
          alert('updated!');
          // モーダルを閉じる
          document.getElementById('modal').style.display = 'none';
          // 最新のデータを取得
          readData(readUrl);
        })
        .catch(error => {
          alert("7");
          console.log(error);
          alert(error);
        })
        .finally(() => {
          alert("8");
        });
    });

    // 検索ボックスに入力時の処理
    document.getElementById('search').addEventListener('keyup', e => {
      // inputの値を取得
      const searchWord = e.target.value;

      const requestUrl = `../api/search.php?searchWord=${searchWord}`;
      readData(requestUrl);
    });


    document.querySelectorAll('th').forEach(x => {
      x.addEventListener('click', e => {
        // thタグのテキストを取得
        const columnName = e.target.innerText;

        const requestUrl = `../api/sort.php?columnName=${columnName}`;
        readData(requestUrl);
      });
    });

    window.onload = () => {
      readData(readUrl);
    };

    document.getElementById('getSession').addEventListener('click', () => {
      axios.get('../api/get_sessioon.php')
        .then(response => {
          alert("9");
          console.log(response);
        })
    });
  </script>
</body>

</html>