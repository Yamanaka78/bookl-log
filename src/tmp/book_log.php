<?php


function validate($review)
{
    $errors = [];

    //書籍名が正しく入力されているかチェック
    if (!strlen($review['title'])) {
        $errors['title'] = '書籍名を入力してください';
    }else if (strlen($review['title']) > 255){
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }

    //評価が正しく入力されているかチェック
    if ($review['score'] < 1 || $review['score'] > 5) {
        $errors['score'] = '評価は1~5の整数を入力してください';
    }
    return $errors;
}
function createReview($link)
{
    $review = [];

    echo '読書ログを登録してください' . PHP_EOL;
    echo '書籍名：';
    $review['title'] = trim(fgets(STDIN));

    echo '著者名：';
    $review['author'] = trim(fgets(STDIN));

    echo '読書状況（未読,読んでる,読了）：';
    $review['status'] = trim(fgets(STDIN));

    echo '評価（5点満点の整数）：';
    $review['score'] = (int) trim(fgets(STDIN));

    echo '感想：';
    $review['summary'] = trim(fgets(STDIN));

    $validated = validate($review);

    if (count($validated) > 0){
        foreach ($validated as $error) {
            echo $error .PHP_EOL;
        }
        return;
    }

    $sql = <<<EOT
INSERT INTO review (
    title,
    author,
    status,
    score,
    summary
) VALUES (
    "{$review['title']}",
    "{$review['author']}",
    "{$review['status']}",
    ${$review['score']},
    ${$review['$summary']}"
)
EOT;

    $result = mysqli_query($link, $sql);
    if ($result) {
        echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    } else {
        echo 'Error: データの追加に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL . PHP_EOL;
    }
}


function listReviews($link)
{
    echo '登録されている読書ログを表示します' . PHP_EOL;

    $sql = 'SELECT id, title, author, status, score, summary FROM reviews';
    $results = mysqli_query($link, $sql);

    while ($review = mysqli_fetch_assoc($results)) {
        echo '書籍名：' . $review['title'] . PHP_EOL;
        echo '著者名：' . $review['author'] . PHP_EOL;
        echo '読書状況：' . $review['status'] . PHP_EOL;
        echo '評価：' . $review['score'] . PHP_EOL;
        echo '感想：' . $review['summary'] . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }

    mysqli_free_result($results);
}

function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error: データベースに接続できません' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    /**
     * $link は mysqli_connect() の戻り値である、データベースとの接続情報
     * データベースと切断したり、テーブルからデータを取得・登録する際に接続情報を使用するので、return で返す
     */
    return $link;
}
$link = dbConnect();

while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）：';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        createReview($link);
    } elseif ($num === '2') {
        listReviews($link);
    } elseif ($num === '9') {
        break;
    }
}

/**
 * ここを追記
 *
 * TODO: 表示処理実装時に削除する
 *
 * 最後に、複数の読書ログの登録処理がうまくできているかを動作確認する
 * 番号9を選択してアプリケーションを終了すると、登録済みの読書ログが表示される
 * 処理を書く場所はここじゃなくてもいいが、削除するときに発見しやすいので末尾に記載した
 */
