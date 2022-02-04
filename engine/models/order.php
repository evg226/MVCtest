<?php

class ModelOrder extends Model
{
    function getOrders():array{
        $userId = $_SESSION["user"]["id"];
        $query = "SELECT *,orders.id as orderId, orders.quantity*orders.price as total
                    FROM orders INNER JOIN products ON orders.product_id=products.id";
        return self::$db->selectQuery($query,['user_id'=>$userId]);

    }

    function buy($userId,$address){
        $query = "SELECT *,cart.id as cartId, cart.quantity*products.price as total
                    FROM cart INNER JOIN products ON cart.productId=products.id
                WHERE userId=:userId";
        try {
            self::$db->beginTransaction();
            $queryOrder="
                INSERT INTO orders (start_date,product_id,user_id,price,address,status,quantity,color,size)
                    SELECT NOW(),productId,userId,price,:address,'created',quantity,color,size
                        FROM cart INNER JOIN products ON cart.productId=products.id
                WHERE userId=:userId";
            $queryCart="DELETE FROM cart WHERE userId=:userId";
            $stmtOrder = self::$db->prepare($queryOrder);
            $stmtCart = self::$db->prepare($queryCart);
            if (
                $stmtOrder->execute([
                    ":userId" => $userId,
                    ":address" => $address
                ])
                &&
                $stmtCart->execute([
                    ":userId" => $userId,
                ])
            ) {
                self::$db->commit();
                return ["result"=>"Успешно"];
            }
        } catch (PDOException $e) {
            self::$db->rollback();
            return ["error" => $e->getMessage()];
        }
    }
    function update($id,$status="cancelled"){
        return self::$db->update("orders",["id"=>$id,"status"=>$status]);
    }
}
