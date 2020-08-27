<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CommonHelper, Image, File, Validator;
use DB, Auth, Session;

class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function layout()
    { 
        return view('layouts');
    }

    public function login()
    { 
        return view('login');
    }

    public function category()
    { 
        return view('category.category');
    }

    public function subcategory()
    { 
        return view('category.subcategory');
    }

    public function product_price()
    { 
        return view('reports.product_price');
    }

    public function seller_product()
    { 
        return view('reports.seller_product');
    }

    public function seller_selling()
    { 
        return view('reports.seller_selling');
    }

    public function selling_invoice()
    { 
        return view('reports.selling_invoice');
    }

    public function shopping_cart()
    { 
        return view('reports.shopping_cart');
    }

    public function wishlist()
    { 
        return view('reports.wishlist');
    }

    

}
