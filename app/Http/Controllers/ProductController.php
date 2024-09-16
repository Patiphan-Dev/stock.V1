<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductList;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Product List'
        ];
        $products = ProductList::all();

        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd(array_merge($data, compact('productLists')));

        return view('product.index', $data, compact('products'));
    }

    public function create(Request $request)
    {
        // Validate
        $request->validate([
            'po_id' => ['required', 'max:255'],
            'prod_id' => ['required'],
            'prod_name' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg']
        ]);

        // Create a product
        $product = ProductList::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        // Send email when users create a product (for practice)
        // Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $product));

        // Redirect back to dashboard
        return back()->with('success', 'Your product was created.');
    }
}
