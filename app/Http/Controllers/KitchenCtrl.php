<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Recipe;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;

class KitchenCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function order_status(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status=$request->status;
        if($order->status=='Procesando'){
            $this->check_ingredients($order->recipe);
        }
        foreach ($order->recipe->ingredient as $ingredient){
            $ingredient->qty-=$ingredient->pivot->qty;
            $ingredient->save();
        }
        $order->save();
        return redirect(route('kitchen.order',$order->id));
    }
    public function order($id)
    {
        $order = Order::find($id);
        return view('kitchen/order', ['order' => $order]);
    }
    public function index()
    {
        $orders = Order::all();
        return view('kitchen/index', ['allOrders' => $orders]);
    }
    private function check_ingredients($recipe){
        foreach ($recipe->ingredient as $ingredient){
            if($ingredient->pivot->qty > $ingredient->qty){
                $qty= intval($ingredient->pivot->qty) - intval($ingredient->qty)."\n";
                Session::flash('flash_message', 'Necesitamos comprar '.$qty.' de '.$ingredient->name.' para procesar el pedido');
                return back();
            }
        }
    }
    public function buy_ingredients($id){
        $product=Ingredient::find($id);
        $API_END='https://recruitment.alegra.com/api/farmers-market/buy';
        $params = [
            'query' => [
                'ingredient' => $product->name
            ]
        ];
        $client = new Client();
        $res = $client->request('GET', $API_END, $params);
        if ($res->getStatusCode() == 200) { // 200 OK
            $response_data = json_decode($res->getBody()->getContents());
            if($response_data->quantitySold>0){
                $product->qty+=$response_data->quantitySold;
                $product->save();
                Session::flash('flash_message', 'Se han comprado '.$product->qty);
            }else{
                Session::flash('flash_message', 'No hay existencias en el mercado, intenta luego '.$response_data->quantitySold);
            }
        }
        return back();
    }
}
