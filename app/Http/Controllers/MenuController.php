<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function getMenu()
    {
        $menu = DB::table('categories')->get();
        return json_encode($menu);

    }

    public function getMenuList(Request $request)
    {
        $menuList = DB::table('menus_list')->where('category_id', $request->menu_id)->get();
        return json_encode($menuList);

    }

    public function loginWaiter(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => 4])) {
            $message = [
                'isLogin' => 1,
                'id' => Auth::user()->id,
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'address' => Auth::user()->address,
                'contact' => Auth::user()->contact,
                'email' => Auth::user()->email,
            ];
        } else {
            $message['isLogin'] = 0;
        }

        return json_encode($message);
    }


    public function createWaiter(Request $request)
    {

        $createUser = User::insert(
            ['first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'contact' => $request->contact,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'user_type' => 4]);

        if ($createUser) {
            $message['message'] = "Account successfully created";
        } else {
            $message['message'] = "Error occurred";
        }

        return json_encode($message);

    }

    public function updateWaiter(Request $request)
    {


        if ($request->password != "" || !empty($request->password)) {


            $updateUser = User::where('id', $request->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'contact' => $request->contact,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

        } else {

            $updateUser = User::where('id', $request->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'contact' => $request->contact,
                'email' => $request->email,
            ]);

        }


        $user = User::find($request->id);

        if ($updateUser) {
            $message = [
                'success' => 1,
                'message' => "Account successfully updated",
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'address' => $user->address,
                'contact' => $user->contact,
                'email' => $user->email,
            ];
        } else {
            $message['success'] = 0;
            $message['message'] = "Error occurred";
        }

        return json_encode($message);

    }

    public function getTable()
    {
        $tablecount = DB::table('restaurant_table')->count();

        for ($i = 1; $i <= $tablecount; $i++) {
            $getTable1 = DB::table('orders')->where('table_number', $i)->where('order_status', 2)->first();
            if (empty($getTable1)) {
                $tableList[] = ['id' => $i, 'status' => 0, 'user_id' => 0];
            } else {
                $tableList[] = ['id' => $i, 'status' => 1, 'user_id' => $getTable1->user_id];
            }
        }


        return json_encode($tableList);
    }


//
//    public function getCart(Request $request){
//        $order_id = 1;
//        $table = DB::table('order_items')
//            ->join('menus_list','order_items.product_id','menus_list.id')
//            ->select('order_items.quantity','menus_list.id','menus_list.food_name')
//            ->where('order_items.order_id',$order_id)
//            ->get();
//        return json_encode($table);
//    }

    public function getTemporaryCart(Request $request)
    {

        $user_id = $request->user_id;
        $table = DB::table('temp_order')
            ->join('menus_list', 'temp_order.product_id', 'menus_list.id')
            ->select('temp_order.quantity', 'temp_order.product_id', 'temp_order.id', 'menus_list.price', 'menus_list.food_name', 'menus_list.image')
            ->where('temp_order.user_id', $user_id)
            ->get();


        return json_encode($table);

    }

    public function insertOrder(Request $request)
    {

        $food_id = $request->food_id;
        $food_quantity = $request->food_quantity;
        $user_id = $request->user_id;

        $checkData = DB::table('temp_order')->where('user_id', $user_id)->where('product_id', $food_id)->first();
        if ($checkData == null || $checkData == '') {
            $insertData = DB::table('temp_order')->insert(['product_id' => $food_id, 'quantity' => $food_quantity, 'user_id' => $user_id]);
        } else {
            $old_qty = $checkData->quantity;
            $new_qty = $old_qty + $food_quantity;
            $insertData = DB::table('temp_order')->where('user_id', $user_id)->where('product_id', $food_id)->update(['quantity' => $new_qty]);
        }

        if ($insertData) {
            $message['message'] = "Successfully added to cart";
        } else {
            $message['message'] = "Error occured";
        }

        return json_encode($message);


    }

    public function updateFoodCart(Request $request)
    {

        $cart_id = $request->id;
        $quantity = $request->quantity;


        $updateData = DB::table('temp_order')->where('id', $cart_id)->update(['quantity' => $quantity]);

        if ($updateData) {
            $message['message'] = "Successfully updated.";
        } else {
            $message['message'] = "Error occured";
        }

        return json_encode($message);


    }

    public function deleteFoodCart(Request $request)
    {

        $cart_id = $request->id;

        $deleteData = DB::table('temp_order')->where('id', $cart_id)->delete();

        $message['message'] = "Successfully deleted.";

        return json_encode($message);

    }


    public function createOrder(Request $request)
    {

        //$cart_id = $request->id;
        $user_id = $request->user_id;
        $note = $request->note;
        $table_number = $request->table_number;

        $tempCart = DB::table('temp_order')->where('user_id', $user_id)->get();

        $getTempCartTotal = DB::table('temp_order')
            ->join('menus_list', 'menus_list.id', 'temp_order.product_id')
            ->select(DB::raw('SUM(menus_list.price * temp_order.quantity) as total'))
            ->where('user_id', $user_id)
            ->first();

        $date = date("Y-m-d");

        $order_id = DB::table('orders')->insertGetId(['user_id' => $user_id, 'total' => $getTempCartTotal->total, 'notes' => $note, 'transaction_date' => $date, 'table_number' => $table_number]);

        foreach ($tempCart as $key => $val) {
            DB::table('order_items')->insert(['order_id' => $order_id, 'menu_id' => $val->product_id, 'quantity' => $val->quantity]);
        }


        //updating table status
        $updatecart = DB::table('restaurant_table')->where('id', $table_number)->update(['status' => 1]);


        //deleting temp cart
        $deleteCart = DB::table('temp_order')->where('user_id', $user_id)->delete();

        $message['message'] = "Order succesfully created.";

        return json_encode($message);

    }


    public function getOrder(Request $request)
    {

        $user_id = $request->user_id;
        $table_number = $request->table_number;

        $orders = DB::table('orders')->where('user_id', $user_id)->where('table_number', $table_number)->orderBy('id', 'desc')->get();

        $list = [];
        foreach ($orders as $key => $val) {
            array_push($list, ["id" => $val->id, "user_id" => $val->user_id, "order_status" => $val->order_status, "total" => $val->total, "created_at" => Date("M d,Y h:i A", strtotime($val->created_at))]);

        }

        return json_encode($list);

    }

    public function updateToken(Request $request)
    {

        $user_id = $request->user_id;
        $token = $request->token;
        User::where('id', $user_id)->update(['token' => $token]);

    }
	

	

	
}
