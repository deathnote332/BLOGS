<div class="content-box-large">

    <div class="panel-body">
        <div class="container-fluid">
            <h5>Recipe #{{$data->id}}</h5>
            <form class="form-update-ingredient" id="form-order">
                <h2>{{$data->recipe_name}}</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                    </tr>

                    </thead>
                    <tbody>
                    @foreach(App\RecipeIngredient::where('recipe_id',$data->id)->get() as $list)
                        <tr>
                            <td>{{App\Ingredient::find($list->ingredient_id)->name}}</td>
                            <td>{{$list->quantity}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>