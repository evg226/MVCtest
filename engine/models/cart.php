<?php

class ModelCart extends Model
{
    function getCart():array
    {
        $userId = $_SESSION["user"]["id"];
        $query = "SELECT *,cart.id as cartId, cart.quantity*products.price as total
                    FROM cart INNER JOIN products ON cart.productId=products.id
                WHERE userId=:userId";
        try {
            $stmt = self::$db->prepare($query);
            if ($stmt->execute([":userId" => $userId])) return $stmt->fetchAll();
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    function add($values): array
    {
        $cart=self::$db->select("cart", ["userId"=>$values["userId"],"productId"=>$values["productId"]]);
        if (isset($cart[0]["id"])){
            return ["error"=>"Товар уже в корзине"]; //или update +1
        } else {
            return self::$db->insert("cart", $values);
        }
    }
    function delete($id){
        return self::$db->delete("cart",$id);
    }

    function update($cartItem){
        return self::$db->update("cart",$cartItem);
    }
}
