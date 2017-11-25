<?php

namespace GRE\Test\TestCase\Controller;

use GRE\Test\IntegrationTestCase;

/**
 * Caso de teste para o controller Distritos
 */
class DistritosControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = [
        'app.distritos',
    ];
    
    /**
     * Teste da action `listar` com requisição via get
     */
    public function testListar()
    {
        $this->get('/distritos/listar/1');
        $this->assertRedirect('/');
    }
    
    /**
     * Teste da action `listar` com requisição via ajax
     */
    public function testListarViaAjax()
    {
        $this->configAjaxRequest();
        $this->get('/distritos/listar/1');
        $this->assertResponseOk();
        $this->assertResponseContains('"id": 1');
        $this->assertResponseContains('"inep_codigo": 11111');
        $this->assertResponseContains('"nome": "NOME_1"');
    }
    
    /**
     * Teste da action `listar` com requisição via ajax, com id do municipio
     * inválido
     */
    public function testListarViaAjaxComMunicipioInvalido()
    {
        $this->configAjaxRequest();
        $this->get('/distritos/listar/99999999');
        $this->assertResponseOk();
        $this->assertResponseContains('"distritos": []');
    }
    
    /**
     * Teste da action `listar` com requisição via ajax, com id do município
     * omitido
     */
    public function testListarViaAjaxSemInformarOMunicipio()
    {
        $this->configAjaxRequest();
        $this->get('/distritos/listar/');
        $this->assertResponseOk();
        $this->assertResponseContains('"distritos": []');
    }
}
