<?php
class ModelAdmin extends Model
{
    function getOrders($status='created'): array
    {
        $query = "SELECT
                        CONCAT_WS(' ',users.login,users.name,users.surname) as user,
                        products.name,
                        orders.*,
                        orders.quantity*orders.price as total
                    FROM orders
                        INNER JOIN products ON orders.product_id=products.id
                        INNER JOIN users ON users.id=orders.user_id";
        return self::$db->selectQuery($query,["status"=>$status]);
    }

    function getProducts(): array
    {
        $query = "SELECT 
                        products.id as productId,
                        products.name as productName,
                        products.price as price,
                        products.description as productDesc,
                        products.image,
                        categories.id as categoryId,
                        categories.name as categoryName
                    FROM products
                        INNER JOIN categories ON categories.id=products.category_id
                ";
        return self::$db->selectQuery($query);
    }
}