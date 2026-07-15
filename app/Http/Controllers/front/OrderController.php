<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class OrderController extends Controller
{
    /**
     * Menampilkan Halaman Checkout
     */
    public function createTransaction(Request $request, $order_id = null)
    {
        $customerId = Auth::guard('customer')->id() ?? 1;

        $addresses = DB::table('customer_addresses')->where('customer_id', $customerId)->get();
        $shippings = DB::table('shippings')->where('status', 'active')->get();

        $paymentMethods  = DB::table('payment_methods')->where('status', 'active')->get();
        $paymentChannels = DB::table('payment_channels')->where('status', 'active')->get();

        $checkoutItems = [];
        $subtotal = 0;

        if ($request->has('items_to_buy')) {
            $itemIds = explode(',', $request->get('items_to_buy'));
            $cartItems = \App\Models\CartItem::whereIn('id', $itemIds)->get();

            foreach ($cartItems as $item) {
                $productId    = $item->product_id ?? ($item->PRODUCT_ID ?? null);
                $bundleId     = $item->bundle_id ?? ($item->BUNDLE_ID ?? null);
                $itemQuantity = $item->quantity ?? ($item->QUANTITY ?? 1);

                if (!empty($bundleId)) {
                    $bundle = DB::table('product_bundles')->where('id', $bundleId)->first();
                    if ($bundle) {
                        $bundlePrice = $bundle->price ?? ($bundle->PRICE ?? 0);
                        $bundleName  = $bundle->name ?? ($bundle->NAME ?? 'Exclusive Bundle');
                        $bundleImage = $bundle->image ?? ($bundle->IMAGE ?? null);
                        $realBundleId = $bundle->id ?? ($bundle->ID ?? null);

                        $itemSubtotal = $bundlePrice * $itemQuantity;
                        $subtotal += $itemSubtotal;

                        $checkoutItems[] = [
                            'product_id'     => null,
                            'bundle_id'      => $realBundleId,
                            'name'           => $bundleName,
                            'featured_image' => $bundleImage,
                            'quantity'       => $itemQuantity,
                            'price'          => $bundlePrice,
                            'subtotal'       => $itemSubtotal
                        ];
                    }
                } elseif (!empty($productId)) {
                    $product = DB::table('products')->where('id', $productId)->first();
                    if ($product) {
                        $productPrice = $product->price ?? ($product->PRICE ?? 0);
                        $productName  = $product->name ?? ($product->NAME ?? 'Premium Scent');
                        $productImage = $product->featured_image ?? ($product->FEATURED_IMAGE ?? null);
                        $realProductId = $product->id ?? ($product->ID ?? null);

                        $itemSubtotal = $productPrice * $itemQuantity;
                        $subtotal += $itemSubtotal;
                        
                        $checkoutItems[] = [
                            'product_id'     => $realProductId,
                            'bundle_id'      => null,
                            'name'           => $productName,
                            'featured_image' => $productImage,
                            'quantity'       => $itemQuantity,
                            'price'          => $productPrice,
                            'subtotal'       => $itemSubtotal
                        ];
                    }
                }
            }
        } 
        elseif ($request->has('pid')) {
            $product = DB::table('products')->where('id', $request->pid)->first();

            if (!$product) {
                return redirect()->route('front.shop')->with('error', 'Produk tidak ditemukan.');
            }

            $productPrice = $product->price ?? ($product->PRICE ?? 0);
            $productName = $product->name ?? ($product->NAME ?? 'Premium Scent');
            $productImage = $product->featured_image ?? ($product->FEATURED_IMAGE ?? null);
            $realProductId = $product->id ?? ($product->ID ?? null);

            $qty = $request->qty ?? 1;
            $subtotal = $productPrice * $qty;

            $checkoutItems[] = [
                'product_id'     => $realProductId,
                'bundle_id'      => null,
                'name'           => $productName,
                'featured_image' => $productImage,
                'quantity'       => $qty,
                'price'          => $productPrice,
                'subtotal'       => $subtotal
            ];
        } else {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk checkout.');
        }

        return view('front.transaction.create', compact(
            'order_id', 'checkoutItems', 'subtotal', 'shippings', 'addresses', 'paymentMethods', 'paymentChannels'
        ));
    }

    /**
     * Menyimpan Data Transaksi
     */
    public function storeTransaction(Request $request, $order_id = null)
    {
        $request->validate([
            'shipping_address'   => 'required|string',
            'shipping_id'        => 'required',
            'payment_method_id'  => 'required',
            'items'              => 'required|array', 
            'items.*.quantity'   => 'required|integer|min:1',
            'subtotal'           => 'required|numeric',
        ]);

        $customerId = Auth::guard('customer')->id() ?? 1;

        $shipping = DB::table('shippings')->where('id', $request->shipping_id)->first();
        if (!$shipping) {
            return redirect()->back()->with('error', 'Metode pengiriman tidak valid.');
        }

        $shippingCost  = $shipping->cost ?? ($shipping->COST ?? 0);
        $shippingRealId = $shipping->id ?? ($shipping->ID ?? null);
        $grandTotal    = $request->subtotal + $shippingCost;
        
        $insertedOrderId = rand(10000000, 99999999);
        $orderNumber   = 'HN-' . date('Ymd') . strtoupper(bin2hex(random_bytes(2)));

        DB::beginTransaction();

        try {
            DB::table('orders')->insert([
                'id'                 => $insertedOrderId,
                'customer_id'        => $customerId,
                'shipping_id'        => $shippingRealId,
                'payment_method_id'  => $request->payment_method_id,
                'payment_channel_id' => $request->payment_channel_id,
                'order_number'       => $orderNumber,
                'total_price'        => $request->subtotal,
                'shipping_cost'      => $shippingCost,
                'grand_total'        => $grandTotal,
                'status'             => 'menunggu_pembayaran',
                'shipping_address'   => $request->shipping_address,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);

            $userCart = \App\Models\Cart::where('user_id', $customerId)->first();

            foreach ($request->items as $item) {
                $priceAtPurchase = 0;

                if (!empty($item['bundle_id'])) {
                    $bundle = DB::table('product_bundles')->where('id', $item['bundle_id'])->first();
                    $priceAtPurchase = $bundle->price ?? ($bundle->PRICE ?? 0);

                    DB::table('orders_items')->insert([
                        'id'                => rand(10000000, 99999999),
                        'order_id'          => $insertedOrderId,
                        'product_id'        => $item['bundle_id'],
                        'quantity'          => $item['quantity'],
                        'price_at_purchase' => $priceAtPurchase, 
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ]);
                } else {
                    $product = DB::table('products')->where('id', $item['product_id'])->first();
                    $priceAtPurchase = $product->price ?? ($product->PRICE ?? 0);

                    DB::table('orders_items')->insert([
                        'id'                => rand(10000000, 99999999),
                        'order_id'          => $insertedOrderId,
                        'product_id'        => $item['product_id'],
                        'quantity'          => $item['quantity'],
                        'price_at_purchase' => $priceAtPurchase, 
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ]);
                }

                if ($userCart) {
                    \App\Models\CartItem::where('cart_id', $userCart->id)
                        ->where(function($q) use ($item) {
                            $q->where('product_id', $item['product_id'] ?? null)
                              ->orWhere('bundle_id', $item['bundle_id'] ?? null);
                        })->delete();
                }
            }

            DB::commit();
            return redirect()->route('front.transaction.awaiting_payment', ['id' => $insertedOrderId])
                             ->with('success', 'Pesanan Anda berhasil terdaftar.');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan Invoice Sukses (FIXED: Ditambahkan select payment_methods.code)
     */
    public function checkoutSuccess($id) {
        $customerId = Auth::guard('customer')->id() ?? 1;
        
        $order = DB::table('orders')
            ->join('payment_methods', 'orders.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_channels', 'orders.payment_channel_id', '=', 'payment_channels.id')
            ->where('orders.id', $id)
            ->select(
                'orders.id as id', 
                'orders.order_number as order_number', 
                'orders.grand_total as grand_total', 
                'orders.shipping_cost as shipping_cost', 
                'orders.total_price as total_price', 
                'orders.status as status', 
                'orders.shipping_address as shipping_address', 
                'payment_methods.name as method_name', 
                'payment_methods.code as method_code', // <-- BERHASIL DITAMBAHKAN AGAR VIEW TIDAK CRASH
                'payment_channels.name as channel_name', 
                'payment_channels.account_number as account_number', 
                'payment_channels.account_name as account_name'
            )->first();

        if (!$order) return redirect()->route('front.home')->with('error', 'Invoice tidak ditemukan.');

        $rawItems = DB::table('orders_items')->where('order_id', $id)->get();
        $orderItems = [];

        foreach($rawItems as $item) {
            $pId = $item->product_id ?? ($item->PRODUCT_ID ?? null);
            $qty = $item->quantity ?? ($item->QUANTITY ?? 1);
            $price = $item->price_at_purchase ?? ($item->PRICE_AT_PURCHASE ?? 0);

            $bundle = DB::table('product_bundles')->where('id', $pId)->first();
            if($bundle) {
                $orderItems[] = (object)[
                    'quantity' => $qty,
                    'price_at_purchase' => $price,
                    'product_name' => $bundle->name ?? ($bundle->NAME ?? 'Premium Bundle'),
                    'featured_image' => $bundle->image ?? ($bundle->IMAGE ?? 'default.jpg'),
                    'is_bundle' => true
                ];
            } else {
                $product = DB::table('products')->where('id', $pId)->first();
                $orderItems[] = (object)[
                    'quantity' => $qty,
                    'price_at_purchase' => $price,
                    'product_name' => $product->name ?? ($product->NAME ?? 'Premium Product'),
                    'featured_image' => $product->featured_image ?? ($product->FEATURED_IMAGE ?? 'default.jpg'),
                    'is_bundle' => false
                ];
            }
        }

        return view('front.transaction.awaitingpayment', compact('order', 'orderItems'));
    }

    public function confirmPaymentSimulator($id) {
        DB::table('orders')->where('id', $id)->update(['status' => 'sudah_dibayar', 'updated_at' => now()]);
        return redirect()->route('front.transaction.awaiting_payment', ['id' => $id])->with('success', 'Simulasi transfer berhasil!');
    }

    public function indexPayment() {
        $customerId = Auth::guard('customer')->id() ?? 1;
        $payments = DB::table('orders')->join('payment_methods', 'orders.payment_method_id', '=', 'payment_methods.id')->where('orders.customer_id', $customerId)->select('orders.id as id', 'orders.order_number as order_number', 'orders.grand_total as amount', 'orders.status as status', 'payment_methods.name as payment_channel', 'orders.created_at as created_at')->orderBy('orders.created_at', 'desc')->get();
        return view('front.payment.index', compact('payments'));
    }

    public function createPayment($order_id) {
        $customerId = Auth::guard('customer')->id() ?? 1;
        $payment = DB::table('orders')->join('payment_methods', 'orders.payment_method_id', '=', 'payment_methods.id')->where('orders.id', $order_id)->where('orders.customer_id', $customerId)->select('orders.id as id', 'orders.order_number as order_number', 'orders.grand_total as amount', 'orders.status as status', 'payment_methods.name as payment_channel')->first();
        if (!$payment) {
            $payment = DB::table('orders')->join('payment_methods', 'orders.payment_method_id', '=', 'payment_methods.id')->where('orders.customer_id', $customerId)->select('orders.id as id', 'orders.order_number as order_number', 'orders.grand_total as amount', 'orders.status as status', 'payment_methods.name as payment_channel')->orderBy('orders.created_at', 'desc')->first();
        }
        return view('front.payment.create', compact('payment'));
    }

    public function confirmPaymentFromProfile($id) {
        DB::table('orders')->where('id', $id)->update(['status' => 'sudah_dibayar', 'updated_at' => now()]);
        return redirect()->route('front.payment.index')->with('success', 'Pembayaran berhasil!');
    }
}