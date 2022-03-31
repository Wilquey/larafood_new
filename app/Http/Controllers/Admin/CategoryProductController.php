<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class CategoryProductController extends Controller
{
    private $product, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;

        $this->middleware(['can:products']);
    }

    /******************************************************************************************************
     *PermissionProfileController
     *CategoryProductController
     *Permission = Category
     *Profile = Product
     ******************************************************************************************************/

    /******************************************************************************************************
     * Categories
     ******************************************************************************************************/

    public function categories($idProduct)
    {
        $product = $this->product->find($idProduct);

        if(!$product) {
            return redirect()->back();
        }

        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', compact('product', 'categories'));

    }

    public function categoriesAvailable(Request $request, $idProduct)
    {
        //dd($request->all());
        $product = $this->product->find($idProduct);

        if (!$product) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available', compact('product', 'categories', 'filters'));
    }

    public function attachCategoriesProduct(Request $request, $idProduct)
    {
        $product = $this->product->find($idProduct);

        if (!$product) {
            return redirect()->back();
        }

        if (!$request->categories || count($request->categories) == 0){
             return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');

        }

        //dd($request->categories);

        $product->categories()->attach($request->categories);

        return redirect()->route('products.categories', $product->id);
    }

    public function detachCategoryProduct($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if (!$product || !$category) {
            return redirect()->back();
        }

        $product->categories()->detach($category);

        return redirect()->route('products.categories', $product->id);
    }

    /******************************************************************************************************
     * Products
     ******************************************************************************************************/


    public function products($idCategory)
    {
        $category = $this->category->find($idCategory);

        if (!$category) {
            return redirect()->back();
        }

        $products = $category->products()->paginate();

        return view('admin.pages.categories.products.products', compact('products', 'category'));
    }

    public function productsAvailable(Request $request, $idCategory)
    {
        $category = $this->category->find($idCategory);

        if (!$category) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $products = $category->productsAvailable($request->filter);

        return view('admin.pages.categories.products.available', compact('products', 'category', 'filters'));
    }


    public function attachProductsCategory(Request $request, $idCategory)
    {
        $category = $this->category->find($idCategory);

        if (!$category) {
            return redirect()->back();
        }

        if (!$request->products || count($request->products) == 0){
             return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma categoria');

        }

        //dd($request->categories);

        $category->products()->attach($request->products);

        return redirect()->route('categories.products', $category->id);
    }


    public function detachProductPermission($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if (!$product || !$category) {
            return redirect()->back();
        }

        $category->products()->detach($product);

        return redirect()->route('categories.products', $product->id);
    }
}
