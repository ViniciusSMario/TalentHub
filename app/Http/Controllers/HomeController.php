<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $vagas = Vaga::where('vagas.nome', 'like', '%'.$filter.'%')->get();
        }else {
            $vagas = Vaga::all();
        }
        return view('vagas/index', compact('vagas', 'filter'));
    }
}
