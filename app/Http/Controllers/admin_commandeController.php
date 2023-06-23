<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class admin_commandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $latest_10_notifications = Notification::where('role','admin')->latest()->limit(10)->get();

        // $paginator = Cart::with('articles')->paginate(10);
        $paginator = Cart::orderByRaw("status = 'unprocessed' DESC")
            ->orderBy('created_at','desc')
            ->paginate(10);
        return view('pages.admin.commande.commande',['paginator' => $paginator,'notifications' => $latest_10_notifications]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $resource_info = Cart::find($id);
        $resource_info->status = "validated";
        $resource_info->save();
        return redirect()->route('admin.commande.all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resource_info = Cart::find($id);
        $resource_info->delete();
        return redirect()->route('admin.commande.all');
    }
}
