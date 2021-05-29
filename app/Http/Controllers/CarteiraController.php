<?php

namespace App\Http\Controllers;

use App\Repositories\CarteiraRepository;

class CarteiraController extends Controller
{
    /**
     * @var CarteiraRepository
     */
    private $carteiraRepository;

    /**
     * ComunController constructor.
     */
    public function __construct(CarteiraRepository $carteiraRepository)
    {
        $this->carteiraRepository = $carteiraRepository;
    }

    public function index(){
        return $this->carteiraRepository->all();
    }

    public function saldo(){
        return auth()->user()->carteira();
    }


}
