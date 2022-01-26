<h1>Страница каталога товаров</h1>
<div class="catalog__box">
<?php
    $lastId="";
    foreach ($data as $item):?>
        <a class="catalog__item" href="catalog/index/?id=<?=$item["id"]?>">
            <img src="static/images/<?=$item["image"]?>" alt="<?=$item["image"]?>">
            <div> <?=$item["name"]?></div>
            <div> <?=$item["description"]?></div>
            <div> <?=$item["price"]?></div>
            <?php $lastId=$item["id"]?>
        </a>
    <?php endforeach; ?>
</div>
<a id="see__more" lastId="<?=$lastId?>">Еще >></a>
<!--<p>--><?php //print_r($data) ?>
<!--</p>-->
<script>
    const moreButton=document.getElementById("see__more");
    const catalogBox=document.getElementsByClassName("catalog__box")[0];
    let lastId=moreButton.getAttribute("lastId");
    moreButton.addEventListener("click",async()=>{
        const url="/api/catalog/index/?startId="+lastId;
        fetch(url)
            .then(response=>response.json())
            .then(result=>{
                if(!result.length) moreButton.removeEventListener("click");
                for (let item of result){
                    const itemHtml=`<a class="catalog__item" href="catalog/index/?id=${item.id}">
                                    <img src="static/images/${item.image}" alt="${item.image}">
                                    <div> ${item.name}</div>
                                    <div> ${item.description}</div>
                                    <div> ${item.price}</div>
                                   </a>`;
                    lastId = item.id;
                    catalogBox.insertAdjacentHTML("beforeend",itemHtml);
                };
                moreButton.setAttribute("lastId",lastId);
            });
     });
</script>