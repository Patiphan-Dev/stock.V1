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

        return view('product.index', $data, compact('products'));
    }

    public function add()
    {
        $data = [
            'title' => 'Add Products'
        ];

        return view('product.add', $data);
    }

    public function create(Request $request)
    {
        // Validate
        $request->validate([
            'prod_name' => ['required'],
            'prod_price_per_unit' => ['required'],
            'prod_buy_qty' => ['required', 'numeric'],
            'prod_sales_qty' => ['required', 'numeric'],
            'prod_min_qty' => ['required', 'numeric'],
        ]);

        // dd($request);


        // Register
        ProductList::create([
            'po_id' => $request->po_id,
            'prod_name' => $request->prod_name,
            'prod_length' => $request->prod_length,
            'prod_price_per_unit' => $request->prod_price_per_unit,
            'prod_buy_qty' => $request->prod_buy_qty,
            'prod_sales_qty' => $request->prod_sales_qty,
            'prod_min_qty' => $request->prod_min_qty,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect
        return redirect()->route('product.index')->with('success', 'เพิ่มสินค้าเข้าสต๊อกสำเร็จ');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Product List'
        ];
        $product = ProductList::findOrFail($id); // ดึงข้อมูล ProductList ที่ต้องการแก้ไข

        return view('product.edit', array_merge($data, compact('product')));
    }

    public function update(Request $request, $id)
    {
        // Validate
        $request->validate([
            'prod_name' => ['required'],
            'prod_price_per_unit' => ['required'],
            'prod_buy_qty' => ['required', 'numeric'],
            'prod_sales_qty' => ['required', 'numeric'],
            'prod_min_qty' => ['required', 'numeric'],
        ]);

        // dd($request);

        $product = ProductList::findOrFail($id);

        // Update ProductList
        $product->update([
            'po_id' => $request->po_id,
            'prod_name' => $request->prod_name,
            'prod_length' => $request->prod_length,
            'prod_price_per_unit' => $request->prod_price_per_unit,
            'prod_buy_qty' => $request->prod_buy_qty,
            'prod_sales_qty' => $request->prod_sales_qty,
            'prod_min_qty' => $request->prod_min_qty,
            'updated_at' => now(),
        ]);


        // Redirect
        return redirect()->route('product.index')->with('success', 'เพิ่มสินค้าเข้าสต๊อกสำเร็จ');
    }

    public function delete($id)
    {
       // ลบข้อมูลใน ProductList ที่มี id ตรงกับที่ระบุ
        $product = ProductList::find($id);

        // ตรวจสอบว่ามีรายการอยู่หรือไม่
        if ($product) {
            $product->delete();
            return redirect()->back()->with('success', 'ลบสำเร็จ');
        } else {
            return redirect()->back()->with('error', 'ไม่พบรายการที่ต้องการลบ');
        }
    }
}
