<?php

namespace OpenFintech\Condusef\Reune;

use OpenFintech\Condusef\Redeco\CondusefService;

class ReuneService extends CondusefService
{
    public function getBaseUrl(): string
    {
        return 'https://api.condusef.gob.mx';
    }

    public function createClaim(
        string $accessToken,
        string $institucionClave,
        string $sector,
        string $consultasTrim,
        string $numConsultas,
        string $consultasFolio,
        string $consultasEstatusCon,
        string $consultasFecAten,
        string $estadosId,
        string $consultasFecRecepcion,
        string $mediosId,
        string $producto,
        string $causaId,
        string $consultasCP,
        string $consultasMpioId,
        string $consultasLocId,
        string $consultasColId,
        string $consultascatnivelatenId,
        string $pori
    ): array {
        $response = $this->http->post($this->getBaseUrl() . '/reune/consultas/general', [
                'json' => [
                    'InstitucionClave' => $institucionClave,
                    'Sector' => $sector,
                    'ConsultasTrim' => $consultasTrim,
                    'NumConsultas' => $numConsultas,
                    'ConsultasFolio' => $consultasFolio,
                    'ConsultasEstatusCon' => $consultasEstatusCon,
                    'ConsultasFecAten' => $consultasFecAten,
                    'EstadosId' => $estadosId,
                    'ConsultasFecRecepcion' => $consultasFecRecepcion,
                    'MediosId' => $mediosId,
                    'Producto' => $producto,
                    'CausaId' => $causaId,
                    'ConsultasCP' => $consultasCP,
                    'ConsultasMpioId' => $consultasMpioId,
                    'ConsultasLocId' => $consultasLocId,
                    'ConsultasColId' => $consultasColId,
                    'ConsultascatnivelatenId' => $consultascatnivelatenId,
                    'ConsultasPori' => $pori
                ],
                "headers" => [
                    "Authorization" => "Bearer $accessToken"
                ]
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}