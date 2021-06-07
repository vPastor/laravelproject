<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CompraRequest;
use App\Http\Requests\UserRequest;

class CompraController extends Controller
{

    public function main()
    {
        /*Recuerda el estado de la compra y redirige a la pantalla en la que el usuario estaba antes: resumen, envio o confirmar */
        return redirect(session()->get('status'));
    }
    /**
     * Method to show the resume of the products in the chart
     */
    public function resumen()
    {
        //Dummy: hay que cambiar la info por la información guardada en el carrito (session)
        $products = [
            session()->get('products')
        ];
        return view('compra/resumen')
            ->with('products', $products);
    }

    /**
     * Method to show and process the shipping form (envio)
     */
    public function envio()
    {
        session()->put('status', url()->current);
        return view('compra/envio');

    }
    /**
     * Method to show and process the shipping form (envio)
     */
    public function verificarEnvio(UserRequest $request)
    {
        $request->flash();
        $formOK = false;
        try {
            $userShipping;
            $path = 'img/users';
            $userShipping->name = $request->input('Name');
            $userShipping->direccion = $request->input('Direccion');
            $userShipping->email = $request->input('E-mail Address');
            $userShipping->password = $request->input('Password');
            $file = $request->file('Foto');
            $file->move($path, $file);
            $formOK = true;
            $request->session()->put('shipping', $userShipping);
        } catch (AuthorizeException $e) {
            return view('errores.foto');
        }
        /*Una vez verificado se guarda la información de envio en la session*/

        //si el formulario se ha rellenado correctamente se redirecciona a la pagina de confirmación
        if ($formOK) redirect('/compra/confirmar');
        return view('compra/envio');
    }
    /**
     * Method to show the list of procuts and shipping info
     */
    public function confirmar()
    {
        //Dummy: hay que cambiar la info por la información guardada en session
        $products = [
            session()->get('carrito', [])
        ];
        //Dummy: hay que cambiar la info por la información guardada en session
        $shipping =  session()->get('shipping');
        return view('compra/confirmar')->with('products', $products)->with('shipping', $shipping);

        session()->put('status', url()->current);
    }

    /**
     * Check stock.
     */
    public function checkStock(CompraRequest $request) {
        $product = Product::stock($request->input('quantity'), $request->input('id'));
        if (empty($product)) {
            return false;
        } else {
            return $product->get();
        }
    }

    /**
     * Add to cart
     */
    public function compra(CompraRequest $request) {
        $product = $request->input('product');
        $carrito = $request->session()->get('carrito', []);
        array_push($carrito, $product);
        $request->session()->put('carrito',$carrito);
        $request->session()->forget('status');
    }
}
