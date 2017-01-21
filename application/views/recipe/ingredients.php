<?php
$ingredient = isset($information["ingredient"]) ? $information["ingredient"] : null;

if (!isset($ingredient)):
    ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Our Ingredients</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ingredients</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table data-toggle="table" data-url="<?= base_url("recipe/getIngredientsAjax") ?>"  data-show-refresh="true" data-show-toggle="true" 
                               data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true"  data-side-pagination="server"
                               data-sort-name="name" data-sort-order="desc">
                            <thead>
                                <tr>
                                    <th data-field="ing_id" >Nro</th>
                                    <th data-field="ing_name" data-sortable="true">Name</th>
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
    <form action="<?= base_url("recipe/our_ingredients") ?>" method="post" accept-charset="utf-8">
        <div  class='box box-primary' >
            <div  class='box-header' >
                <h3 class='box-title'>New Ingredient</h3>
            </div>

            <div class='box-body' >
                <div  class='col-md-6' >
                    <div  class='form-group' >
                        <label >Name</label>
                        <input  class='form-control'  type='text'   value='<?= (isset($ingredient) ? $ingredient->ing_name : "") ?>'  name='ing_name' />
                    </div>
                </div>              
            </div>
            <div class='col-md-12 pull-right' >
                <input  class='btn-sm btn-primary pull-right'  type='submit'  value='Save' />
            </div>
            <input  type='hidden'  value='<?= (isset($ingredient) ? $ingredient->ing_id : "") ?>'  name='ing_id'/>
        </div>
    </form>
</div>


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
            window.location.href = ('<?= base_url("recipe/our_ingredients/ing_id/") ?>' + row.ing_id);
        },
        'click .delete': function (e, value, row, index) {
            window.location.href = ('<?= base_url("recipe/delete_ingredient/ing_id/") ?>' + row.ing_id);
        }
    };

</script>