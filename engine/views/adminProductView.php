<?//=print_r($data)?>
<h3>Каталог товаров</h3>
    <div class="admin__order-box admin__products-box">
        <div class="admin__product-item admin__order-item_send" onclick="handleItem();">+</div>
        <div class="admin__product-item">productName</div>
    <div class="admin__product-item">productDesc</div>
    <div class="admin__product-item">images</div>
    <div class="admin__product-item">price</div>
    <div class="admin__product-item">categoryName</div>

    </div>
        <?php foreach($data as $item): ?>
        <div id="product<?= $item['productId'] ?>" class="admin__products-box" onclick="handleItem({
                id:`<?= $item['productId'] ?>`,
                productName:`<?=$item['productName']?>`,
                productDesc:`<?=$item['productDesc']?>`,
                image:`<?=$item['image']?>`,
                price:`<?=$item['price']?>`,
                categoryId:`<?=$item['categoryId']?>`,
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

<div id="close" class="modal__back"
     onclick="if(event.target.id==='close'||event.target.id==='close2') this.style='display.none'">
    <form class="modal" name="modal" method="post" >
        <h3>Продукт</h3>
        <input hidden name="id" value="" />
        <input name="name" value="" placeholder="Название" />
        <textarea rows="3" name="description" placeholder="Описание"></textarea>
        <input type="number" name="price" value="" placeholder="Цена" />
        <span>Категория</span>
        <select name="category_id" value="0" onfocus="fetchCategories()">
            <option value="0">Выберите категорию</option>0
        </select>
        <div>
            <input id="close1" type="submit" value="ОК" />
            <input id="close2" type="reset" value="Отмена" />
        </div>
    </form>
</div>



<script>

    async function fetchCategories(){
        const select=document.getElementsByName("category_id")[0];
        if (select.children.length>1) return ;
        select.innerHTML=``;
        const result= await query("/category");
        !!result&&result.forEach(item=>
            select.insertAdjacentHTML("beforeend",`<option value="${item.id}">${item.name}</option>`)
        )
    }
    async function handleItem(item){
        const modal=document.getElementsByClassName("modal__back")[0];
        const select = document.getElementsByName("category_id")[0];
        if(item){
            if (select.children.length===1) {
                select.innerHTML = `<option value="${item.categoryId}">${item.categoryName}</option>`;
            }
            document.forms["modal"]["id"].value=item.id;
            document.forms["modal"]["name"].value=item.productName;
            document.forms["modal"]["description"].value=item.productDesc;
            document.forms["modal"]["price"].value=item.price;
            document.forms["modal"]["category_id"].value=item.categoryId;
            document.forms["modal"].action="/catalog/update";
        } else{
            select.value=0;
            document.forms["modal"].action="/catalog/create"
        }
        modal.style="display:flex";

    }
    async function handleItemDelete(event,id){
        event.stopPropagation();
        const formData=new FormData();
        formData.set("id",id);
        const result= await query("/catalog/delete",formData);
        if(!!result.id)
            document.getElementById("product"+result.id).remove();
         else if (result.error)
             console.log(result.error);
    }

    async function handleImageActions(event,image,id){
        console.log(image);
        console.log(id);
        event.stopPropagation();
    }

    async function query(action,formData){
        try {
            const response = await fetch("/api"+action, {
                method: "post",
                body: formData
                });
            return  await response.json();
        }catch (error) {
            return {error:error.message} ;
        }
    }

</script>