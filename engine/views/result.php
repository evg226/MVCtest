
<h2><?php
if(isset($data["error"])) echo $data["error"];else echo $data["result"];
//    print_r($data);
?></h2>
<?php if (isset($data["redirectTo"])) : ?>
<a href="<?=$data["redirectTo"]?>" id="ref">Перейти на <?=$data["redirectTo"]?></a>
<?php endif;?>

<script>
    const ref=document.getElementById("ref").href;
            setTimeout(()=>window.location=ref,3000);
</script>

