<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\BuscaCepServiceInterface;
use App\Services\ViaCepService;

class BuscaCepController extends Controller
{
    private ViaCepService $buscaCepService;

    /**
     * @param ViaCepService $buscaCepService
     */
    public function __construct(ViaCepService $buscaCepService)
    {
        $this->buscaCepService = $buscaCepService;
    }

    /**
     * @param $cep
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function busca($cep)
    {
        return response()->json($this->buscaCepService->buscaPeloCep(str_pad($cep, 8, '0', STR_PAD_LEFT)));
    }
}
