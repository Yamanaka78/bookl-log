<?php

$title = '';
$author = '';
$status = '';
$score = '';
$summary = '';

/**
 * ここを追記
 *
 * 読書ログを格納するための配列をループのその側で用意する
 * ループの中で変数を宣言すると、ループが回るたびに初期化されてしまう
 * 読書ログというのは要はレビューなので、$reviews と命名
 */
$reviews = [];

while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）：';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        echo '読書ログを登録してください' . PHP_EOL;
        echo '書籍名：';
        $title = trim(fgets(STDIN));

        echo '著者名：';
        $author = trim(fgets(STDIN));

        echo '読書状況（未読,読んでる,読了）：';
        $status = trim(fgets(STDIN));

        echo '評価（5点満点の整数）：';
        $score = trim(fgets(STDIN));

        echo '感想：';
        $summary = trim(fgets(STDIN));

        /**
         * ここを追記
         *
         * $reviews に読書ログ単体の連想配列を追加する
         * 配列にしてもよいが、連想配列のほうがラベルが付いているので要素にアクセスするときによりわかりやすい
         */
        $reviews[] = [
            'title' => $title,
            'author' => $author,
            'status' => $status,
            'score' => $score,
            'summary' => $summary,
        ];

        echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    } elseif ($num === '2') {
        foreach ($reviews as $review) {
            echo '書籍名：' . $review['title'] . PHP_EOL;
            echo '著者名：' . $review['author'] . PHP_EOL;
            echo '読書状況：' . $review['status'] . PHP_EOL;
            echo '評価：' . $review['score'] . PHP_EOL;
            echo '感想：' . $review['summary'] . PHP_EOL;
            echo '-------------' . PHP_EOL;
        }
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
