<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use App\Models\Blog;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Pages;
use App\Models\Setting;
use App\Models\Member;
use App\Models\Subscribe;
use Illuminate\Support\Carbon;
use Session;

class FrontendController extends Controller
{
    /* safe bd */
    public function safeBD()
    {
        $settings = Setting::pluck('value', 'name');
        $members=Member::all();
        
        return view('safebd.fontend.home',compact('settings','members'));
    }

    
    
    /*=================== Start Index Methoed ===================*/
    public function index(Request $request)
    {
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $featured_category =  Category::where('featured_category', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $latest_blog = Blog::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $latest_banner = Banner::where('status', 1)->orderBy('id', 'ASC')->limit(2)->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        $hot_deals = Product::where('status', 1)->orderBy('id', 'ASC')->where('is_deals', 1)->latest()->get();
        $new_arrivals = Product::where('status', 1)->orderBy('id', 'DESC')->limit(8)->latest()->get();

        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->limit(10)->get();

        $skip_category_2 = Category::skip(1)->first();
        $skip_product_2 = Product::where('status', 1)->where('category_id', $skip_category_2->id)->orderBy('id', 'DESC')->limit(10)->get();

        $skip_category_7 = Category::skip(2)->first();
        $skip_product_7 = Product::where('status', 1)->where('category_id', $skip_category_7->id)->orderBy('id', 'DESC')->limit(10)->get();

        $today_deals = Product::whereDay('created_at', date('d'))->orderBy('id', 'DESC')->where('status', 1)->where('is_deals', 1)->limit(10)->get();
        $latest_brand = Brand::where('status', 1)->orderBy('id', 'DESC')->limit(10)->get();

        $home_view = 'frontend.home';
        return view($home_view, compact('sliders', 'featured_category', 'latest_blog', 'latest_banner', 'products', 'hot_deals', 'new_arrivals', 'skip_category_0', 'skip_product_0', 'skip_category_2', 'skip_product_2', 'skip_category_7', 'skip_product_7', 'today_deals', 'latest_brand'));
    } // end method

    /*=================== End Index Methoed ===================*/

    /*=================== Start ProductDetails Methoed ===================*/
    public function productDetails($slug)
    {

        $product = Product::where('slug', $slug)->first();
        // dd($product);
        $multiImg = MultiImg::where('product_id', $product->id)->get();
        // dd($multiImg);

        /* ================= Product Color Eng ================== */
        $color = $product->product_color;
        $product_color = explode(',', $color);
        /* ================= Product Size Eng =================== */
        $size = $product->product_size;
        $product_size = explode(',', $size);

        /* ================= Realted Product =============== */
        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $product->id)->orderBy('id', 'DESC')->get();

        $categories = Category::orderBy('category_name_en', 'ASC')->where('status', '=', 1)->limit(5)->get();
        $new_products = Product::orderBy('name_en')->where('status', '=', 1)->limit(3)->latest()->get();

        return view('frontend.product.product_details', compact('product', 'multiImg', 'categories', 'new_products', 'product_color', 'product_size', 'relatedProduct'));
    }
    /*=================== End ProductDetails Methoed ===================*/

