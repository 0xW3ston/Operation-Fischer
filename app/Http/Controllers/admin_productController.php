<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Notification;
use Illuminate\Http\Request;

class admin_productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $latest_10_notifications = Notification::where('role','admin')->latest()->limit(10)->get();

        $search = $request->input('search');

        $query = Article::query();

        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%");
        }

        $paginate_data = $query->paginate(10);
        $paginate_data->appends(['search' => $search]);

        return view('pages.admin.product.product',['paginator' => $paginate_data,'notifications' => $latest_10_notifications]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $latest_10_notifications = Notification::where('role','admin')->latest()->limit(10)->get();

        $allCategories = Categorie::all(['id','name']);
        return view('pages.admin.product.productAdd',['categories' => $allCategories,'notifications' => $latest_10_notifications]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $img_path = null;
        if($request->hasFile('image')){
            $path = $request->file('image')->store('product','public');
            $img_path = $path;
        };
        $row = Article::create([
            "name" => $request->input('name'),
            "description" => $request->input('description'),
            "price" => $request->input('price'),
            "categorie_id" => $request->input('categorie'),
            "img_path" => $img_path
        ]);
        return redirect()->route('admin.product.all');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $latest_10_notifications = Notification::where('role','admin')->latest()->limit(10)->get();

        $resource_info = Article::find($id);
        $allCategories = Categorie::all(['id','name']);
        return view('pages.admin.product.productEdit',['resource_info' => $resource_info,'categories' => $allCategories,'notifications' => $latest_10_notifications]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $row = Article::find($id);
        if($request->hasFile('image')){
            $path = $request->file('image')->store('product','public');
            $row->img_path = $path;
        };
        $row->name = $request->input('name');
        $row->description = $request->input('description');
        $row->price = $request->input('price');
        $row->categorie_id = $request->input('categorie');
        $row->save();
        return redirect()->route('admin.product.all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Article::destroy($id);
        return redirect()->route('admin.product.all');
    }
}
