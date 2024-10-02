<?php

namespace App\Http\Controllers;

use App\Models\Deporte;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Publicidad;

class tiendaController extends Controller
{

    // Página index
    public function home(){
        $title = "Sportivo - Inicio";

        // Para obtener las publicidades
        $publicidades = Publicidad::all(); 


        return view('index', compact( 'title','publicidades'));
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

    public function domicilio(){
        if(Auth::check()){
            // Obtener el usuario actualmente autenticado
            $user = Auth::user();

            // Verificar si el usuario ya ha proporcionado sus datos de domicilio
            if ($user->domicilio()) { // Suponiendo que tengas una relación o método para verificar si el usuario tiene una dirección
                // Redirigir al usuario a una página diferente, como su perfil o algún otro lugar
                return redirect()->back();
            }

        }
        return view('users.AddAddress');
    }

    public function agregar_domicilio(Request $request){
        // Crear o actualizar la dirección del usuario
        $domicilio = Domicilio::updateOrCreate([
            'user_id' => auth()->user()->id,
            'calle' => $request->calle, 
            'barrio' => $request->barrio, 
            'departamento' => $request->dpto, 
            'piso' => $request->piso, 
            'ciudad' => $request->distrito, 
            'codigo_postal' => $request->cod_postal 
        ]);
        
        return redirect()->back()->with('mensaje', 'Dirección guardada exitosamente.');
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
