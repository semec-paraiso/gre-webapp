<?php

namespace GRE\Test\TestCase\Controller;

use GRE\Test\IntegrationTestCase;

/**
 * Caso de teste de integração para o controller \GRE\Controller\MunicipiosController
 */
class MunicipiosControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = [
        'app.municipios',
    ];
    
    /**
     * Teste da action `listar`, informando com requisição via get 
     */
    public function testListar()
    {
        $this->get('/municipios/listar/1');
        $this->assertRedirect('/');
    }
    
    /**
     * Teste da action `listar`, informando com requisição ajax, informando 
     * um id válido para a UF
     */
    public function testListarViaAjax()
    {
        $this->configAjaxRequest();
        $this->get('/municipios/listar/1');
        $this->assertResponseOk();
        $this->assertResponseContains('"id": 1');
        $this->assertResponseContains('"inep_codigo": 11111');
        $this->assertResponseContains('"nome": "NOME_1"');
    }
    
    /**
     * Teste da action `listar`, informando com requisição ajax, informando 
     * um id de uma UF inexistente
     */
    public function testListarViaAjaxComUfInvalido()
    {
        $this->configAjaxRequest();
        $this->get('/municipios/listar/99999');
        $this->assertResponseOk();
        $this->assertResponseContains('"municipios": []');
    }
    
    /**
     * Teste da action `listar`, informando com requisição ajax, omitindo 
     * o id da UF
     */
    public function testListarViaAjaxComUfOmitido()
    {
        $this->configAjaxRequest();
        $this->get('/municipios/listar/');
        $this->assertResponseOk();
        $this->assertResponseContains('"municipios": []');
    }
}