    /* ================= Start ProductViewAjax Method ================= */
    public function ProductViewAjax($id)
    {

        $product = Product::with('category', 'brand')->findOrFail($id);
        //dd($product);
        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(

            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,

        ));
    }
    /* ================= END PRODUCT VIEW WITH MODAL METHOD =================== */

    /* ================= Start CatWiseProduct Method ================ */
    public function CatWiseProduct(Request $request, $slug)
    {

        $category = Category::where('slug', $slug)->first();
        // dd($category);

        $products = Product::where('status', 1)->where('category_id', $category->id)->orderBy('id', 'DESC')->latest()->paginate(10);

        // start category wish product filter //
        if ($request->get('filtercategory')) {

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('category_name_en', $checked)->get();
            $catId = [];
            foreach ($category_filter as $cat_list) {
                array_push($catId, $cat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->latest()->paginate(10);
            // dd($products);
        }
        //  end category wish product filter //

        // start brand wish product filter //
        if ($request->get('filterbrand')) {

            $checked = $_GET['filterbrand'];
            // dd($checked);
            // filter With name start
            $brand_filter = Brand::whereIn('brand_name_en', $checked)->get();
            $brandId = [];
            foreach ($brand_filter as $brand_list) {
                array_push($brandId, $brand_list->id);
            }
            // filter With name end

            $products = Product::whereIn('brand_id', $brandId)->where('status', 1)->latest()->paginate(10);
            // dd($products);
        }
        //  end brand wish product filter //



        $filter_categories = Category::orderBy('category_name_en', 'ASC')->get();

        $filter_brands = Brand::orderBy('brand_name_en', 'ASC')->get();

        return view('frontend.product.category_view', compact('products', 'category', 'filter_categories', 'filter_brands'));
    } // end method
    /* ========== End CatWiseProduct Method ======== */

    /* ========== Start SubCatWiseProduct Method ======== */
    public function SubCatWiseProduct(Request $request, $slug)
    {

        $subcategory = Subcategory::where('slug', $slug)->first();
        $products = Product::where('status', '=', 1)->where('subcategory_id', $subcategory->id)->orderBy('id', 'DESC')->paginate(10);

        // start subcategory wish product filter //
        if ($request->get('filtersubcategory')) {

            $checked = $_GET['filtersubcategory'];
            // filter With name start
            $subcategory_filter = Subcategory::whereIn('subcategory_name_en', $checked)->get();
            $subcatId = [];
            foreach ($subcategory_filter as $subcat_list) {
                array_push($subcatId, $subcat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('subcategory_id', $subcatId)->where('status', 1)->latest()->paginate(10);
            // dd($products);
        }
        //  end subcategory wish product filter //

        // start brand wish product filter //
        if ($request->get('filterbrand')) {

            $checked = $_GET['filterbrand'];
            // filter With name start
            $brand_filter = Brand::whereIn('brand_name_en', $checked)->get();
            $brandId = [];
            foreach ($brand_filter as $brand_list) {
                array_push($brandId, $brand_list->id);
            }
            // filter With name end

            $products = Product::whereIn('brand_id', $brandId)->where('status', 1)->latest()->paginate(10);
            // dd($products);
        }
        //  end brand wish product filter //

        $filter_subcategories = Subcategory::orderBy('subcategory_name_en', 'ASC')->get();

        $filter_brands = Brand::orderBy('brand_name_en', 'ASC')->get();

        return view('frontend.product.subcategory_view', compact('products', 'subcategory', 'filter_subcategories', 'filter_brands'));
    } // end method
    /* ========== End SubCatWiseProduct Method ======== */

    /* ========== Start ChildCatWiseProduct Method ======== */
    public function ChildCatWiseProduct(Request $request, $slug)
    {

        $subsubcategory = Subsubcategory::where('slug', $slug)->first();
        $products = Product::where('status', '=', 1)->where('subsubcategory_id', $subsubcategory->id)->orderBy('id', 'DESC')->paginate(10);

        // start ChildCatWiseProduct wish product filter //
        if ($request->get('filterchildcategory')) {

            $checked = $_GET['filterchildcategory'];
            // filter With name start
            $subsubcategory_filter = Subsubcategory::whereIn('sub_subcategory_name_en', $checked)->get();
            $subsubcatId = [];
            foreach ($subsubcategory_filter as $subsubcat_list) {
                array_push($subsubcatId, $subsubcat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('subsubcategory_id', $subsubcatId)->where('status', 1)->latest()->paginate(10);
            // dd($products);
        }
        //  end ChildCatWiseProduct wish product filter //

        // start brand wish product filter //
        if ($request->get('filterbrand')) {

            $checked = $_GET['filterbrand'];
            // filter With name start
            $brand_filter = Brand::whereIn('brand_name_en', $checked)->get();
            $brandId = [];
            foreach ($brand_filter as $brand_list) {
                array_push($brandId, $brand_list->id);
            }
            // filter With name end

            $products = Product::whereIn('brand_id', $brandId)->where('status', 1)->latest()->paginate(10);
            // dd($products);
        }
        //  end brand wish product filter //

        $filter_subsubcategories = Subsubcategory::orderBy('sub_subcategory_name_en', 'ASC')->get();

        $filter_brands = Brand::orderBy('brand_name_en', 'ASC')->get();

        return view('frontend.product.childcategory_view', compact('products', 'subsubcategory', 'filter_subsubcategories', 'filter_brands'));
    } // end method
    /* ========== End ChildCatWiseProduct Method ======== */

    /* ================= Start Product Search =================== */
    public function ProductSearch(Request $request)
    {

        $request->validate(["search" => "required"]);

        $item = $request->search;
        $category_id = $request->searchCategory;
        // echo "$item";

        if ($category_id == 0) {
            $products = Product::where('name_en', 'LIKE', "%$item%")->where(
                'status',
                1
            )->paginate(10);
        } else {
            $products = Product::where('name_en', 'LIKE', "%$item%")->where('category_id', $category_id)->where(
                'status',
                1
            )->paginate(10);
        }


        return view('frontend.product.search', compact('products'));
    } // end method

    /* ================= End Product Search =================== */

    /* ================= Start Advance Product Search =================== */
    public function advanceProduct(Request $request)
    {

        // return $request;

        $request->validate(["search" => "required"]);

        $item = $request->search;
        $category_id = $request->category;
        // echo "$item";

        if ($category_id == 0) {
            $products = Product::where('name_en', 'LIKE', "%$item%")->where(
                'status',
                1
            )->paginate(10);
        } else {
            $products = Product::where('name_en', 'LIKE', "%$item%")->where('category_id', $category_id)->where(
                'status',
                1
            )->paginate(10);
        }


        return view('frontend.product.advance_search', compact('products'));
    } // end method

    /* ================= End Advance Product Search =================== */

    /* ================= Start productViewAll  =================== */
    public function productViewAll(Request $request)
    {

        $products = Product::where('status', 1)->orderBy('id', 'DESC')->paginate(10);

        // start category wish product filter //
        if ($request->get('filtercategory')) {

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('category_name_en', $checked)->get();
            $catId = [];
            foreach ($category_filter as $cat_list) {
                array_push($catId, $cat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->latest()->paginate(10);
            // dd($products);
        }
        //  end category wish product filter //

        // start brand wish product filter //
        if ($request->get('filterbrand')) {

            $checked = $_GET['filterbrand'];
            // dd($checked);
            // filter With name start
            $brand_filter = Brand::whereIn('brand_name_en', $checked)->get();
            $brandId = [];
            foreach ($brand_filter as $brand_list) {
                array_push($brandId, $brand_list->id);
            }
            // filter With name end

            $products = Product::whereIn('brand_id', $brandId)->where('status', 1)->latest()->paginate(10);
            // dd($products);
        }
        //  end brand wish product filter //



        $filter_categories = Category::orderBy('category_name_en', 'ASC')->get();

        $filter_brands = Brand::orderBy('brand_name_en', 'ASC')->get();

        return view('frontend.product.all_product', compact('products', 'filter_categories', 'filter_brands'));
    } // end method

    /* ================= End productViewAll  =================== */

    /*=================== Start pageAbout Methoed ===================*/
    public function pageAbout($slug)
    {
        $page = Pages::where('slug', $slug)->first();
        return view('frontend.page.index', compact('page'));
    } // end method
    /*=================== end pageAbout Methoed ===================*/

    /*=================== Start pageAbout Methoed ===================*/
    public function pageBlog($slug)
    {
        $blog = Blog::where('blog_slug_en', $slug)->first();
        return view('frontend.blog.index', compact('blog'));
    } // end method
    /*=================== end pageAbout Methoed ===================*/

    /*=================== Start SubsStore Methoed ===================*/
    public function SubsStore(Request $request)
    {
        $subscriber = Subscribe::where('email', $request->email)->first();
        if ($subscriber == null) {
            $subscriber = new Subscribe;
            $subscriber->email = $request->email;
            $subscriber->created_at = Carbon::now();
            $subscriber->save();


            $notification = array(
                'message' => 'You have subscribed successfully.',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {

            $notification = array(
                'message' => 'You are  already a subscriber.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    /*=================== End SubsStore Methoed ===================*/
}