{!! Theme::asset()->usePath()->add('menu-css','/css/admin/menu.css') !!}
{!! Theme::asset()->usePath()->add('menu-js','/js/admin/menu.js') !!}

<div class="col-md-12">
    <div class="content-box-large">
        <div class="panel-heading">
            <div class="panel-title">List of Menu</div>
        </div>
        <div class="panel-body">
            @if(Auth::user()->user_type == 1)
            <button type="button" class="btn btn-primary add-btn" id="addbtn">Add Menu</button>
            @endif
            <table id="tbl-menu" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Recipe</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('modals.addmenu')