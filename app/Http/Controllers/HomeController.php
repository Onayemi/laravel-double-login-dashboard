<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
// use Brian2694\Toastr\Facades\Toastr;
// use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome(){
        return view('admin-home');
    }

    public function project(){
        return view('project');
    }

    public function addProject(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'product' => 'required'
        ]);
        $product = Project::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'product' => $request->product,
            'toppings' => $request->toppings,
        ]);
        // dd($product);
        return redirect('project')->with('msg', 'Thanks for your Order');
    }

    public function show($id){
        // return UserCollection::collection(User::with('projects'))->get();
        $pizzas = Project::findOrFail($id);
        // return view('show', compact('pizzas'));
        return view('show', ['pizzas' => $pizzas]);
    }

    public function edit($id){
        $pizzas = Project::findOrFail($id);
        return view('edit', ['pizzas' => $pizzas]);
    }

    public function update(Request $request, $id){
        // return UserCollection::collection(User::with('projects'))->get();
        // $pizzas = Project::findOrFail($id);
        $editProduct = Project::where('id', $request->id)->update([
            'toppings' => $request->toppings,
        ]);
        echo "Update Successfully!";
        // return view('show', compact('pizzas'));
        // return view('edit', ['pizzas' => $pizzas]);
    }

    public function userLogin(Request $request){
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => [
        //         'required', 'string', 'confirmed',
        //         Password::min('8')->letters()->numbers()->mixedCase()->symbols()
        //     ]
        // ]);
    }
}
