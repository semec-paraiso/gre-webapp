<?php

namespace GRE\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use GRE\View\Helper\LabelHelper;

/**
 * Caso de teste para a classe LabelHelper
 */
class LabelHelperTest extends TestCase
{
    /**
     * Helper a ser testado
     *
     * @var LabelHelper
     */
    public $helper;
    
    /**
     * Configurações iniciais
     */
    public function setUp()
    {
        parent::setUp();
        $this->helper = new LabelHelper(new View);
    }
    
    /**
     * Teste do método de inicialização sem nenhum parâmetro
     */
    public function testInitializeWithEmptyConfig()
    {
        $this->helper->initialize([]);
        $this->assertTrue(empty($this->helper->getAliases()));
    }
    
    /**
     * Teste do método de inicialização com o nome do arquivo de configuração
     */
    public function testInitializeWithFileConfig()
    {
        $this->helper->initialize(['labels' => 'tests']);
        $this->assertEquals($this->helper->getAliases()['foo'], 'bar');
        $this->assertEquals($this->helper->getAliases()['label'], 'label-base');
    }
    
    /**
     * Teste do método de inicialização com um array de configuração
     */
    public function testInitializeWithArrayConfig()
    {
        $this->helper->initialize([
            'labels' => [
                'aliases' => [
                    'foo' => 'bar',
                ],
            ]
        ]);
        $this->assertEquals($this->helper->getAliases()['foo'], 'bar');
    }
    
    /**
     * Teste do método de inicialização com uma configuração inválida
     * 
     * @expectedException \Exception
     */
    public function testInitializeWithInvalidArrayConfig()
    {
        $this->helper->initialize(['labels' => new \stdClass()]);
    }
    
    /**
     * Teste do método render sem nenhuma configuração
     */
    public function testRenderEmptyWithoutConfig()
    {
        $this->assertEquals($this->helper->render(), '<span class="label"></span>');
    }
    
    /**
     * Teste do método render para exibir o texto do label, sem nenhuma
     * configuração
     */
    public function testRenderWithTextWithoutConfig()
    {
        $this->assertEquals($this->helper->render(['text' => 'test']), '<span class="label">test</span>');
    }
    
    /**
     * Teste do método render para construir um label vazio, com uma configuração
     */
    public function testRenderEmptyWithConfig()
    {
        $this->helper->initialize(['labels' => 'tests']);
        $this->assertEquals($this->helper->render(), '<span class="label-base"></span>');
    }
    
    /**
     * Teste do método render para construir um label com vários parâmetros, com
     * configuração
     */
    public function testRenderWithConfigAndParameters()
    {
        $this->helper->initialize(['labels' => 'tests']);
        $options = [
            'class' => 'foo',
            'attr' => 'attrib',
            'text' => 'test',
        ];
        $this->assertEquals($this->helper->render($options), '<span class="bar label-base" attr="attrib">test</span>');
    }
}
