<?php
class ModelCategory extends Model
{
    function getData(): array
    {
        return self::$db->select("categories",[], 0,100 );
    }
}
