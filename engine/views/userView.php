<h1>Личный кабинет</h1>
<div class="user__page">
<div class="user__info">
<!--    <div class="user__string">-->
    <h3 class="user__char">Инфо</h3>
<!--    </div>-->
    <div class="user__string">
        <div class="user__char">Логин</div>
        <div class="user_value"><?=$data["user"]['login']?></div>
    </div>
    <div class="user__string">
    <div class="user__char">Имя</div>
    <div class="user_value"><?=$data["user"]['name']?></div>
    </div>
    <div class="user__string">
    <div class="user__char">Фамилия</div>
    <div class="user_value"><?=$data["user"]['surname']?></div>
    </div>
    <div class="user__string">
    <div class="user__char">Привиллегии</div>
    <div class="user_value"><?=$data["user"]['role']?></div>
    </div>

</div>
<div class="user__info">
    <h3 class="user__char">Страницы</h3>
    <?php
        if(isset($data["pages"]))
            foreach ($data["pages"] as $page)
                echo "<a href='".$page["path"]."'>".
                    "<div class='user__string'>".
                    "<span>".$page["path"].
                    "</span><span class='user__span'>".$page["pageCount"].
                    "</span></div></a>";
    ?>
</div>

</div>
<div class="user__button">
    <a id="buttonViewOrders" onclick="loadOrders();" class="user__logout">Посмотреть заказы</a>
    <a href="/user/logout" class="user__logout">Выйти из кабинета</a>
</div>
<div id="orderBox">

        <div class="order__name">Дата</div>
        <div class="order__name">Статус</div>
        <div class="order__name">Наим</div>
        <div class="order__name">Разм</div>
        <div class="order__name">Цвет</div>
        <div class="order__name">Цена</div>
        <div class="order__name">Кол-во</div>
        <div class="order__name">Стоим</div>
        <div class="order__name"></div>

</div>
<script>
    const orderBox=document.getElementById("orderBox");
    async function loadOrders(){

        try {
            const response = await fetch("/api/order");
            const orders=await response.json();
            if (!orders.length) orderBox.insertAdjacentHTML("beforebegin","<h3>Заказов пока нет</h3>" +
                "<a href='/catalog'>Перейти к товарам >></a><a href='/cart'>Перейти к корзину >></a><br>");
                orders.forEach(item=>
                    orderBox.insertAdjacentHTML("beforeend",`
                    <div class="order__name">${item.start_date.substring(0,10)}</div>
                    <div class="order__name" id="status${item.orderId}">${item.status}</div>
                    <div class="order__name">${item.name}</div>
                    <div class="order__name">${item.size}</div>
                    <div class="order__name">${item.color}</div>
                    <div class="order__name">${item.price}</div>
                    <div class="order__name">${item.quantity}</div>
                    <div class="order__name">${item.total}</div>
                    <div class="order__name order__name_button" onclick="deleteOrder(${item.orderId})">X</div>
            `));
            document.getElementById("buttonViewOrders").style="display:none";
        } catch (error){
            orderBox.insertAdjacentHTML("beforeend",error.message);
        }
    }
    async function deleteOrder(id){
        try {
            const response = await fetch("/api/order/cancel", {
                method: "post",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({id})
            });
            const result = await response.json();
            document.getElementById("status"+id).innerHTML=result.status;
        }catch (error) {
            orderBox.insertAdjacentHTML("beforebegin",error.message);
        }
    }
</script>






