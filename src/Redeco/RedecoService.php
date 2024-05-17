<?php

namespace OpenFintech\Complaints\Redeco;

use GuzzleHttp\Exception\GuzzleException;

class RedecoService extends CondusefService
{
    private string $baseUrl = 'https://api.condusef.gob.mx';

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $accessToken
     * @param int $year
     * @param int $month
     * @return array
     * @throws GuzzleException
     */
    public function buscar(string $accessToken, int $year, int $month): array
    {
        $response = $this->http->get($this->baseUrl . '/redeco/quejas', [
            'query' => [
                'year' => $year,
                'month' => $month
            ],
            'headers' => [
                'Authorization' => $accessToken
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $accessToken
     * @param int $noTrim
     * @param int $num
     * @param string $folio
     * @param \DateTimeImmutable $fecRecepcion
     * @param string $medioId
     * @param string $nivelATId
     * @param string $product
     * @param int $causasId
     * @param string $pori
     * @param string $estatus
     * @param int $estadosId
     * @param int $munId
     * @param int $locId
     * @param int $colId
     * @param int $cp
     * @param string $tipoPersona
     * @param string $sexo
     * @param int $edad
     * @param \DateTimeImmutable $fecResolucion
     * @param \DateTimeImmutable $fecNotificacion
     * @param string $respuesta
     * @param int $numPenal
     * @param string $penalizacionId
     * @return array
     * @throws GuzzleException
     */
    public function crearQueja(
        string $accessToken,
        int $noTrim,
        int $num,
        string $folio,
        \DateTimeImmutable $fecRecepcion,
        string $medioId,
        string $nivelATId,
        string $product,
        int $causasId,
        string $pori,
        string $estatus,
        int $estadosId,
        int $munId,
        int $locId,
        int $colId,
        int $cp,
        string $tipoPersona,
        string $sexo,
        int $edad,
        \DateTimeImmutable $fecResolucion,
        \DateTimeImmutable $fecNotificacion,
        string $respuesta,
        int $numPenal,
        string $penalizacionId,
    ): array {
        $response = $this->http->post($this->baseUrl . '/redeco/quejas', [
            'json' => [
                [
                    'QuejasNoTrim' => $noTrim,
                    'QuejasNum' => $num,
                    'QuejasFolio' => $folio,
                    'QuejasFecRecepcion' => $fecRecepcion->format('d/m/Y'),
                    'MedioId' => $medioId,
                    'NivelATId' => $nivelATId,
                    'product' => $product,
                    'CausasId' => $causasId,
                    'QuejasPORI' => $pori,
                    'QuejasEstatus' => $estatus,
                    'EstadosId' => $estadosId,
                    'QuejasMunId' => $munId,
                    'QuejasLocId' => $locId,
                    'QuejasColId' => $colId,
                    'QuejasCP' => $cp,
                    'QuejasTipoPersona' => $tipoPersona,
                    'QuejasSexo' => $sexo,
                    'QuejasEdad' => $edad,
                    'QuejasFecResolucion' => $fecResolucion->format('d/m/Y'),
                    'QuejasFecNotificacion' => $fecNotificacion->format('d/m/Y'),
                    'QuejasRespuesta' => $respuesta,
                    'QuejasNumPenal' => $numPenal,
                    'PenalizacionId' => $penalizacionId
                ]
            ],
            'headers' => [
                'Authorization' => $accessToken
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $accessToken
     * @param string $folio
     * @return array
     * @throws GuzzleException
     */
    public function delete(string $accessToken, string $folio): array
    {
        $response = $this->http->delete($this->baseUrl . '/redeco/quejas/?quejaFolio=' . $folio, [
            'headers' => [
                'Authorization' => $accessToken
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function productos(string $accessToken): array
    {
        $response = $this->http->get($this->getBaseUrl() . '/catalogos/products-list', [
            "headers" => [
                "Authorization" => $accessToken
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function causas(string $accessToken, string $productId): array
    {
        $response = $this->http->get($this->getBaseUrl() . '/catalogos/causas-list', [
            "query" => [
                "product" => $productId
            ],
            "headers" => [
                "Authorization" => $accessToken
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function estados(): array
    {
        $response = $this->http->get($this->getBaseUrl() . '/sepomex/estados');
        return json_decode($response->getBody()->getContents(), true);
    }

    public function municipios(int $stateId, string $cp): array
    {
        $response = $this->http->get($this->getBaseUrl() . '/sepomex/municipios', [
            'query' => [
                'estado_id' => $stateId,
                'cp' => $cp
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function colonias(string $cp): array
    {
        $response = $this->http->get($this->getBaseUrl() . '/sepomex/colonias', [
            'query' => [
                'cp' => $cp
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}