<?php

namespace GRE\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use GRE\View\Helper\ListGroupHelper;

/**
 * Caso de teste para a classe ListGroup
 */
class ListGroupHelperTest extends TestCase
{
    /**
     * Helper a ser testado
     *
     * @var ListGroupHelper
     */
    public $helper;
    
    /**
     * Configuração dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->helper = new ListGroupHelper(new View);
    }
    
    /**
     * Teste do método render()
     */
    public function testRender()
    {
        $options = [
            'attr' => 'foo',
            'class' => 'bar',
            'items' => [
                array(
                    'text' => 'Test',
                    'url' => '/',
                    'class' => 'foo-item',
                    'icon' => 'icon',
                ),
            ],
        ];
        $this->assertEquals($this->helper->render(), '<nav class="list-group"></nav>');
        $this->assertEquals($this->helper->render($options), '<nav class="bar list-group" attr="foo"><a href="/" class="foo-item list-group-item"><i class="icon"></i>Test</a></nav>');
    }
}
