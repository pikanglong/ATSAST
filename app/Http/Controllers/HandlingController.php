<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\ItemModel;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Auth;

class HandlingController extends Controller
{
    public function index(){
        $itemModel = new ItemModel();
        $items = $itemModel->getItems();
        $paginator = $items['paginator'];
        $list = $items['list'];
        return view('handling.index',[
            'page_title'=>"借还",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Handling",
            'paginator'=>$paginator,
            'list'=>$list,
        ]);
    }

    public function publish(){
        if(!Auth::user()->vip){
            return redirect(request()->ATSAST_DOMAIN.route('handling.index',null,false));
        }
        return view('handling.publish',[
            'page_title'=>"发布物品",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Handling"
        ]);
    }

    public function cart(){
        $cartmodel = new CartModel();
        $cart_items = $cartmodel->list(Auth::user()->id);
        return view('handling.cart',[
            'page_title'=>"购物车",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Handling",
            'cart_items'=>$cart_items
        ]);
    }

    public function detail($itemId){
        $itemModel = new ItemModel();
        $item_info = $itemModel->detail($itemId);
        if(empty($item_info)) return redirect(request()->ATSAST_DOMAIN.route('handling.index',null,false));
        return view('handling.detail',[
            'page_title'=>"物品详情",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Handling",
            'item_info'=>$item_info
        ]);
    }

    public function order(){
        $ordermodel = new OrderModel();
        $ret = $ordermodel->list(Auth::user()->id);
        $paginator = $ret['paginator'];
        $list = $ret['list'];
        return view('handling.order',[
            'page_title'=>"我的订单",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Handling",
            'paginator'=>$paginator,
            'orders'=>$list,
        ]);
    }

    public function orderCreate(Request $request){
        $itemModel = new ItemModel();
        $cartModel = new CartModel();
        //区分购物车结算和立即借用结算
        if($request->has('item')){
            $total_count = 0;
            foreach($request->item as $i){
                $item = $itemModel->detail($i);
                $item->order_count_=$cartModel->getCount($i,Auth::id());
                $items[]=$item;
                $total_count += $item->order_count_;
            }
            $total_item = count($request->item);
        }else{
            $item = $itemModel->detail($request->iid);
            $item->order_count_=$request->count;
            $items[]=$item;
            $total_item = 1;
            $total_count = $request->count;
        }

        return view('handling.order_create',[
            'page_title'=>"创建订单",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Handling",
            'items'=>$items,
            'total_item' => $total_item,
            'total_count' => $total_count
        ]);
    }

    public function orderDetail($orderId){
        return view('handling.order_detail',[
            'page_title'=>"订单详情",
            'site_title'=>"SAST教学辅助平台",
            'navigation'=>"Handling"
        ]);
    }
}
