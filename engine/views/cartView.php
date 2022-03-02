<h1>Корзина</h1>
<?php

if(!isset($data["error"])):?>

    <div class='cart__box'>
    <?php foreach ($data["cart"] as $item):?>
        <div class="cart__item" id="cart<?=$item["cartId"]?>">
            <a href="/catalog/index/?id=<?=$item["id"]?>" class="cart__item_img">
                <img src="static/images/<?=$item["image"]?>" alt="<?=$item["image"]?>">
            </a>
            <div class="cart__item_desc" cartId="<?=$item["cartId"]?>">
                <div class="cart__item_line cart__item_caption"><?=$item["name"]?></div>
                <div class="cart__item_line"><span>Цвет</span>
                    <input name="color<?=$item["cartId"]?>" value="<?=$item["color"]?>"
                           oninput="activeUpdate('<?=$item["cartId"]?>');"/></div>
                <div class="cart__item_line"><span>Размер</span>
                    <input name="size<?=$item["cartId"]?>" value="<?=$item["size"]?>"
                           oninput="activeUpdate('<?=$item["cartId"]?>');"/></div>
                <div class="cart__item_line"><span>Цена</span><span><?=$item["price"]?></span></div>
                <div class="cart__item_line"><span>Количество</span>
                    <input type="number" name="quantity<?=$item["cartId"]?>" value="<?=$item["quantity"]?>"
                           oninput="activeUpdate('<?=$item["cartId"]?>');"/></div>
                <div class="cart__item_line"><span>Итого</span><span><?=$item["total"]?></span></div>
                <div class="cart__item_line cart__item_line_buttons">
                    <a style="display: none" cartId="<?=$item["cartId"]?>"
                       id="update<?=$item["cartId"]?>"
                       onclick="updateCart(this);" class="cart__item_button">Сохранить</a>
                    <a cartId="<?=$item["cartId"]?>" onclick="deleteCart(this);" class="cart__item_button">Удалить</a>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    </div>
    <?php if (count($data['cart']) >0): ?>
        <div id="Order" class="cart__button"><a onclick="activeAddress()">Заказать</a></div>
        <form action="order/buy" method="post">
        <div id="cartAddress">Ваш адрес<input type="text" name="address" value=""/></input></div>
        <div id="Send" class="cart__button"><button type="submit">ОК</button></div>
        </form>
    <?php else: echo "Коризна пуста"; endif;

    else: echo "<p>Ошибка ".$data['error']."</p><a href='/user/login'>Авторизоваться >></a>";
endif;?>

<script>
    function activeAddress(){
        document.getElementById("Order").style="display: none";
        document.getElementById("cartAddress").style="display: flex";
        document.getElementById("Send").style="display: block";
    }
    function deleteCart(target){
        const cartId=target.getAttribute("cartId");
        const url="/api/cart/delete/";
        fetch(url, {
            method: "post",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({id:cartId})
        })
            .then(response=>response.json())
            .then(result=>{
                if(result.id==cartId){
                    document.getElementById("cart"+cartId).remove();
                }
            })
            .catch(error=>console.log(error.message));
    }
    function activeUpdate(id){
        document.getElementById("update"+id).style="display: inline-block";
        document.getElementById("Order").style="display: block";
        document.getElementById("cartAddress").style="display: none";
        document.getElementById("Send").style="display: none";
    }
    function updateCart(target){
        const cartId=target.getAttribute("cartId");
        const color=document.querySelector(`input[name='color${cartId}']`);
        const size=document.querySelector(`input[name='size${cartId}']`);
        const quantity=document.querySelector(`input[name='quantity${cartId}']`);
        if (quantity.value<=0) deleteCart(target);
        const url="/api/cart/update/";
        fetch(url, {
            method: "post",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({id:cartId,color:color.value,size:size.value,quantity:quantity.value})
        })
            .then(response=>response.json())
            .then(result=>{
                if(result.id==cartId){
                    target.style="display: none";
                }
            })
            .catch(error=>console.log(error.message));
    }

</script>
