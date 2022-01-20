
<?php
class ModelCatalog extends Model{
    function getData():array{
        return [
            "1"=>[
                "id"=>1,
                "name"=>"Стол",
                "description"=>"Lorem ipsum dolor sit amet, consectetur adipisicing."
            ],
            "2"=>[
                "id"=>2,
                "name"=>"Стул",
                "description"=>"Lorem ipsum dolor sit amet, consectetur adipisicing."
            ],
            "3"=>[
                "id"=>3,
                "name"=>"Шкаф",
                "description"=>"Lorem ipsum dolor sit amet, consectetur adipisicing."
            ],
            "4"=>[
                "id"=>4,
                "name"=>"Диван",
                "description"=>"Lorem ipsum dolor sit amet, consectetur adipisicing."
            ],
        ];
    }
}