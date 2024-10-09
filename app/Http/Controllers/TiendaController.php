<?php

namespace App\Http\Controllers;

use App\Models\Deporte;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Publicidad;
use App\Models\Compra;



class TiendaController extends Controller
{

    // Página index
    public function home()
    {
        $title = "Sportivo - Inicio";

        // Para obtener las publicidades
        $publicidades = Publicidad::all();


        return view('index', compact('title', 'publicidades'));
    }

    // public function pago(){
    //     $title = "Métodos de pago";
    //     return view('orders.payment', compact('title'));
    // }

    public function pago()
    {
        $title = "Métodos de pago";
        return view('orders.pago', compact('title'));
    }

    public function processPayment(Request $request)
    {
        // Validación
        $request->validate([
            'cardNumber' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Eliminar los espacios en blanco
                    $value = str_replace(' ', '', $value);

                    // Verificar si el número tiene 16 dígitos
                    if (strlen($value) != 16) {
                        $fail('El número de tarjeta debe tener 16 dígitos.');
                    }

                    // Verificar si empieza con 4 o 5
                    if (!preg_match('/^[4|5]/', $value)) {
                        $fail('Número de tarjeta inválido.');
                    }
                },
            ],
            'cardName' => 'required|string|max:20',
            'cardExpiryMonth' => 'required',
            'cardExpiryYear' => 'required',
            'cardCvv' => 'required|regex:/^\d{3}$/',
        ], [
            'cardNumber.required' => 'El número de tarjeta es obligatorio.',
            'cardName.required' => 'El nombre y apellido son obligatorios.',
            'cardExpiryMonth.required' => 'El mes de expiración es obligatorio.',
            'cardExpiryYear.required' => 'El año de expiración es obligatorio.',
            'cardCvv.required' => 'El CCV es obligatorio.',
            'cardCvv.regex' => 'El CCV debe tener 3 dígitos.',
        ]);

        // Calcular el total
        $cart = session()->get('carrito');
        $totalPrice = 0;

        if ($cart) {
            foreach ($cart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }

        // Guardar la compra por el id del usuario
        $compra = Compra::create([
            'total' => $totalPrice,
            'fecha' => now(),
            'user_id' => Auth::id(), 

            // dd(Auth::id())
        ]);

        // dd($compra);

        // Limpiar el carrito después de la compra
        session()->forget('carrito');

        return redirect()->route('home')->with('mensaje', 'Su compra ha sido realizada con éxito.');
    }

    public function mostrarPago()
    {
        return view('orders.pago');
    }

    public function comprasRealizadas()
{
    if (!Auth::check()) {
        return redirect()->route('home')->with('error', 'Por favor, inicie sesión para ver sus compras.');
    }

    // Obtener las compras del usuario autenticado junto con los artículos
    $compras = Compra::with('articulos')->where('user_id', Auth::id())->get();

    // Calcular el total de todas las compras (opcional si quieres mostrarlo)
    $totalPrice = $compras->sum('total'); // Sumar el total de todas las compras

    return view('users.comprasRealizadas', compact('compras', 'totalPrice'));
}




    public function hombres()
    {
        $title = "Sportivo - hombres";
        $articulo = Articulo::where('genero', 'M')->get();
        return view('hombres', compact('title', 'articulo'));
    }

    public function domicilio()
    {
        if (Auth::check()) {
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

    public function agregar_domicilio(Request $request)
    {
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
