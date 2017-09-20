{!! Theme::asset()->usePath()->add('user-css','/css/admin/user.css') !!}
{!! Theme::asset()->usePath()->add('user-js','/js/admin/user.js') !!}

<div class="col-md-12">

    <div class="content-box-large">
        <div class="panel-heading">
            <div class="panel-title">List of Users</div>
        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-primary add-btn" id='add-btn'>Add User</button>
            <table id="tbl-user" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('modals.adduser')
