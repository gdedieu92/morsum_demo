<?php

class Recipe extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getRecipesByAjax($information) {
        if (isset($information["limit"])) {
            $limit = $information["limit"];
        } else {
            $limit = 20;
        }
        $offset = 0;
        if (isset($information["offset"])) {
            $offset = $information["offset"];
        }
        $orden = "ASC";
        switch ($information["order"]) {
            case "asc" :
                $orden = "ASC";
                break;
            case "desc" :
                $orden = "DESC";
                break;
        }
        $query = "SELECT rec_id,rec_name,rec_description,'0' rec_quantity_ingredients FROM recipe ORDER BY rec_id $orden LIMIT $offset,$limit";
        $recipes = $this->getArrayQuery($query);
        $data["total"] = $this->getSingleValue("SELECT count(*) FROM recipe ORDER BY rec_id DESC");
        $data["rows"] = $recipes;
        return $data;
    }

    public function getRecipeById($rec_id) {
        $recipe=$this->getRowObject("SELECT rec_id,rec_name,rec_description,rec_photo,rec_active FROM recipe WHERE rec_id=$rec_id");
        $recipe->ingredients=$this->getArrayObjects("SELECT rin_ing_id,rin_quantity,rin_ume_id FROM recipe INNER JOIN recipe_ingredients ON rin_rec_id=rec_id WHERE rec_id=$rec_id");
        return $recipe;
    }

    public function saveData($information) {
        $recipe["rec_name"] = $information["rec_name"];
        $recipe["rec_description"] = $information["rec_description"];
        $recipe["rec_active"] = isset($information["rec_active"]) ? 1 : 0;
        if (isset($_FILES['rec_photo']) && $_FILES['rec_photo']['name']) {
            $recipe["rec_photo"] = savePhoto($_FILES['rec_photo'], IMAGES_RECIPES, uniqid("img_"), true, 270, 270, false);
        }
        if ($information["rec_id"]) {
            $this->updateRow("recipe", $recipe, array("rec_id" => $information["rec_id"]));
            $rec_id = $information["rec_id"];
        } else {
            $this->insertRow($recipe, "recipe");
            $rec_id = $this->lastInsertId();
        }
        
        if ($information["ingredients"]) {
            $ingredients = array();
            foreach ($information["ingredients"] as $k => $ingredient) {
                if (isset($ingredient["rin_ume_id"]) && isset($ingredient["rin_ing_id"]) && isset($ingredient["rin_quantity"])) {
                    $ingredients[$k]["rin_rec_id"] = $rec_id;
                    $ingredients[$k]["rin_ume_id"] = $ingredient["rin_ume_id"];
                    $ingredients[$k]["rin_ing_id"] = $ingredient["rin_ing_id"];
                    $ingredients[$k]["rin_quantity"] = $ingredient["rin_quantity"];
                }
            }
            if (count($ingredients) > 0) {
                $this->insertArray("recipe_ingredients", $ingredients);
            }
        }
    }
    
    function delete($rec_id){
        $this->runQuery("DELETE FROM recipe_ingredients WHERE rin_rec_id=".$rec_id);
        $this->runQuery("DELETE FROM recipe WHERE rec_id=".$rec_id);
    }

}
