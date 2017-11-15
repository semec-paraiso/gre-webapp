<?php

namespace GRE\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use GRE\View\Helper\ButtonHelper;

/**
 * Caso de teste para a classe ButtonHelper
 */
class ButtonHelperTest extends TestCase
{
    /**
     * Helper a ser testado
     *
     * @var ButtonHelper
     */
    public $helper;
    
    /**
     * Configuração do helper
     */
    public function setUp()
    {
        parent::setUp();
        $this->helper = new ButtonHelper(new View());
    }
    
    /**
     * Teste do método de inicialização sem nenhuma configuração
     */
    public function testInitializeWithoutConfig()
    {
        $this->helper->initialize(array());
        $this->assertTrue(empty($this->helper->getAliases()));
    }
    
    /**
     * Teste do método de inicialização do helper passando o nome de um arquivo
     * de configuração
     */
    public function testInitializeWithConfigTestFile()
    {
        $this->helper->initialize(['buttons' => 'tests']);
        $this->assertEquals($this->helper->getAliases()['foo'], 'bar');
    }
    
    /**
     * Teste do método de inicialização do helper passando um array de configuração
     */
    public function testInitializeWithConfigArray()
    {
        $buttons = [
            'aliases' => [
                'foo' => 'bar',
            ],
        ];
        $this->helper->initialize(['buttons' => $buttons]);
        $this->assertEquals($this->helper->getAliases()['foo'], 'bar');
    }
    
    /**
     * Teste do método de inicialização passando um array de configuração
     * inválido
     * 
     * @expectedException \Exception
     */
    public function testInitializeWithInvalidConfig()
    {
        $this->helper->initialize(['buttons' => new \stdClass()]);
    }
    
    /**
     * Testes do método de renderização do botão como um link
     */
    public function testRenderLink()
    {
        $buttons = [
            'aliases' => [
                'button' => 'foo',
                'default' => 'bar',
                'test' => 'tested',
            ],
        ];
        $this->helper->initialize(['buttons' => $buttons]);
        $this->assertEquals($this->helper->render(), '<a href="#" class="bar foo" role="button"></a>');
        $this->assertEquals($this->helper->render(['class' => 'test test2', 'text' => 'Clickme', 'attr' => 'none']), '<a href="#" class="tested test2 foo" attr="none" role="button">Clickme</a>');
        $this->assertEquals($this->helper->render(['icon' => 'foo']), '<a href="#" class="bar foo" role="button"><i class="foo"></i></a>');
        $this->assertEquals($this->helper->render(['caret' => true]), '<a href="#" class="bar foo" role="button"><i class="caret"></i></a>');
        $this->assertEquals($this->helper->render(['caret' => true, 'icon' => 'icon', 'text' => 'clickme']), '<a href="#" class="bar foo" role="button"><i class="icon"></i>clickme<i class="caret"></i></a>');
    }
    
    /**
     * Teste do método de renderização do botão como um submit
     */
    public function testRenderSubmitButton()
    {
        $buttons = [
            'aliases' => [
                'button' => 'foo',
                'default' => 'bar',
                'test' => 'tested',
            ],
        ];
        $this->helper->initialize(['buttons' => $buttons]);
        $this->assertEquals($this->helper->render(['caret' => true, 'tag' => 'submit', 'icon' => 'icon', 'text' => 'clickme']), '<button class="bar foo" type="submit"><i class="icon"></i>clickme<i class="caret"></i></button>');
    }
    
    /**
     * Teste do método de renderização passando uma tag inválida
     * 
     * @expectedException \Exception
     */
    public function testRenderWithInvalidTag()
    {
        $this->helper->initialize(['buttons' => array()]);
        $this->helper->render(['tag' => 'INVALID_TAG']);
    }
    
    /**
     * Testes de renderização do botão com um menu dropdown associado
     */
    public function testRenderWithDropdown()
    {
        $options = [
            'text' => 'clickme',
            'icon' => 'example',
            'dropdown' => [
                'items' => [
                    array(
                        'icon' => 'icon',
                        'text' => 'foo',
                        'url' => '/',
                    ),
                    array(
                        'type' => 'divider',
                    ),
                ],
                'attr' => 'test'
            ],
        ];
        $this->assertEquals($this->helper->render($options), '<a href="#" class="default button dropdown-toggle" data-toggle="dropdown" role="button"><i class="example"></i>clickme</a><ul attr="test" class="dropdown-menu"><li><a href="/"><i class="icon"></i>foo</a></li><li class="divider" role="separator"></li></ul>');
    }
}
