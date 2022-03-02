<h1>Страница администратора</h1>
<?php if (isset($data['error'])) : ?>
<h4><?=$data['error']?></h4>
<?php else : ?>
    <h3>Редактор</h3>
    <div class="admin__button-box">
        <a href="/admin" class="admin__button-item">Заказы</a>
        <a href="/admin/index/?entity=product" class="admin__button-item">Товары</a>
        <a href="/admin/index/?entity=collection" class="admin__button-item">Коллекции</a>
        <a href="/admin/index/?entity=category" class="admin__button-item">Категории</a>
    </div>
<?php
    if(!isset($_GET['entity']))
        require "adminOrderView.php";
    else if ($_GET['entity']==="product")
        require "adminProductView.php";
    else if ($_GET['entity']==="collection")
        echo "Здесь будет модификация справочника".$_GET['entity'];
    else if ($_GET['entity']==="category")
        echo "Здесь будет модификация справочника".$_GET['entity'];
    ?>

<?php endif; ?>


