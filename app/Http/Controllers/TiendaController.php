<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Deporte;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Publicidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



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
                    if (!preg_match('/^[3|4|5]/', $value)) {
                        $fail('Número de tarjeta inválido.');
                    }
                },
            ],
            'cardName' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
                'min:4',
                'max:50',
            ],
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
            'cardName.required' => 'El nombre en la tarjeta es obligatorio.',
            'cardName.regex' => 'El nombre en la tarjeta solo puede contener letras y espacios.',
            'cardName.min' => 'El nombre en la tarjeta debe tener al menos 4 caracteres.',
            'cardName.max' => 'El nombre en la tarjeta no puede exceder los 50 caracteres.'
        ]);

        // Calcular el total
        $cart = session()->get('carrito');
        $totalPrice = array_reduce($cart, fn($total, $item) => $total + ($item['price'] * $item['quantity']), 0);

        DB::beginTransaction();
        $compra = Compra::create([
            'total' => $totalPrice,
            'fecha' => now(),
            'user_id' => Auth::id(),
        ]);
        foreach ($cart as $item) {
            $compra->articulos()->attach($item['id'], [
                'cantidad' => $item['quantity'],
                'precio_unitario' => $item['price'],
            ]);

            // Verificar y descontar stock
            $articulo = Articulo::find($item['id']);
            if ($articulo->calzados()->exists()) {
                // Descuento en `articulo_calzado`
                $articulo->calzados()->updateExistingPivot($item['calzadoTalle_id'], [
                    'stocks' => DB::raw('stocks - ' . $item['quantity'])
                ]);
            } elseif ($articulo->talles()->exists()) {
                // Descuento en `articulo_talle`
                $articulo->talles()->updateExistingPivot($item['calzadoTalle_id'], [
                    'stocks' => DB::raw('stocks - ' . $item['quantity'])
                ]);
            } else {
                // Descuento en `articulos`
                $articulo->decrement('stock', $item['quantity']);
            }
        }

        DB::commit();
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

        // Verificar si el usuario es administrador
        if (Auth::user()->administrator) {
            // Si es administrador, mostrar todas las compras
            $compras = Compra::with('articulos')->orderByDesc('id')->get();

            // Con paginacion
            // $compras = Compra::with('articulos')->orderByDesc('id')->paginate(5);

        } else {
            // Si no es administrador, mostrar solo las compras del usuario autenticado
            $compras = Compra::where('user_id', Auth::id())
                ->with('articulos')
                ->orderByDesc('id')
                ->get();
        }

        return view('users.comprasRealizadas', compact('compras'));
    }

    public function entregarCompra($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->estado = 'Entregado';
        $compra->save();
    
        return redirect()->back()->with('success', 'La compra ha sido marcada como Entregada.');
    }
    
    public function cancelarCompra($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->estado = 'Cancelado';
        $compra->save();
    
        return redirect()->back()->with('success', 'La compra ha sido cancelada.');
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
