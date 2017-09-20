{!! Theme::asset()->usePath()->add('recipe-css','/css/admin/recipe.css') !!}
{!! Theme::asset()->usePath()->add('recipe-js','/js/admin/recipe.js') !!}

<div class="col-md-12">
    <div class="content-box-large">
        <div class="panel-heading">
            <div class="panel-title">List of Recipe</div>
        </div>
        <div class="panel-body">
            @if(Auth::user()->user_type == 1)
                <button type="button" class="btn btn-primary add-btn" id="addbtn">Add Recipe</button>
            @endif
            <table id="tbl-recipe" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('modals.addrecipe')