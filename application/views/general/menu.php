<?php
/* @var $this View */
$menu_panel = "";
$menu_recipe = "";
$menu_ingredient = "";
if ($this->getActiveMethod() == "our_recipes") {
    $menu_recipe = "active";
} elseif ($this->getActiveMethod() == "our_ingredients") {
    $menu_ingredient = "active";
} else {
    $menu_panel = "active";
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>MORSUM</span>Admin</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li class='<?= $menu_panel ?>'><a href="<?= base_url("panel/index") ?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>Panel</a></li>
        <li class='<?= $menu_recipe ?>'><a href="<?= base_url("recipe/our_recipes") ?>"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Recipes</a></li>
        <li class='<?= $menu_ingredient ?>'><a href="<?= base_url("recipe/our_ingredients") ?>"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Ingredients</a></li>
    </ul>

</div>