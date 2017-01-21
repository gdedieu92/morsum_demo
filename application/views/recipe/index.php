<?php
$recipe = isset($information["recipe"]) ? $information["recipe"] : null;

if (!isset($recipe)):
    ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Our Recipes</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Recipes</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table data-toggle="table" data-url="<?= base_url("recipe/getRecipesAjax") ?>"  data-show-refresh="true" data-show-toggle="true" 
                               data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true"  data-side-pagination="server"
                               data-sort-name="name" data-sort-order="desc">
                            <thead>
                                <tr>
                                    <th data-field="rec_id" >Nro</th>
                                    <th data-field="rec_name" data-sortable="true">Name</th>
                                    <th data-field="rec_description"  data-sortable="true">Description</th>
                                    <th data-field="rec_quantity_ingredients" data-sortable="true">Ingredients</th>
                                    <th data-field="acciones" data-align="left" data-formatter="actionFormatter" data-events="actionEvents">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <form action="<?= base_url("recipe/our_recipes") ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <div  class='box box-primary' >
            <div  class='box-header' >
                <h3 class='box-title'>New Recipe</h3>
            </div>

            <div class='box-body' >
                <div  class='col-md-6' ><div  class='form-group' ><label >Name</label>
                        <input  class='form-control'  type='text'   value='<?= (isset($recipe) ? $recipe->rec_name : "") ?>'  name='rec_name' />
                    </div>
                </div>
                <div  class='col-md-4' ><div  class='form-group' ><label >Photo</label>
                        <input  class='form-control'  type='file' name='rec_photo' accept="image/jpeg, image/png" />
                        <?php if (isset($recipe)): ?>
                            <img src="<?= base_url("public/recipes/") . $recipe->rec_photo ?>" width="120px" />
                        <?php endif; ?>
                    </div>
                </div>

                <div  class='col-md-2' ><div  class='form-group' ><label >Active</label>
                        <input  class='form-group'  type='checkbox'  value='1' <?= isset($recipe) && $recipe->rec_active ? "checked" : "" ?> name='rec_active' />
                    </div>
                </div>
                <div  class='col-md-4' ><div  class='form-group' ><label >Descripcion</label>
                        <textarea style="height: 300px;" id="text_desc"  class='form-control'   name='rec_description' ><?= (isset($recipe) ? $recipe->rec_description : "") ?></textarea>
                    </div> 
                </div>

                <div class='col-md-8'>

                    <?php
                    if (isset($recipe) && $recipe->ingredients):
                        foreach ($recipe->ingredients as $rec_ingredient):
                            ?>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label>Ingredient</label>
                                        <select name='ingredients[<?= $x ?>][rin_ing_id]' class='form-control'>
                                            <option selected disabled >Sel. Ing.</option>
                                            <?php foreach ($information["ingredients"] as $ingredient): ?>
                                                <option <?= $rec_ingredient->rin_ing_id == $ingredient->ing_id ? "selected" : "" ?> value='<?= $ingredient->ing_id ?>'><?= $ingredient->ing_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <label>UME</label>
                                        <select name='ingredients[<?= $x ?>][rin_ume_id]' class='form-control'>
                                            <option selected disabled >Sel. UME</option>
                                            <?php foreach ($information["umes"] as $ume): ?>
                                                <option <?= $rec_ingredient->rin_ume_id == $ume->ume_id ? "selected" : "" ?> value='<?= $ume->ume_id ?>'><?= $ume->ume_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <label>Quantity</label>
                                        <input type='number' name='ingredients[<?= $x ?>][rin_quantity]' value='<?= $rec_ingredient->rin_quantity ?>' class='form-control' />
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>

                    <?php for ($x = 0; $x < 5; $x++): ?>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label>Ingredient</label>
                                    <select name='ingredients[<?= $x ?>][rin_ing_id]' class='form-control'>
                                        <option selected disabled >Sel. Ing.</option>
                                        <?php foreach ($information["ingredients"] as $ingredient): ?>
                                            <option value='<?= $ingredient->ing_id ?>'><?= $ingredient->ing_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <label>UME</label>
                                    <select name='ingredients[<?= $x ?>][rin_ume_id]' class='form-control'>
                                        <option selected disabled >Sel. UME</option>
                                        <?php foreach ($information["umes"] as $ume): ?>
                                            <option value='<?= $ume->ume_id ?>'><?= $ume->ume_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <div class='form-group'>
                                    <label>Quantity</label>
                                    <input type='number' name='ingredients[<?= $x ?>][rin_quantity]' class='form-control' />
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class='col-md-12 pull-right' >
                <input  class='btn-sm btn-primary pull-right'  type='submit'  value='Save' />
            </div>
            <input  type='hidden'  value='<?= (isset($recipe) ? $recipe->rec_id : "") ?>'  name='rec_id'/>
        </div>
    </form>
</div>

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

<script type='text/javascript'>
    function actionFormatter(value, row, index) {
        return [
            '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon-edit"></i>',
            '</a> &nbsp;&nbsp;',
            '<a class="delete" href="javascript:void(0)" title="Delete">',
            '<i class="glyphicon glyphicon-trash"></i>',
            '</a>'
        ].join('');
    }
    window.actionEvents = {
        'click .edit': function (e, value, row, index) {
            window.location.href = ('<?= base_url("recipe/our_recipes/rec_id/") ?>' + row.rec_id);
        },
        'click .delete': function (e, value, row, index) {
            window.location.href = ('<?= base_url("recipe/delete_recipe/rec_id/") ?>' + row.rec_id);
        }
    };

</script>