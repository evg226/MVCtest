<h3>Активные заказы</h3>
    <div class="admin__order-box">
        <div class="admin__order-item">user</div>
        <div class="admin__order-item">stat</div>
    <div class="admin__order-item">start_date</div>
    <div class="admin__order-item">name</div>
    <div class="admin__order-item">price</div>
    <div class="admin__order-item">quantity</div>
    <div class="admin__order-item">address</div>
    <div class="admin__order-item">color</div>
    <div class="admin__order-item">size</div>
    <div class="admin__order-item">send</div>
    <?php foreach($data as $item): ?>
<!--        <div class=admin__order-item>--><?//=$item['user_id']?><!--</div>-->
        <div class="admin__order-item"><?=$item['user']?></div>
        <div id="status<?=$item['id']?>" class="admin__order-item"><?=$item['status']?></div>
        <div class="admin__order-item"><?=substr($item['start_date'],0,10) ?></div>
<!--        <div class=admin__order-item>--><?//=$item['product_id']?><!--</div>-->
        <div class="admin__order-item"><?=$item['name']?></div>
<!--        <div class=admin__order-item>--><?//=$item['id']?><!--</div>-->
        <div class="admin__order-item"><?=$item['price']?></div>
        <div class="admin__order-item"><?=$item['quantity']?></div>
        <div class="admin__order-item"><?=$item['address']?></div>
<!--        <div class="admin__order-item">--><?//=$item['status']?><!--</div>-->
        <div class="admin__order-item"><?=$item['color']?></div>
        <div class="admin__order-item"><?=$item['size']?></div>
        <div id='<?=$item['user_id']?>' class="admin__order-item admin__order-item_send"
        onclick="sendOrder(<?=$item['id']?>);">>></div>
    <?php endforeach; ?>
</div>

<script>
    async function sendOrder(id){
        try {
            const response = await fetch("/api/order/update", {
                method: "post",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({id})
            });
            const result = await response.json();
            if(!!result.status)
                document.getElementById("status"+id).innerHTML=result.status;
        }catch (error) {
            console.log(error.message);
        }
    }
</script>
