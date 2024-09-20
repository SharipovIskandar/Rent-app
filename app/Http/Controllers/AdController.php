<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Branch;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::all();
        $branches = Branch::all();
        return view('ads.home', compact('ads', 'branches'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function find(\Illuminate\Http\Request $request)
    {
        $ads = Branch::query()->find($request->branch_id)->ads;
        $branches = Branch::all();
        return view('ads.home', compact('ads', 'branches'));
    }

    public function search(Request $request)
    {
        $title = $request->input('search_phrase') ?? "";
        $max_price = $request->input('max_price') ?? PHP_INT_MAX;
        $min_price = $request->input('min_price') ?? 0;
        $branch_id = $request->input('branch_id') ?? null;

        $ads = Ad::query()
            ->when($title, function ($query) use ($title) {
                return $query->where('title', 'like', "%{$title}%")
                    ->orWhere('description', 'like', "%{$title}%");
            })->when($min_price, function ($query) use ($min_price) {
                return $query->where('price', '>=', $min_price);
            })->when($max_price, function ($query) use ($max_price) {
                return $query->where('price', '<=', $max_price);
            })->when($branch_id, function ($query) use ($branch_id) {
                return $query->where('branch_id', $branch_id);
            })->get();

        $branches = Branch::all();
        return view('ads.home', compact('ads', 'branches'));
    }


}
