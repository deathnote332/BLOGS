<?php

namespace App\Http\Controllers;

use App\Category;
use \App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Theme;
use Yajra\Datatables\Facades\Datatables;
use App\Menu;
use App\User;
use App\Ingredient;
use App\Recipe;
use App\OrderItem;
use App\Order;
use App\RecipeIngredient;
use File;
use DB;
use Auth;
class AdministratorController extends Controller
{
    public function graphPage(){

        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.graph')->render();

    }

    public function ingredientPage(){

        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.ingredient')->render();

    }

    public function menuPage(){

        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.menu')->render();

    }

    public function recipePage(){

        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.recipe')->render();

    }

    public function clientPage(){

        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.client')->render();

    }

    public function tablePage(){

        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.tables')->render();

    }

    public function loadUser(Request $request){
        $user = User::get();
        return Datatables::of($user)
            ->addColumn('id', function ($data) use ($request){
                return $data->id;
            })
            ->addColumn('name', function ($data) use ($request){
                return $data->first_name.' '.$data->last_name;
            })
            ->addColumn('email', function ($data) use ($request){
                return $data->email;
            })
            ->addColumn('user_type', function ($data) use ($request){
                return config('constant.user_type_'.$data->user_type);
            })
            ->make(true);
    }

    public function addUser(Request $request){

        $insert = new User();
        $insert->first_name = $request->name1;
        $insert->last_name = $request->name1_1;
        $insert->email = $request->name2;
        $insert->password = bcrypt($request->name3);
        $insert->user_type = $request->name5;

        $insert->save();

        return 'success';
    }


    public function loadMenu(Request $request){
        $menu= Menu::get();
        return Datatables::of($menu)
            ->addColumn('img', function ($data) use ($request){
                return "<div class='box-menu'><img src=".url($data->image)." height='100%' width='100%'></div>";
            })
            ->addColumn('name', function ($data) use ($request){
                return $data->food_name;
            })
            ->addColumn('price', function ($data) use ($request){
                return $data->price;
            })
            ->addColumn('status', function ($data) use ($request){
                $stat = ($data->status == 1) ? 'available-menu' : 'notavailable-menu';
                return "<span class=".$stat.">".config('constant.menu_stat_'.$data->status)."</span>";
            })
            ->addColumn('category', function ($data) use ($request){
                return Category::find($data->category_id)->name;
            })
            ->addColumn('recipe', function ($data) use ($request){
                return Recipe::find($data->recipe_id)->recipe_name;
            })
            ->addColumn('action', function ($data) use ($request){
                return (Auth::user()->user_type == 1)?'<button class="btn btn-xs btn-delete" data-id="'.$data->id.'">Delete</button>'.' '.'<button class="btn btn-xs btn-view" data-id="'.$data->id.'">View</button>':' '.'<button class="btn btn-xs btn-view" data-id="'.$data->id.'">View</button>';
            })
            ->make(true);
    }

    public function loadIngredient(Request $request){
        $ingredient = Ingredient::get();
        return Datatables::of($ingredient)
            ->addColumn('id', function ($data) use ($request){
                return $data->id;
            })
            ->addColumn('name', function ($data) use ($request){
                return $data->name;
            })
            ->addColumn('quantity', function ($data) use ($request){
                if($data->quantity <= 0){
                    $warning = '<span style="color:red;font-weight: bolder;">(empty)</span>';
                }else if($data->quantity < 100 ){
                    $warning = '<span style="color:#fa7753;font-weight: bolder;">(warning)</span>';
                }else{
                    $warning ='';
                }

                return $data->quantity.' '.$warning;
            })
            ->addColumn('action', function ($data) use ($request){
                return (Auth::user()->user_type == 1)?'<button class="btn btn-xs btn-delete" data-id="'.$data->id.'">Delete</button>'.'<button class="btn btn-xs btn-view" data-id="'.$data->id.'">View</button>'.'<button class="btn btn-xs btn-purchase" data-id="'.$data->id.'">Purchase</button>':' '.'<button class="btn btn-xs btn-view" data-id="'.$data->id.'">View</button>';
            })
            ->make(true);
    }

