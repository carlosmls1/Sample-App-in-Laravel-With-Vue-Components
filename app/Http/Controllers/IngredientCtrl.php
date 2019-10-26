<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Validator;
use Session;
use Redirect;
class IngredientCtrl extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();

        return view('ingredient/index', ['allIngredients' => $ingredients]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_ingredients(Request $request)
    {
        $q = $request->q;


        if($q){
            $ingredients = Ingredient::where('name','LIKE','%'.$q.'%')->get();
        }else{
            $ingredients=[];
        }

        return array('items'=>$ingredients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredient/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'qty' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect(route('ingredient.create'))
                ->withErrors($validator)
                ->withInput();
        }
        Ingredient::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'qty' => $request->get('qty'),
        ]);

        return Redirect::to(route('ingredient.index'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingredient = Ingredient::find($id);
        return view('ingredient/edit', compact('ingredient'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'qty' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect(route('ingredient.edit', $id))
                ->withErrors($validator)
                ->withInput();
        }
        // store
        $ingredient = Ingredient::find($id);
        $ingredient->name = $request->name;
        $ingredient->qty = $request->qty;
        $ingredient->save();

        // redirect
        Session::flash('message', 'Successfully updated ingredient!');
        return Redirect::to(route('ingredient.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->delete();
        return redirect('/ingredient');
    }
}
