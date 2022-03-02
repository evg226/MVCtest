
<?php
class ModelCatalog extends Model{
    function getData($startId,$limit):array{
        return self::$db->select("products",[],$startId,$limit);
    }

    function getById($id):array
    {
        $query = "SELECT products.id as id,
                         products.name as 'name',
                         price,
                         description,   
                         collection_id,   
                         category_id as categoryId,   
                         categories.name as 'categories.name',   
                        categories.collection_id FROM products
                    INNER JOIN categories
                        ON products.category_id=categories.id
                    WHERE products.id=:id";
        try {
            $stmt = self::$db->prepare($query);
            $stmt->execute([":id" => $id]);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            $result = ["error" => $e->getMessage()];
        }
        return $result;
    }
    function getImages($productId){
        return self::$db->select("images",["product_id"=>$productId],"0","100");
    }

    function create(array $product): array{
        return self::$db->insert("products", $product);
    }
    function update(array $product): array{
        return self::$db->update("products", $product);
    }
    function delete($id): array{
        return self::$db->delete("products", $id);
    }

}

