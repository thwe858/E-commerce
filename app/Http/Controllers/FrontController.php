<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class FrontController extends Controller
{
    public function shop()//shop from Route behind the class:: shop
    {
        $items=Item::OrderBy('id','DESC')->paginate(8);
       // var_dump($items);
        return view('front.shops', compact('items')) ;//shops from ->fonts/shops.blade.php

    }
    public function shopItem($id){
        $item=Item::find($id);
        $category_id=$item->category_id;
        $related_items=Item::where('category_id',$category_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();
        
        return view('front.shop-item',compact('item','related_items'));
    }
    public function carts(){
        $payments=Payment::all();
        return view('front.carts',compact('payments'));
    }
    public function orderNow(Request $request){
    //  dd($request);
      
      $dataArray=json_decode($request->orderItems,true);//json_decode is convert to array
      $voucher_no=time();
      $file_name=time().'.'.$request->payment_slip->extension();
      $upload=$request->payment_slip->move(public_path('images/payment-slips/'),$file_name);
      //$data is come from localstorage
      //$request is input data from Form
      //dd($dataArray);
      foreach($dataArray as $data){
       // dd($data['qty']);
        $order =new Order();
        $order->voucher_no=$voucher_no;
        $order->total=intval($data['qty'])*($data['price']-($data['price']*($data['discount']/100)));
        $order->qty=$data['qty'];
        $order->payment_slip = '/images/payment-slips/'.$file_name;
        $order->status='Pending';
      
      $order->address = $request->address;
        $order->item_id=$data['id'];
        $order->payment_id = $request->payment_method;
        $order->user_id=Auth::id();
        $order->save();
      }
      return 'Your order Successful';
    }
    public function itemCategory($category_id){
        $items=Item::where('category_id',$category_id)->orderBy('id','DESC')->paginate(8);
        return view('front.item-category',compact('items'));
    }

}   