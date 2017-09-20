<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\Controller;
use App\Ingredient;
use App\RecipeIngredient;
use App\OrderItem;
use App\Menu;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Theme;
use App\Sample;

class KitchenController extends Controller
{
    public function kitchenPage(){
        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('kitchen.kitchen')->render();

    }

    public function ingredientPage(){

        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.ingredient')->render();

    }

    public function menuPage(){

        $theme = Theme::uses('default')->layout('default')->setTitle('');
        return $theme->scope('admin.menu')->render();

    }

    public function loadajaxPage(){
        return view('transactionajax');
    }

    public function finishOrder(Request $request){

        $order_id = $request->id;

        $update = Order::find($order_id);
        $update->status = 1;
        $update->update();

        $item = [];

        $order_item = OrderItem::where('order_id', $order_id)->get();

        $list = [];
        foreach($order_item as $key => $val){
            array_push($list,["menu_id"=>$val->menu_id,"quantity"=>$val->quantity]);
        }


        $recipe = [];
        foreach($list as $val){
            $item = Menu::where('id',$val['menu_id'])->first();
            array_push($recipe,["recipe_id"=>$item->recipe_id,"quantity"=>$val['quantity']]);
        }


        foreach($recipe as $val){
            $get_sub_item = RecipeIngredient::where('recipe_id',$val['recipe_id'])->get();

            foreach($get_sub_item as $sub_item_id){
                $minus = Ingredient::where('id',$sub_item_id->ingredient_id)->decrement('quantity',$val['quantity']*$sub_item_id->quantity);
            }
        }


        $order = Order::find($order_id);
        $token = User::find($order_id->user_id)->token;
        $message_status = '';
        if(!empty($token) || $token != null){
            $tokens = array();
            $tokens[]=$token;
            $message = array("message" => "Order is now ready to serve for Table ".$order->table_number);
            $message_status = $this->send_notification($token,$message);
        }

        return $message_status;
        
    }
}
