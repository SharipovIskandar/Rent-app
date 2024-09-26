<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Branch;
use App\Models\Image;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function create(
    ): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('ads.create-ad');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|min:5',
            'description' => 'required',
            'image'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'title' => ['required' => 'Iltimos, sarlavhani kiriting!'],
        ]);

        $ad = Ad::query()->create([
            'title'       => $request->get('title'),
            'description' => $request->get('description'),
            'address'     => $request->get('address'),
            'branch_id'   => $request->get('branch_id'),
            'user_id'     => auth()->id(),
            'status_id'   => Status::ACTIVE,
            'price'       => $request->get('price'),
            'rooms'       => $request->get('rooms'),
        ]);

        if($request->hasFile('image')) {
            $file = Storage::disk('public')->put('/', $request->image);

            Image::query()->create([
                'ad_id' => $ad->id,
                'name' => $file,
            ]);
        }
        return redirect(route('ads.home'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ad = Ad::query()->findOrFail($id);
        $branches = Branch::all();
        return view('ads.show', compact('ad', 'branches'));
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
