<?php
if(isset($data["error"])) echo $data["error"];
else echo "Добавлено ". $data["id"];
?>
<script>
        setTimeout(()=>window.history.back(),3000);
</script>

