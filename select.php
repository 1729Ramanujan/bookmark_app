<?php
require_once('function.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=database_bookmark;charset=utf8', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError' . $e->getMessage());
}

if ($search !== '') {
    $stmt = $pdo->prepare("SELECT * FROM gs_bm_table where title LIKE :search");
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
} else {
    $stmt = $pdo->prepare("SELECT*FROM gs_bm_table");
}
$status = $stmt->execute();

$view = "";
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        $view .= $result['date'] . "<br>" . "タイトル：「" . h($result['title']) . "」"."<br>" ."本のurl：" . h($result['url']) . "<br>" . "本に関するコメント：" . h($result['comments']);
    }
}
$view .= '</p>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Noto+Serif+JP:wght@600;700&display=swap" rel="stylesheet">

</head>

<body>
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">
                データ一覧
            </a>
            <a href="index.php" class="nav-link">
                データ登録
            </a>
        </div>
    </header>

    <main class="main-container">
        <div class="content-card">
            <h1 class="page-title">アンケートデータ一覧</h1>
            <p class="page-subtitle">投稿されたアンケートの回答一覧</p>

            <form action="select.php" method="get">
                <div class="form-group">
                    <label for="search" class="form-label">検索：</label>
                    <input type="text" id="search" name="search" class="form-input" placeholder="本文検索">
                    <button type="submit" class="form-button">検索</button>
                </div>
            </form>

            <div class="data-container">
                <?php if (empty($view)): ?>
                    <!-- もし $view データがない場合の表示 -->
                    <div class="empty-state">
                        <div class="empty-icon">
                        </div>
                        <p>まだデータがありません</p>
                        <p style="margin-top: 0.5rem; font-size: 0.9rem; color: #999;">
                            最初のアンケートを投稿してみましょう！
                        </p>
                    </div>
                <?php else: ?>
                    <!-- もし $view データが存在する場合 -->
                    <?= $view ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>

</html>