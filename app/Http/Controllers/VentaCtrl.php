<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Recipe;
use App\Models\Order;
use Illuminate\Http\Request;
use Session;
class VentaCtrl extends Controller
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
    public function index()
    {
        $recipes = Recipe::all();
        $clients = Client::all();
        $orders = Order::all();
        return view('venta/index', ['allRecipes' => $recipes,'allClients' => $clients,'allOrders' => $orders]);
    }
    public function order($id)
    {
        $order = Order::find($id);
        return view('venta/order', compact('order'));
    }
    public function freelunch(Request $request)
    {
        $recipe = Recipe::orderByRaw("RAND()")->first();
        $order=Order::create([
            'status'    => 'Waiting',
            'recipe_id' => $recipe->id,
            'client_id' => $request->client_id,
        ]);
        Session::flash('flash_message', 'Orden enviada a Cocina #'.$order->id);
        return back();
    }
}
