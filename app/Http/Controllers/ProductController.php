<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    // Index
    public function Index()
    {
        $products = Product::latest()->get();
        return view('welcome', compact('products'));
    }
    // StoreProduct
    public function StoreProduct(Request $request)
    {
        // Get the productimage
        $image = $request->file('product_image');
        $filename = date('YmdHi') . $image->getClientOriginalName();
        $image->move(public_path('upload/product/'), $filename);
        $save_url = 'upload/product/' . $filename;

        // Insert product into the database
        Product::insert([
            'product_name' => $request->product_name,
            'category' => $request->category,
            'price' => $request->price,
            'product_image' => $save_url,
            'created_at' => Carbon::now()
        ]);
        // Send Mail Notifications start
        $data = [
            'email' => $request->email,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'product_image' => $save_url,
        ];
        Mail::to($request->email)->send(new OrderMail($data));
        // Send Mail Notifications ends

        // Notify the user that the product has been successfully added to the database
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // UpdateProduct
    public function UpdateProduct(Request $request)
    {
        $pid = $request->id;

        // Update image
        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/product/'), $filename);
            $save_url = 'upload/product/' . $filename;

            // Update product into the database
            Product::find($pid)->update([
                'product_name' => $request->product_name,
                'category' => $request->category,
                'price' => $request->price,
                'product_image' => $save_url,
                'created_at' => Carbon::now()
            ]);
        } else {
            // Update product into the database
            Product::find($pid)->update([
                'product_name' => $request->product_name,
                'category' => $request->category,
                'price' => $request->price,
                'created_at' => Carbon::now()
            ]);
        }
        // Notify the user that the product has been successfully added to the database
        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // DeleteProduct
    public function DeleteProduct($id){
        $deleteId = Product::find($id);
        // Delete image
        unlink($deleteId->product_image);
        // Delete product from the database
        Product::find($id)->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
    // Download product and generate pdf
    public function DownloadProduct($id){
        $product = Product::where ('id', $id)->first();

        $pdf = Pdf::loadView('pdf.my_invoice', compact('product'))->setPaper('a4')->
        setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
}