    public function addMenu(Request $request){


        $insert = new Menu();
        $insert->food_name = $request->name1;
        $insert->price = $request->name3;
        $insert->status = $request->name2;
        $insert->category_id = $request->name4;
        $insert->recipe_id = $request->name5;

        if($request->empty !== '') {
            //UPLOAD
            $path = 'images';
            try {
                $extension = $request->file->getClientOriginalExtension();
                $filename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extension;
                $new_filename = round(microtime(true)) . '.' . $extension;
                $request->file->move($path, $new_filename);
            } catch (\Exception $ex) {
                $extension = $request->file->getClientOriginalExtension();
                $filename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extension;
                $new_filename = round(microtime(true)) . '.' . $extension;
                $request->file->move($path, $new_filename);
            }
            //UPLOAD
            $insert->image = 'images\\'.$new_filename;
        }else{
            $insert->image = 'images\\'.'empty.png';
        }


        $insert->save();

        return $request->all();
    }

    public function loadGraph(Request $request){
        $data = Order::select([
            DB::raw('transaction_date AS date'),
            DB::raw('sum(total) AS sum'),
        ])
            ->where('order_status',3)
            ->whereBetween('transaction_date', [$request->from, $request->to])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $array_data = [];
        $array_data1 =[];

        foreach ($data as $total){
            $array_data[] = $total->sum;
            $array_data1[] = $total->date;
        }

        $all_data =[
            'total' =>$array_data,
            'transaction_date' =>$array_data1,
        ];

        return $all_data;
    }


    public function loadGraph_new(Request $request){

        $list_id = Order::whereBetween('transaction_date', [$request->from, $request->to])->where('order_status',3)->get();

        $array_data = [];


        foreach ($list_id as $list){
            $array_data[] = $list->id;
        }


            $data = OrderItem::select([
                DB::raw('menu_id AS menu'),
                DB::raw('sum(quantity) AS sum'),
            ])
                ->whereIn('order_id', $array_data)
                ->groupBy('menu_id')
                ->orderBy('sum', 'ASC')
                ->get();

        $array_data11 = [];
        $array_data22 =[];

        foreach ($data as $total) {
            $array_data11[] = $total->sum;
            $array_data22[] = Menu::find($total->menu)->food_name;
        }

        $all_data = [
            'quantity' => $array_data11,
            'menu' => $array_data22,
        ];

        return $all_data;
    }

    public function addIngredient(Request $request){

        $addingredient = new Ingredient();
        $addingredient->name  = $request->name1;
        $addingredient->quantity  = $request->name2;
        $addingredient->save();

        return 'success';
    }

    public function viewMenu(Request $request){
        $menu = Menu::where('id',$request->id)->first();
        $data = [
            'data' => $menu
        ];
        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.single_menu',$data)->render();
    }

    public function updateMenu(Request $request){


        $updateMenu = Menu::find($request->id);
        $updateMenu->food_name = $request->name1;
        $updateMenu->price = $request->name2;
        $updateMenu->status = $request->name3;
        $updateMenu->category_id = $request->name4;
        $updateMenu->recipe_id = $request->name5;

        if($request->empty !== ''){
            //UPLOAD
            $path = 'images';
            try {
                $extension = $request->file->getClientOriginalExtension();
                $filename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extension;
                $new_filename = round(microtime(true)) . '.' . $extension;
                $request->file->move($path, $new_filename);
            } catch (\Exception $ex) {
                $extension = $request->file->getClientOriginalExtension();
                $filename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extension;
                $new_filename = round(microtime(true)) . '.' . $extension;
                $request->file->move($path, $new_filename);
            }
            //UPLOAD
            File::delete($request->file_data);
            $updateMenu->image = 'images\\'.$new_filename;
        }

        $updateMenu->update();

        return 'success';
    }

