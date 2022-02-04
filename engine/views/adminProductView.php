<?//=print_r($data)?>
<h3>Каталог товаров</h3>
    <div class="admin__order-box admin__products-box">
        <div class="admin__product-item admin__order-item_send" onclick="handleItemAdd();">+</div>
        <div class="admin__product-item">productName</div>
    <div class="admin__product-item">productDesc</div>
    <div class="admin__product-item">images</div>
    <div class="admin__product-item">price</div>
    <div class="admin__product-item">categoryName</div>

    </div>
        <?php foreach($data as $item): ?>
        <div id="product<?= $item['productId'] ?>" class="admin__products-box" onclick="handleItemUpdate({
                id:`<?= $item['productId'] ?>`,
                productName:`<?=$item['productName']?>`,
                productDesc:`<?=$item['productDesc']?>`,
                image:`<?=$item['image']?>`,
                price:`<?=$item['price']?>`,
                categoryName:`<?=$item['categoryName']?>`
                });">
        <div class="admin__product-item admin__order-item_send" onclick="handleItemDelete(event,`<?= $item['productId'] ?>`);">-</div>
        <div class="admin__product-item"><?=$item['productName']?></div>
        <div class="admin__product-item"><?=substr($item['productDesc'],0,10) ?></div>
<!--        <div class=admin__product-item>--><?//=$item['product_id']?><!--</div>-->
        <div class="admin__product-item admin__order-item_send"
             onclick="handleImageActions(event,`<?=$item['image']?>`,`<?= $item['productId']?>`);"
            onclick=""
        >...</div>
<!--        <div class=admin__product-item>--><?//=$item['id']?><!--</div>-->
        <div class="admin__product-item"><?=$item['price']?></div>
        <div class="admin__product-item"><?=$item['categoryName']?></div>
<!--        <div id='--><?//=$item['productId']?><!--' class="admin__order-item admin__order-item_send">>></div>-->
        </div>
    <?php endforeach; ?>
<script>
    async function handleItemAdd(){
        const item={};
        const result= await query("/create",item);
        console.log(result);
    }
    async function handleItemUpdate(item){
        const result= await query("/update",item);
        console.log(result);
    }
    async function handleItemDelete(event,id){
        event.stopPropagation();
        const formData=new FormData();
        formData.set("id",id);
        const result= await query("/delete",formData);
        if(!!result.id) document.getElementById("product"+result.id).remove();
    }

    async function handleImageActions(event,image,id){
        console.log(image);
        console.log(id);
        event.stopPropagation();
    }

    async function query(action,formData){

        try {
            const response = await fetch("/api/catalog"+action, {
                method: "post",
                body: formData
                });
            return  await response.json();
        }catch (error) {
            return {error:error.message} ;
        }
    }

</script>