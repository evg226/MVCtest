<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Главная</title>
    <link rel="stylesheet" href="../../static/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<div class="page" >
    <nav class="page__nav">
        <div class="container">
            <div class="header">
            <div class="nav__item nav__item_first">
                <a href="/" class="nav__brand"><h3>MVC Engine</h3></a>
                <div id="hamb">
                    <div class="hamb__element"></div>
                    <div class="hamb__element"></div>
                    <div class="hamb__element"></div>
                </div>
            </div>
            <ul id="nav" class="nav">
                <li class="nav__item"><a href="/" class="nav__link">Home</a></li>
                <li class="nav__item"><a href="/catalog" class="nav__link">Каталог</a></li>
                <?php if (isset($_SESSION['user'])&&$_SESSION['user']["id"]):?>
                    <li class="nav__item"><a href="/cart" class="nav__link">Корзина</a></li>
                <?php endif;?>
                <li class="nav__item"><a href="/user" class="nav__link">Кабинет</a></li>
                <?php if (isset($_SESSION['user'])&&$_SESSION['user']["id"]&&$_SESSION['user']["role"]=="ADMIN") :?>
                    <li class="nav__item"><a href="/admin" class="nav__link">Админ</a></li>
                <?php endif;?>
                <li class="nav__item"><a href="about" class="nav__link">О нас</a></li>
            </ul>
            </div>
        </div>
    </nav>
    <main class="page__main">
        <div class="container">
            <?php include 'engine/views/'.$this->contentView; ?>
        </div>
    </main>

    <footer class="page__footer">
        <div class="container">
            <p class="footer__text">Футер сopyright &copy; evg226 <?=date("d M Y")?></p>
        </div>
    </footer>
</div>
<script>

        const hamb=document.getElementById("hamb");
        const nav=document.getElementById("nav");
        document.addEventListener("click",(e)=> {
            if (e.target.id == "hamb") {
                nav.classList.toggle("nav_visible");
            } else {
                nav.classList.remove("nav_visible");
            }
        });

</script>
</body>
</html>
