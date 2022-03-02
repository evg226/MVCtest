<h1><?=$data["name"]?> </h1>
<form action="/cart/add" method="post">
    <div class="product__item">
    <div class="produc__item_side">
        <div>Наименование: <?=$data["name"]?></div>
        <div>Описание: <?=$data["description"]?></div>
        <div>Цена: <?=$data["price"]?></div>
    </div>
    <div class="produc__item_side">
        <div><input hidden name="productId" value="<?=$data["id"]?>"></div>
        <div>quantity<input name="quantity" value="1"></div>
        <div>color<input type="text" name="color" placeholder="color"></div>
        <div>size<input type="text" name="size" placeholder="size"></div>
    </div>
    </div>
    <div class="product__button"><input type="submit" name="click" value="Add to cart"></div>

</form>
    <div class="product__gallery">
        <span id="galleryLeft"><div><<</div></span>
        <div id="gallery">
            <img id="galleryImg" src="/static/images/" productId=<?=$data["id"]?>
                 alt="Рисунок по умолчанию">
        </div>
        <span id="galleryRight"><div>>></div></span>
    </div>

<script>
    window.onload=function(){
        const galleryLeft=document.getElementById("galleryLeft");
        const galleryRight=document.getElementById("galleryRight");
        const galleryImg=document.getElementById("galleryImg");
        const productId=galleryImg.getAttribute("productId");
        let galleryArr=[];
        let currentImg=0;
        const handleImageChange=(move)=>{
            currentImg+=move;
            if (currentImg>=galleryArr.length) currentImg=0;
            if (currentImg<0) currentImg = galleryArr.length-1;
            galleryImg.src=`/static/images/${galleryArr[currentImg].path}`;
        };
        const url="/api/catalog/getImages/?productId="+productId;
        fetch(url)
            .then(response=>response.json())
            .then(result=> {
                galleryArr=[...result];
                galleryLeft.addEventListener("click",()=>handleImageChange(-1));
                galleryRight.addEventListener("click",()=>handleImageChange(1));
                handleImageChange(0);
            })
            .catch(error=>console.log(error.message));
    }
</script>