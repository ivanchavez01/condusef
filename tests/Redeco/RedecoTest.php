<?php

namespace Tests\OpenFintech\Condusef\Redeco;

use GuzzleHttp\Client;
use OpenFintech\Condusef\Condusef;
use OpenFintech\Condusef\Redeco\RedecoService;
use OpenFintech\Condusef\Reune\ReuneService;
use PHPUnit\Framework\TestCase;

class RedecoTest extends TestCase
{
    private Condusef $condusef;
    private string $accessToken;

    protected function setUp(): void
    {
        parent::setUp();

        $http = new Client();
        $this->condusef = new Condusef(
            new RedecoService($http),
            new ReuneService($http)
        );

        $this->accessToken = '';
    }

    public function testSearchCondusef()
    {
        $Condusef = $this->condusef->redeco->buscar($this->accessToken, 2024, 3);
        $this->assertIsArray($Condusef);
        $this->assertNotEmpty($Condusef);
    }

    public function testCausas()
    {
        $causas = $this->condusef->redeco->causas($this->accessToken, '029713681542');
        $this->assertIsArray($causas);
        $this->assertNotEmpty($causas);
    }

    public function testEstados()
    {
        $estados = $this->condusef->redeco->estados();
        $this->assertIsArray($estados);
        $this->assertNotEmpty($estados);
    }

    public function testMunicipios() {
        $municipios = $this->condusef->redeco->municipios(26, "83280");
        $this->assertIsArray($municipios);
        $this->assertNotEmpty($municipios);
    }

    public function testColonias()
    {
        $colonias = $this->condusef->redeco->colonias( "83280");
        $this->assertIsArray($colonias);
        $this->assertNotEmpty($colonias);
    }

    public function testProductos()
    {
        $productos = $this->condusef->redeco->productos($this->accessToken);
        $this->assertIsArray($productos);
        $this->assertNotEmpty($productos);
    }
}