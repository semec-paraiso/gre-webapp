<?php

namespace GRE\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use GRE\View\Helper\MaskHelper;

/**
 * Caso de teste para a classe MaskHelper
 */
class MaskHelperTest extends TestCase
{
    /**
     * Helper a ser testado
     *
     * @var MaskHelper
     */
    public $helper;
    
    /**
     * Configuração dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->helper = new MaskHelper(new View);
    }
    
    /**
     * Teste de chamada de uma máscara inválida
     * 
     * @expectedException \Exception
     */
    public function testInvalidMask()
    {
        $this->helper->INV4L1D_M4SK();
    }
    
    /**
     * Testa o mascaramento de CEP
     */
    public function testCep()
    {
        $this->assertEquals($this->helper->cep('77600000'), '77600-000');
        $this->assertEquals($this->helper->cep(''), '-');
    }
    
    /**
     * Testa o mascaramento de um CEP inválido
     * 
     * @expectedException \Exception
     */
    public function testInvalidCep()
    {
        $this->helper->cep(new \stdClass());
    }
    
    /**
     * Testa o mascaramento de um CEP em branco
     * 
     * @expectedException \Exception
     */
    public function testBlankCep()
    {
        $this->helper->cep();
    }
    
    /**
     * Testa o mascaramento do código INEP de escolas
     */
    public function testInepEscola()
    {
        $this->assertEquals($this->helper->inepEscola('88888888'), '88.88888-8');
        $this->assertEquals($this->helper->inepEscola(''), '.-');
    }
}
