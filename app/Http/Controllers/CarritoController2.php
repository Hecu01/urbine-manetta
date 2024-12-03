<?php

namespace App\Http\Controllers;

use App\Models\Talle;
use MercadoPago\Item;
use App\Models\Calzado;
use MercadoPago\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\Facades\CartFacade;

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
        dd(session()->get('carrito'));
        foreach ($cartItems as $item) {
            // $totalPrice += $item['price'];
            $totalPrice += $item['total_price'];
        }

        // Retornar la vista con el contenido del carrito
        return view('users.MiCarrito', compact('cartItems', 'totalPrice'));
    }

    // Método para añadir un producto al carrito 
    // con AJAX
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
        $cantidad = (int) $request->input('cantidad', 1);
        $descuento = $request->input('descuento', 0);
        $calzadoTalle = $request->input('calzadoTalle', null);


        // Verificar si el dato es numérico o alfabético
        if (is_numeric($calzadoTalle)) {
            // Si es numérico, buscar en la tabla `calzados`
            $calzado = Calzado::where('calzado', $calzadoTalle)->first();
            if ($calzado) {
                $calzadoTalle_id = $calzado->id;  // Guardar el ID del calzado
            } else {
                // Manejar el caso en que no se encuentra el calzado
                // Esto puede ser un error o un valor no válido
                $calzadoTalle_id = null;
            }
        } else {
            // Si no es numérico, buscar en la tabla `talles`
            $talle = Talle::where('talle_ropa', $calzadoTalle)->first();
            if ($talle) {
                $calzadoTalle_id = $talle->id;  // Guardar el ID del talle
            } else {
                // Manejar el caso en que no se encuentra el talle
                // Esto puede ser un error o un valor no válido
                $calzadoTalle_id = null;
            }
        }




        //         // Datos del producto que se agregará al carrito
        // $productoId = $request->input('producto_id');
        // $nombre = $request->input('nombre');
        // $precio = $request->input('precio');
        // $imagen = $request->input('imagen');
        // $cantidad = (int) $request->input('cantidad', 1);
        // $descuento = $request->input('descuento', 0);
        // $calzadoTalle = $request->input('calzadoTalle', null);

        // // Obtener o inicializar la sumatoria total de cantidad en la sesión
        // $totalCantidadCarrito = session()->get('totalCantidadCarrito', 0);

        // // Actualizar el ID del talle o calzado en función de si es numérico o alfabético
        // if (is_numeric($calzadoTalle)) {
        //     // Buscar en la tabla `calzados` si el dato es numérico
        //     $calzado = Calzado::where('calzado', $calzadoTalle)->first();
        //     $calzadoTalle_id = $calzado ? $calzado->id : null;
        // } else {
        //     // Buscar en la tabla `talles` si el dato no es numérico
        //     $talle = Talle::where('talle_ropa', $calzadoTalle)->first();
        //     $calzadoTalle_id = $talle ? $talle->id : null;
        // }

        // // Aquí puedes añadir el producto al carrito (estructura de carrito de ejemplo)
        // $carrito = session()->get('carrito', []);
        // $carrito[] = [
        //     'producto_id' => $productoId,
        //     'nombre' => $nombre,
        //     'precio' => $precio,
        //     'imagen' => $imagen,
        //     'cantidad' => $cantidad,
        //     'descuento' => $descuento,
        //     'calzadoTalle_id' => $calzadoTalle_id,
        // ];

        // // Actualizar la sumatoria total de cantidad
        // $totalCantidadCarrito += $cantidad;

        // // Guardar el carrito y la sumatoria total en la sesión
        // session()->put('carrito', $carrito);
        // session()->put('totalCantidadCarrito', $totalCantidadCarrito);

        // Ahora puedes usar $calzadoTalle_id en tu lógica

        $precioFinal = $precio * $cantidad;

        // Recupera el carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Añade el producto al carrito
        $carrito[] = [
            'id' => $productoId,
            'name' => $nombre,
            'price' => $precio,
            'total_price' => $precioFinal,
            'quantity' => $cantidad,
            'imagen' => $imagen,
            'discount' => $descuento,
            'calzadoTalle' => $calzadoTalle,
            'calzadoTalle_id' => $calzadoTalle_id,
        ];


        // Verifica si el producto ya existe en el carrito
        $existe = false;
        foreach ($carrito as &$item) {
            if ($item['id'] == $productoId) {
                $item['quantity'] += $cantidad; // Suma la cantidad
                $item['total_price'] = $item['quantity'] * $item['price']; // Actualiza el total
                $existe = true;
                break;
            }
        }

        // Si no existe, añade un nuevo producto
        if (!$existe) {
            $carrito[] = [
                'id' => $productoId,
                'name' => $nombre,
                'price' => $precio,
                'quantity' => $cantidad,
                'total_price' => $precioFinal,
                'imagen' => $imagen,
                'discount' => $descuento,
                'calzadoTalle' => $calzadoTalle,
                'calzadoTalle_id' => $calzadoTalle_id,
            ];
        }


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

    // Método para añadir un producto al carrito (vista por producto)
    // sin AJAX
    public function añadirAlCarrito2(Request $request)
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
        $cantidad = (int) $request->input('cantidad', 1);
        $descuento = $request->input('descuento', 0);
        $calzadoTalle = $request->input('calzadoTalle', null);


        // Verificar si el dato es numérico o alfabético
        if (is_numeric($calzadoTalle)) {
            // Si es numérico, buscar en la tabla `calzados`
            $calzado = Calzado::where('calzado', $calzadoTalle)->first();
            if ($calzado) {
                $calzadoTalle_id = $calzado->id;  // Guardar el ID del calzado
            } else {
                // Manejar el caso en que no se encuentra el calzado
                // Esto puede ser un error o un valor no válido
                $calzadoTalle_id = null;
            }
        } else {
            // Si no es numérico, buscar en la tabla `talles`
            $talle = Talle::where('talle_ropa', $calzadoTalle)->first();
            if ($talle) {
                $calzadoTalle_id = $talle->id;  // Guardar el ID del talle
            } else {
                // Manejar el caso en que no se encuentra el talle
                // Esto puede ser un error o un valor no válido
                $calzadoTalle_id = null;
            }
        }

        // Ahora puedes usar $calzadoTalle_id en tu lógica

        $precioFinal = $precio * $cantidad;

        // Recupera el carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Añade el producto al carrito
        $carrito[] = [
            'id' => $productoId,
            'name' => $nombre,
            'price' => $precio,
            'total_price' => $precioFinal,
            'quantity' => $cantidad,
            'imagen' => $imagen,
            'discount' => $descuento,
            'calzadoTalle' => $calzadoTalle,
            'calzadoTalle_id' => $calzadoTalle_id,
        ];

        // Verifica si el producto ya existe en el carrito
        $existe = false;
        foreach ($carrito as &$item) {
            if ($item['id'] == $productoId) {
                $item['quantity'] += $cantidad; // Suma la cantidad
                $item['total_price'] = $item['quantity'] * $item['price']; // Actualiza el total
                $existe = true;
                break;
            }
        }

        // Si no existe, añade un nuevo producto
        if (!$existe) {
            $carrito[] = [
                'id' => $productoId,
                'name' => $nombre,
                'price' => $precio,
                'quantity' => $cantidad,
                'total_price' => $precioFinal,
                'imagen' => $imagen,
                'discount' => $descuento,
                'calzadoTalle' => $calzadoTalle,
                'calzadoTalle_id' => $calzadoTalle_id,
            ];
        }

        // Guarda el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        // Después de agregar al carrito
        Session::flash('mensaje', true);

        return redirect()->back()->with('success', 'Producto añadido al carrito');
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
