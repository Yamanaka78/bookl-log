<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet/css/app.css">
    <title>読書ログ登録</title>
</head>

<body>
    <header class="navbar shadow-sm p-3 mb-5 bg-white">
        <h1 class="h2">
            <a class="text-body text-decoration-none" href="index.php">読書ログ</a>
        </h1>
    </header>
    <div class="container">
        <h2 class="h3 text-dark mb-4">読書ログの登録</h2>
        <form action="create.php" method="post">
            <?php if (count($errors)) : ?>
                <ul class="text-danger">
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="form-group">
                <label for="title">書籍名</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $review['title'] ?>">
            </div>
            <div class="form-group">
                <label for="author">著者名</label>
                <input type="text" name="author" id="author" class="form-control" value="<?php echo $review['author'] ?>">
            </div>
            <div>
                <label>読書状況</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="status" id="status1" class="form-check-input" value="未読" <?php echo ($review['status'] === '未読') ? 'checked' : ''; ?>>
                        <label for="status1" class="form-check-label">未読</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="status" id="status2" class="form-check-input" value="読んでる" <?php echo ($review['status'] === '読んでる') ? 'checked' : ''; ?>>
                        <label for="status2" class="form-check-label">読んでる</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status3" class="form-check-input" value="読了" <?php echo ($review['status'] === '読了') ? 'checked' : ''; ?>>
                        <label for="status3" class="form-check-label">読了</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="score">評価（5点満点の整数）</label>
                <input type="number" name="score" id="score" class="form-control" value="<?php echo $review['score'] ?>">
            </div>
            <div class="form-group">
                <label for="summary">感想</label>
                <textarea type="text" name="summary" id="summary" rows="10" class="form-control"><?php echo $review['summary'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">登録する</button>
        </form>
    </div>


</body>

</html>
