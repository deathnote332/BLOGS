{!! Theme::asset()->usePath()->add('ingredient-css','/css/admin/ingredient.css') !!}
{!! Theme::asset()->usePath()->add('ingredient-js','/js/admin/ingredient.js') !!}

<div class="col-md-12">
    <div class="content-box-large">
        <div class="panel-heading">
            <div class="panel-title">List of Ingredients</div>
        </div>
        <div class="panel-body">
            @if(Auth::user()->user_type == 1)
            <button type="button" class="btn btn-primary add-btn" id="addbtn">Add Ingredient</button>
            @endif
            <table id="tbl-ingredient" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('modals.addingredient')
@include('modals.addpurchase')