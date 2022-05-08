<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    /**
     * @param int $cep
     * @return \Illuminate\Support\Collection
     * @throws \Throwable
     */
    public function buscaPeloCep(string $cep)
    {
        $response = Http::get('https://viacep.com.br/ws/' . $cep . '/json');
        throw_if($response->status() !== 200, new \Exception('Não foi possivel encontrar esse cep', 404));
        throw_if(isset($response->json()['erro']), new \Exception('Não foi possivel encontrar esse cep', 404));
        return collect($response->json())
            ->only('cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'uf', 'ibge', 'ddd');
    }
}
