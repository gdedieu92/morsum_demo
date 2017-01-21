<?php

class Recipe_Controller extends A_Controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('ingredient');
        $this->loadModel('unitmeasurement');
        $this->loadModel('recipe');
    }

    public function our_recipes($get = false) {
        if ($this->post) {
            $this->recipe->saveData($this->post);
            redirect("recipe/our_recipes");
        } elseif (isset($get["rec_id"])) {
            $information['recipe'] = $this->recipe->getRecipeById($get["rec_id"]);
            $information['ingredients'] = $this->ingredient->getIngredients();
            $information['umes'] = $this->unitmeasurement->getUMES();
            $this->view->load('recipe/index', $information);
        } else {
            $information['ingredients'] = $this->ingredient->getIngredients();
            $information['umes'] = $this->unitmeasurement->getUMES();
            $this->view->load('recipe/index', $information);
        }
    }

    public function getRecipesAjax($args) {
        echo json_encode($this->recipe->getRecipesByAjax($args));
    }

    function delete_recipe($get = false) {
        $this->recipe->delete($get["rec_id"]);
        redirect("recipe/our_recipes");
    }

    public function getIngredientsAjax($args) {
        echo json_encode($this->ingredient->getIngredientsByAjax($args));
    }

    public function our_ingredients($get = false) {
        if ($this->post) {
            $this->ingredient->saveData($this->post);
            redirect("recipe/our_ingredients");
        } elseif (isset($get["ing_id"])) {
            $information['ingredient'] = $this->ingredient->getIngredientById($get["ing_id"]);
            $this->view->load('recipe/ingredients', $information);
        } else {
            $this->view->load('recipe/ingredients');
        }
    }

    function delete_ingredient($get = false) {
        $this->ingredient->delete($get["ing_id"]);
        redirect("recipe/our_ingredients");
    }

}
