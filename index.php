<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書記録</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Noto+Serif+JP:wght@600;700&display=swap" rel="stylesheet">

</head>

<body>
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-clipboard-list"></i>
                アンケートシステム
            </a>
            <a href="select.php" class="nav-link">
                <i class="fas fa-list"></i>
                データ一覧
            </a>
        </div>
    </header>

    <h1 class="title">読書記録</h1>
    <p class="discription">自由に本の内容を記録していってください</p>

    <form method="post" action="insert.php">
        <div class="form_group">
            <label for="title" class="title">
                本のタイトル
            </label>
            <input type="text" id="title" name="title" class="form-input" placeholder="走れメロス" required>
        </div>

        <div class="form_group">
            <label for="url" class="url">
                本のurl
            </label>
            <input type="text" id="url" name="url" class="form-input" placeholder="www.example.com" required>
        </div>

        <div class="form_group">
            <label for="comments" class="comments">
                本の感想
            </label>
            <input type="text" id="comments" name="comments" class="form-input" placeholder="最高に面白かった" required>
        </div>

        <button type="submit" class="submit_button">
            送信する
        </button>
    </form>
</body>

</html>