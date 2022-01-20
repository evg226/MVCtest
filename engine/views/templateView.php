<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Главная</title>
    <link rel="stylesheet" href="../../static/css/style.css">
</head>
<body>
<div class="page" >
    <nav class="page__nav">
        <div class="container">
            <ul class="nav">
                <li class="nav__item"><a href="/" class="nav__brand"><h3>MVC Engine</h3></a></li>
                <li class="nav__item"><a href="/" class="nav__link">Home</a></li>
                <li class="nav__item"><a href="/catalog" class="nav__link">Каталог</a></li>
                <li class="nav__item"><a href="/user" class="nav__link">Личный кабинет</a></li>
                <li class="nav__item"><a href="about" class="nav__link">О нас</a></li>
            </ul>
        </div>
    </nav>
    <main class="page__main">
        <div class="container">
            <?php include 'engine/views/'.$contentView; ?>
        </div>
    </main>

    <footer class="page__footer">
        <div class="container">
            <p class="footer__text">Футер сopyright &copy; evg226 <?=date("d M Y")?></p>
        </div>
    </footer>
</div>
</body>
</html>
