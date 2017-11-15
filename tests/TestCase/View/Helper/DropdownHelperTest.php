<?php

namespace GRE\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use GRE\View\Helper\DropdownHelper;

/**
 * Caso de deste para a classe DropdownHelper
 */
class DropdownHelperTest extends TestCase
{
    /**
     * Helper a ser testado
     *
     * @var DropdownHelper
     */
    public $helper;
    
    /**
     * Configuração do caso de teste
     */
    public function setUp()
    {
        parent::setUp();
        $this->helper = new DropdownHelper(new View);
    }
    
    /**
     * Testes da construção de dropdown sem itens
     */
    public function testRenderWithoutItems()
    {
        $this->assertEquals($this->helper->render(), '<ul class="dropdown-menu"></ul>');
        $this->assertEquals($this->helper->render(['attr' => 'foo', 'class' => 'bar']), '<ul attr="foo" class="bar dropdown-menu"></ul>');
    }
    
    /**
     * Testes da construção de dropdown com itens
     */
    public function testRenderWithItems()
    {
        $options = [
            'items' => [
                array(
                    'text' => 'foo',
                    'icon' => 'bar',
                ),
            ],
        ];
        $this->assertEquals($this->helper->render($options), '<ul class="dropdown-menu"><li><a href="#"><i class="bar"></i>foo</a></li></ul>');
    }
    
    /**
     * Teste da construção de dropdown com divisores
     */
    public function testRenderWithDivider()
    {
        $options = [
            'items' => [
                array(
                    'type' => 'divider',
                ),
            ],
        ];
        $this->assertEquals($this->helper->render($options), '<ul class="dropdown-menu"><li class="divider" role="separator"></li></ul>');
    }
}
