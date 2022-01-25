<?php

class ModelCart extends Model
{
    function add($values): array
    {
        $cart=self::$db->select("cart", ["userId"=>$values["userId"],"productId"=>$values["productId"]]);
        if (isset($cart[0]["id"])){
            return ["error"=>"Товар уже в корзине"]; //или update +1
        } else {
            return self::$db->insert("cart", $values);
        }
    }
}
