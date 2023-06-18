<?php

function createMemo()
{
    echo "メモを登録してください。" . PHP_EOL;
    echo "題名：";
    $title = trim(fgets(STDIN));
    echo "日付を入力してください" . PHP_EOL;
    echo "日付：";
    $tody = trim(fgets(STDIN));
    echo "メモ入力" . PHP_EOL;;
    echo "メモ：";
    $memo = trim(fgets(STDIN));
    return  [
        'title' => $title,
        'tody' => $tody,
        'memo' => $memo
    ];
}

function memosList($memos){
    foreach ($memos as $memo) {
        echo '題名：' . $memo['title'] . PHP_EOL;
        echo '日付：' . $memo['tody'] . PHP_EOL;
        echo 'メモ：' . $memo['memo'] . PHP_EOL;
        echo "------------" . PHP_EOL;
    }
}
$memos = [];

while (true) {
    echo '1. メモを登録' . PHP_EOL;
    echo '2. メモ一覧を表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）：';
    $num = trim(fgets(STDIN));
    if ($num === '1') {
        $memos[] = createMemo();

    } else if ($num === '2') {
        memosList($memos);
    } else if ($num === '9') {
        break;
    }
}
