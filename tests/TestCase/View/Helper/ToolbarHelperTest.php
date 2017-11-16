<?php

namespace GRE\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use GRE\View\Helper\ToolbarHelper;

/**
 * Caso de teste para o helper Toolbar
 */
class ToolbarHelperTest extends TestCase
{
    /**
     * Helper testado
     * 
     * @var ToolbarHelper
     */
    public $helper;
    
    /**
     * Configuração inicial do caso de teste
     */
    public function setUp()
    {
        parent::setUp();
        $this->helper = new ToolbarHelper(new View);
    }
    
    /**
     * Teste do método render()
     */
    public function testRender()
    {
        $options = [
            'groups' => [
                array(
                    'buttons' => [
                        array(
                            'text' => 'clickme',
                            'url' => '/',
                        ),
                    ],
                ),
                array(
                    'buttons' => [
                        array(
                            'text' => 'clickme2',
                            'url' => '/',
                        ),
                    ],
                ),
            ],
            'options' => [
                'attr' => 'foo',
            ],
        ];
        $this->assertEquals($this->helper->render($options), '<div attr="foo" class="btn-toolbar"><div class="btn-group"><a href="/" class="default button" role="button">clickme</a></div><div class="btn-group"><a href="/" class="default button" role="button">clickme2</a></div></div>');
    }
}
