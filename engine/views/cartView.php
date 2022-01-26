<h1>Корзина</h1>
<?php

if(isset($data["error"])){
    echo "<p>Ошибка ".$data['error']."</p>";
} else {
    echo "<div class='cart__box'>";
    foreach ($data["cart"] as $item):?>
        <div class="cart__item" id="cart<?=$item["cartId"]?>">
            <a href="/catalog/index/?id=<?=$item["id"]?>" class="cart__item_img">
                <img src="static/images/<?=$item["image"]?>" alt="<?=$item["image"]?>">
            </a>
            <form class="cart__item_desc" name="<?=$item["cartId"]?>">
                <div class="cart__item_line cart__item_caption"><?=$item["name"]?></div>
                <div class="cart__item_line"><span>Цвет</span>
                    <input name="color" value="<?=$item["color"]?>" /></div>
                <div class="cart__item_line"><span>Размер</span>
                    <input name="size" value="<?=$item["size"]?>" /></div>
                <div class="cart__item_line"><span>Цена</span><span><?=$item["price"]?></span></div>
                <div class="cart__item_line"><span>Количество</span>
                    <input type="number" name="quantity" value="<?=$item["quantity"]?>" /></div>
                <div class="cart__item_line"><span>Итого</span><span><?=$item["total"]?></span></div>
                <div class="cart__item_line">
                    <input class="cart__item_button" name="update" type="submit" value="Изменить" />
                    <a cartId="<?=$item["cartId"]?>" onclick="deleteCart(this)" class="cart__item_button">Удалить</a>

                </div>

            </form>

        </div>
<?php endforeach;
echo "</div>";
}?>
<div class="cart__button">
    <a href="/cart/buy">Заказ</a>
</div>

<script>
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



</script>
