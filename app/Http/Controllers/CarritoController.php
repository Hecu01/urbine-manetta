<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade;

class CarritoController extends Controller
{
    // Mostrar el carrito
    public function mi_carrito()
    {
        // Recupera el carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Convierte el carrito en una colección para ser compatible con darryldecode/cart
        $cartItems = collect($carrito);

        // Retornar la vista con el contenido del carrito
        return view('carrito', ['cartItems' => $cartItems]);
    }

    // Método para añadir un producto al carrito
    public function añadirAlCarrito(Request $request)
    {
        $productoId = $request->input('producto_id');
        $nombre = $request->input('nombre');
        $precio = $request->input('precio');
        $imagen = $request->input('imagen');
        $cantidad = $request->input('cantidad', 1);

        // Recupera el carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Añade el producto al carrito
        $carrito[] = [
            'id' => $productoId,
            'name' => $nombre,
            'price' => $precio,
            'quantity' => $cantidad,
            'imagen' => $imagen,
        ];

        // Guarda el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        // Redirigir a la página del carrito
        return redirect()->route('carrito.index');
    }

    // public function finalizarCompra(){
    //     $client = new PreferenceClient();
    //     $preference = $client->create([
    //         "external_reference" => "teste",
    //         "items"=> array(
    //             array(
    //             "id" => "4567",
    //             "title" => "Dummy Title",
    //             "description" => "Dummy description",
    //             "picture_url" => "http://www.myapp.com/myimage.jpg",
    //             "category_id" => "eletronico",
    //             "quantity" => 1,
    //             "currency_id" => "BRL",
    //             "unit_price" => 100
    //             )
    //         ),
    //         "payment_methods" => [
    //         "default_payment_method_id" => "master",
    //         "excluded_payment_types" => array(
    //             array(
    //             "id" => "ticket"
    //             )
    //         ),
    //         "installments"  => 12,
    //         "default_installments" => 1
    //         ]
    //     ]);
    // }
}
