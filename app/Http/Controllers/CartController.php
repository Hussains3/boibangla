<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;
use App\Models\Book;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;
use App\Models\CategoryBook;

class CartController extends Controller
{


    /**
     * This function add the books in cart
     * @param Request $createRequest
     * @return Json
     */
    public function createCart(Request $createRequest)
    {
        $getBookPrice = Book::select('regular_price','sale_price','book_slug')->where('id',$createRequest->bookId)->first();
        $book = [
            'id' => $createRequest->bookId,
            'name' => $createRequest->bookName,
            'price' => (($getBookPrice->sale_price?$getBookPrice->sale_price:$getBookPrice->regular_price)),
            'quantity' => $createRequest->bookQuantity,
            'attributes' => [
                'image' => $createRequest->bookImage,
                'url' => route('getBookDetail',['bookSlug' => $getBookPrice->book_slug])
            ],
        ];
        /**
         * Clear the cart conditions(coupons) if already coupon applied,
         * and someone tries to add book after that
         */
        \Cart::clearCartConditions();

        \Cart::add($book);
        return response()->json(['status'=>'success','message'=>'Book added to your cart !']);
    }

    /**
     * This function returns the books which are added in cart
     * @return Json
     */
    public function getCart()
    {
        $cart['items'] =  \Cart::getContent();
        $cart['items_count'] =   $cart['items']->count();
        $cart['sub_total'] = \Cart::getSubTotal();
        $cart['total'] = \Cart::getTotal();
        $cart['conditions'] = \Cart::getConditions();
        $cart['delivery_charge'] = Setting::getDeliveryCharge();
        return response()->json(['status'=>'success','data'=> $cart]);
    }

    /**
     * This function removed book from cart
     * @param Request $removeRequest
     * @return Json
     */
    public function removeCart(Request $removeRequest)
    {
        \Cart::remove($removeRequest->bookId);
        /**
         * Clear all coupon codes which were applied
         */
        \Cart::clearCartConditions();
        \Cart::clearItemConditions($removeRequest->bookId);
        $cart['items'] =  \Cart::getContent();
        return response()->json(['status'=>'success','message'=>'This Book removed from your cart !','data'=>$cart]);
    }

    /**
     * This function updates the cart quantity
     * @param Request $updateCart
     * @return Json
     */
    public function updateCart(Request $updateCart)
    {
        $newQty = (($updateCart->action == 'plus')?1:-1);
        \Cart::update($updateCart->bookId,[
            'quantity' => $newQty,
        ]);
        return response()->json(['status'=>'success','message'=>'Your cart has been updated']);
    }

    /**
     * This function applies the coupon code to cart books
     * @param Request $couponRequest
     * @return Json
     */
    public function applyCouponCode(Request $couponRequest)
    {
        $couponCode = $couponRequest->couponCode;
        $bookIdArray = [];
        $coupon = Discount::validateCouponCode($couponCode);

        if ($coupon){
            $couponToApplyOnCart = new CartCondition(array(
                'name' => $coupon->coupon_name,
                'type' => 'coupon',
                'target' => 'total',
                'value' => '-'.$coupon->discount.'%',
            ));
            $couponCategories = $coupon->categories;
            if ($couponCategories){
                $couponCategoriesArray = explode(',',$couponCategories);
                $cartItems = \Cart::getContent();
                $canBeApplied = false;
                foreach ($cartItems as $book){
                    $cartBookCategories = CategoryBook::where('book_id', $book->id)->pluck('category_id')->toArray();
                    foreach($cartBookCategories as $cartCategory){
                        if (in_array($cartCategory, $couponCategoriesArray)){
                            $canBeApplied = true;
                            break;
                        }else{
                            $canBeApplied = false;
                        }
                    }
                    //print_r($cartBookCategories);
                }
                //print_r($couponCategoriesArray);
               // echo $canBeApplied ? 'can be applied': 'can not be applied';
               // die;
               // $cartBookCategories = array_unique($cartBookCategories);

                if ($canBeApplied){
                    \Cart::condition($couponToApplyOnCart);
                    $response = response()->json(['status' => 'success','message'=>'Coupon Code applied successfully']);
                }else{
                    $response = response()->json(['status' => 'error','message'=>'Coupon Code can not be applied on these category books']);
                }
            }else{
                /**
                 * If coupon code does not belong to any category, then apply it whole cart
                 */
                \Cart::condition($couponToApplyOnCart);
                $response = response()->json(['status' => 'success','message'=>'Coupon Code applied successfully']);
            }
        }else{
            $response = response()->json(['status' => 'error','message'=>'Sorry,Coupon is not valid or expired']);
        }
        return $response;
    }

    /**
     * This function checks if customer is logged or not
     * Otherwise user can't jump to checkout page
     * @return json
     */
    public function proceedToCheckout()
    {
        if (Auth::check()){
            $response = response()->json(['status' => 'loggedin']);
        }else{
            $response = response()->json(['status' => 'error','message' => 'You must be login to proceed']);
        }
        return $response;
    }
}
