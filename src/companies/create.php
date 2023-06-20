<?php

require __DIR__ . '/lib/mysqli.php';

function createCompany($link, $company)
{
  $sql = <<<EOT
INSERT INTO companies (
  name,
  establishment_date,
  founder
  ) VALUES (
    "{$company['name']}",
    "{$company['establishment_date']}",
    "{$company['founder']}"
    )
EOT;
  $result = mysqli_query($link, $sql);
  var_dump($result);
  if (!$result) {
    error_log('Error: fail to create company');
    error_log('Debugging Error:' . mysqli_error($link));
  } else {
    echo 'Error: データの追加に失敗しました' . PHP_EOL;
    echo 'debugging Error:' . mysqli_error($link) . PHP_EOL;
  }
}
//HTTPメソッドがPOSTだったら

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //POST された会社情報を変数に格納する
  $company = [
    'name' => $_POST['name'],
    'establishment_date' => $_POST['establishment_date'],
    'founder' => $_POST['founder']
  ];
  //バリデーションする
  //データベースに接続する
  $link = dbConnect();
  // //データベースにデータを登録する
  createCompany($link, $company);
  // //データベースとの接続を切断する
  mysqli_close($link);
}

header("Location: index.php");