    public function deleteMenu(Request $request){

        Menu::find($request->id)->delete();

        return 'success';
    }

    public function deleteIngredient(Request $request){

        Ingredient::find($request->id)->delete();

        return 'success';
    }

    public function viewIngredient(Request $request){
        $menu = Ingredient::where('id',$request->id)->first();
        $data = [
            'data' => $menu
        ];
        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.single_ingredient',$data)->render();
    }

    public function updateIngredient(Request $request){
        $updateIngredient = Ingredient::find($request->id);
        $updateIngredient ->name = $request->name1;
        $updateIngredient ->quantity = $request->name2;
        $updateIngredient ->update();
        return 'success';
    }

    public function loadRecipe(Request $request){
        $recipe = Recipe::get();
        return Datatables::of($recipe)
            ->addColumn('id', function ($data) use ($request){
                return $data->id;
            })
            ->addColumn('name', function ($data) use ($request){
                return $data->recipe_name;
            })
            ->addColumn('action', function ($data) use ($request){
                return (Auth::user()->user_type == 1)?'<button class="btn btn-xs btn-view" data-id="'.$data->id.'">View</button>':' '.'<button class="btn btn-xs btn-view" data-id="'.$data->id.'">View</button>';
            })
            ->make(true);
    }

    public function saveRecipe(Request $request){
        $list = json_decode($request->list);

        $recipe_name = $request->recipe;

        $newrep = new Recipe;
        $newrep->recipe_name = $recipe_name;
        $newrep->save();

        $last_id = $newrep->id;

        $en = json_encode($list);

        foreach($list as $li){

            $newlist = new RecipeIngredient;
            $newlist->recipe_id = $last_id;
            $newlist->ingredient_id = $li->id;
            $newlist->quantity = $li->qty;
            $newlist->save();

        }


        return $last_id;

    }

    public function loadlistOrder(){
        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.list_order')->render();
    }

    public function loadOrder(Request $request){
        $order = Order::get();
        return Datatables::of($order)
            ->addColumn('id', function ($data) use ($request){
                return $data->id;
            })
            ->addColumn('waiter', function ($data) use ($request){
                return User::find($data->user_id)->first_name.' '.User::find($data->user_id)->last_name;
            })
            ->addColumn('total', function ($data) use ($request){
                return $data->total;
            })
            ->addColumn('status', function ($data) use ($request){
                return config('constant.order_stat_'.$data->status);
            })
            ->addColumn('order_status', function ($data) use ($request){
                return config('constant.order_stat_'.$data->order_status);
            })
            ->addColumn('transaction_date', function ($data) use ($request){
                return $data->transaction_date;
            })
            ->addColumn('action', function ($data) use ($request){
                return '<button class="btn btn-xs btn-view" data-id="'.$data->id.'">View</button>';
            })
            ->make(true);
    }

    public function loadviewlistOrder(Request $request){
        $order = Order::where('id',$request->id)->first();
        $data = [
            'data' => $order
        ];
        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.single_order',$data)->render();
    }

    public function viewRecipe(Request $request){
        $recipe = Recipe::where('id',$request->id)->first();
        $data = [
            'data' => $recipe
        ];
        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.single_recipe',$data)->render();
    }

    public function addPurchase(Request $request){

        $quantity = $request->name1;
        $id = $request->id;

        $get_exsisting_qty = Ingredient::find($id)->quantity;

        $updateIngredient = Ingredient::find($id);
        $updateIngredient ->quantity = $get_exsisting_qty +  $quantity;
        $updateIngredient ->update();

        return 'success';
    }

    public function loadTable(Request $request){
        $user = DB::table('restaurant_table')->get();
        return Datatables::of($user)
            ->addColumn('id', function ($data) use ($request){
                return $data->id;
            })
            ->addColumn('table_location', function ($data) use ($request){
                return $data->position;
            })

            ->make(true);
    }

    public function addTable(Request $request){
        DB::table('restaurant_table')->insert(['position'=>$request->position]);

    }
}
