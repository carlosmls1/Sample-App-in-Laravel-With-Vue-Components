<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Validator;
use Session;
use Redirect;

class RecipeCtrl extends Controller
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
        $recipes = Recipe::all();

        return view('recipe/index', ['allRecipes' => $recipes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipe/create');
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
        ]);

        if ($validator->fails()) {
            return redirect(route('recipe.create'))
                ->withErrors($validator)
                ->withInput();
        }
        $recipe=Recipe::create([
            'name' => $request->get('name'),
        ]);

        foreach ($request->get('item_id') as $key=>$item){
            $recipe->ingredient()->attach([$item => ['qty' => $request->get('item_qty')[$key]]]);
        }

        return Redirect::to(route('recipe.index'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        return view('recipe/edit', compact('recipe'));

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
            return redirect(route('recipe.edit', $id))
                ->withErrors($validator)
                ->withInput();
        }
        // store
        $ingredient = Recipe::find($id);
        $ingredient->name = $request->name;
        $ingredient->save();

        // redirect
        Session::flash('message', 'Successfully updated Recipe!');
        return Redirect::to(route('recipe.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient = Recipe::find($id);
        $ingredient->delete();
        return Redirect::to(route('recipe.index'));
    }
}
