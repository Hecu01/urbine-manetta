<?php

namespace App\Http\Controllers;

use App\Models\Deporte;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class tiendaController extends Controller
{
    // usuario
    public function mi_perfil(){
        $title = "Sportivo - Perfil";
        $user = Auth::user();
        return view('users.mi_perfil', compact('title', 'user'));
    }
    // Página index
    public function home(){
        $title = "Sportivo - Inicio";


        return view('index', compact( 'title'));
    }
    public function pago(){
        $title = "Métodos de pago";
        return view('orders.payment', compact('title'));
    }
    public function hombres(){
        $title = "Sportivo - hombres";
        $articulo = Articulo::where('genero', 'M')->get();
        return view('hombres', compact('title', 'articulo'));
    }


    // Función para agregar un producto al carrito
    public function addToCart(Request $request)
    {
        $product_id = $request->product_id; // Obtén el ID del producto desde la solicitud
        $product = articulo::find($product_id); // Encuentra el producto en la base de datos

        if (!$product) {
            return back()->with('error', 'Producto no encontrado');
        }

        // Agrega el producto al carrito
        $cart = Session::get('cart');
        if (!$cart) {
            $cart = [
                $product_id => [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $product->price,
                ]
            ];
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Producto agregado al carrito');
        }

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity']++;
        } else {
            $cart[$product_id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    // Función para eliminar un producto del carrito
    public function removeFromCart($product_id)
    {
        $cart = Session::get('cart');

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Producto eliminado del carrito');
        }

        return redirect()->back()->with('error', 'Producto no encontrado en el carrito');
    }
}
