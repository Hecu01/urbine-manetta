<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade;
use MercadoPago\Preference;
use MercadoPago\Item;

class CarritoController extends Controller
{
    // Mostrar el carrito
    public function mi_carrito()
    {
        // Recupera el carrito de la sesión
        $carrito = session()->get('carrito', []);
        $totalPrice = 0;
        
        // Convierte el carrito en una colección para ser compatible con darryldecode/cart
        $cartItems = collect($carrito);

        foreach ($cartItems as $item){
            // $totalPrice += $item['price'];
            $totalPrice += $item['price'];

        }

        // Retornar la vista con el contenido del carrito
        return view('users.MiCarrito', compact('cartItems', 'totalPrice'));
    }

    // Método para añadir un producto al carrito
    public function añadirAlCarrito(Request $request)
    {

        
        // Verificar si el usuario tiene una dirección
        if (!$request->user()->domicilio) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Por favor, proporciona tu dirección antes de agregar al carrito.'], 400);
            }
            return redirect()->route('domicilio')->with('mensaje', 'Por favor, proporciona tu dirección antes de agregar al carrito.');
        }

        $productoId = $request->input('producto_id');
        $nombre = $request->input('nombre');
        $precio = $request->input('precio');
        $imagen = $request->input('imagen');
        $cantidad = $request->input('cantidad', 1);
        $descuento = $request->input('descuento', 0);
        $calzadoTalle = $request->input('calzadoTalle', null);

        $precioFinal = $precio * $cantidad;

        // Recupera el carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Añade el producto al carrito
        $carrito[] = [
            'id' => $productoId,
            'name' => $nombre,
            'price' => $precioFinal,
            'quantity' => $cantidad,
            'imagen' => $imagen,
            'discount' => $descuento,
            'calzadoTalle' => $calzadoTalle,
        ];

        // Guarda el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        // Respuesta para peticiones AJAX
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Producto añadido al carrito exitosamente',
                'carrito' => $carrito,
            ]);
        }


    }

    public function remove($id)
    {
        $carrito = session()->get('carrito', []);

        // Buscar el producto en el carrito y eliminarlo
        foreach ($carrito as $key => $item) {
            if ($item['id'] == $id) {
                unset($carrito[$key]); // Eliminar el producto del carrito
                session()->put('carrito', $carrito); // Actualizar la sesión con el nuevo carrito
                break; // Terminar el bucle al encontrar el producto
            }
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
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