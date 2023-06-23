<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Notification;
use Illuminate\Http\Request;

class admin_categorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $latest_10_notifications = Notification::where('role','admin')->latest()->limit(10)->get();

        $search = $request->input('search');

        $query = Categorie::query();

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        $paginate_data = $query->paginate(10);
        $paginate_data->appends(['search' => $search]);

        return view('pages.admin.category.categorie',['paginator' => $paginate_data,'notifications' => $latest_10_notifications]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $latest_10_notifications = Notification::where('role','admin')->latest()->limit(10)->get();

        return view('pages.admin.category.categorieAdd',['notifications' => $latest_10_notifications]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $row = new Categorie();
        $row->name = $request->input('name');
        $row->description = $request->input('description');
        $row->save();
        return redirect()->route('admin.categorie.all');
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

        $resource_info = Categorie::find($id);
        return view('pages.admin.category.categorieEdit',['resource_info' => $resource_info,'notifications' => $latest_10_notifications]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $row = Categorie::find($id);
        $row->name = $request->input('name');
        $row->description = $request->input('description');
        $row->save();
        return redirect()->route('admin.categorie.all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categorie::destroy($id);
        return redirect()->route('admin.categorie.all');
    }
}
