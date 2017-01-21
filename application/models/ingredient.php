<?php

class Ingredient extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getIngredients() {
        return $this->getArrayObjects("SELECT ing_id,ing_name FROM ingredient");
    }

    public function getIngredientsByAjax($information) {
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
        $query = "SELECT ing_id,ing_name FROM ingredient ORDER BY ing_id $orden LIMIT $offset,$limit";
        $recipes = $this->getArrayQuery($query);
        $data["total"] = $this->getSingleValue("SELECT count(*) FROM ingredient ORDER BY ing_id DESC");
        $data["rows"] = $recipes;
        return $data;
    }

    public function getIngredientById($ing_id) {
        return $this->getRowObject("SELECT ing_id,ing_name FROM ingredient WHERE ing_id=$ing_id");
    }

    public function saveData($information) {
        $ingredient["ing_name"] = $information["ing_name"];
        if ($information["ing_id"]) {
            $this->updateRow("ingredient", $ingredient, array("ing_id" => $information["ing_id"]));
        } else {
            $this->insertRow($ingredient, "ingredient");
        }
    }

    function delete($ing_id) {
        $this->runQuery("DELETE FROM recipe_ingredients WHERE rin_ing_id=" . $ing_id);
        $this->runQuery("DELETE FROM ingredient WHERE ing_id=" . $ing_id);
    }

}
