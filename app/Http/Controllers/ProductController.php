<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $products = [];
    private $_filters;
    private $showBanner = false;

    public function __construct()
    {
        /**
         * Filters (name=>value) format to show in the view
         * Write the content of the stars
         */
        $this->_filters = (object)array(
            'category' => array(1 => 'Category 1', 2 => 'Category 2', 3 => 'Category 3', 4 => 'Category 4'),
            'stars' => array(1 => '1 estrella', 2 => '2 estrellas', 3 => '3 estrellas', 4 => '4 estrellas', 5 => '5 estrellas')
        );
    }
    /**
     * Method to list all the products
     */
    public function all()
    {
        $this->showBanner = true;
        $this->products = Product::all();
        return $this->showProducts();
    }

    /**
     * Method to list the products filtered by category
     */
    public function category(Request $request, $cat)
    {
        $this->showBanner = false;
        $this->products = Product::category($cat)->get();
        return $this->showProducts();
    }

    /**
     * Method to list the products filtered by stars
     */
    public function rating(Request $request)
    {

        $query = Product::query();
        $this->showBanner = false;

        //this filter by category (when the user is in category page)
        if ($request->filled('category')) {
            $query->category($request->input('category'));
        }
        if ($request->filled('stars')) {
            $query->rating($request->input('stars'));
        }
        $this->products = $query->get();
        return $this->showProducts();
    }

    public function showProducts()
    {
        //Load the same view for all the methods
        return view('productos/products')
            ->with('showBanner', $this->showBanner)
            ->with('filters', $this->_filters)
            ->with('products', $this->products);
    }
}
