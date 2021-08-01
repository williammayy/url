<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;

class UrlControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        $urls=Url::all();
        return view('inicio', compact('urls'));
    }

    public function index()
    {
        $urls=Url::all();
        return json_encode($urls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url=new Url();
        $url->endereco=$request->input('enderecoUrl');
        $url->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url=Url::find($id);
        if(isset($url)){
            return json_encode($url);
        }
        return response('Url não encontrada',404);
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
        $url = Url::find($id);
        if (isset($url)) {
            $url->endereco = $request->endereco;
            $url->save();
            return json_encode($url);
        }
        return response('Produto não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $url=Url::find($id);
        if (isset($url)){
            $url->delete();
            return response('OK',200);
        }
        return response('Url não encontrada',400);
    }

    public function verificaOnline(){
        $endereco=Url::all();

        $array=[];

            for($i=0;$i<count($endereco);$i++){
            array_push($array,['id'=>$endereco[$i]->id,'codigo'=>$this->verificaUrl($endereco[$i]->endereco)]);
    }

        return json_encode($array);
    }

    private function verificaUrl($urlteste){
        $url = $urlteste;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        if($data === false) {
            return "0";
        }
        else {
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpcode == 200){
           return $httpcode;
        }
        else{
            return $httpcode;
        }
        }
        curl_close($ch);
    }
}
    ?>