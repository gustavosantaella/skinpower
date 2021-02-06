<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models as productos;
use Stevebauman\Purify\Facades\Purify;
use DB;

class Products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $res = productos\Products::listProductsPage();

     return view('page.products')->with('products',$res);
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        echo "<pre>";
        print_r($_POST);
        print_r($_FILES);
        echo "</pre>";
        $this::validate($request,
            [
                '_token'=>'required|Min:20|string',
                'marca'=>'required|string',
                'nombre'=>'required|string',
                'status'=>'required|boolean',
                'descripcion'=>'required|string',
                'cantidad'=>'required|numeric',
                'precio'=>'required|numeric',
                'foto'=>'required|Max:70000|image',


            ]);
       

        $array = [
            'brand'=>addslashes($request->marca).'|required|regex:^[a-zA-Z\s]{2,254}',
            'nameproduct'=>$request->nombre,
            'price'=>$request->precio,
            'stock'=>$request->cantidad,
            'status'=>$request->status,
            'photo'=>$request->file('foto')->store('public/img'),
            'created_at'=>now(),

        ];
    

        if (DB::table('products')->where('nameproduct',$request->nombre)->count()) {
            return redirect()->back()->withInput()->with('message','El nombre del producto ya existe');
        }
        if (!productos\Products::i($array)) {
            return redirect()->route('add product');
        }

    return redirect()->route('add product')->with('message','Agregado exitosamente');
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
