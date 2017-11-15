<?php

namespace GRE\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use GRE\View\Helper\ButtonGroupHelper;

/**
 * Caso de teste para a classe ButtonGroupHelper
 */
class ButtonGroupHelperTest extends TestCase
{
    /**
     * Helper a ser testado
     *
     * @var ButtonGroupHelper
     */
    public $helper;
    
    /**
     * Configuração inicial do caso de teste
     */
    public function setUp()
    {
        parent::setUp();
        $this->helper = new ButtonGroupHelper(new View());
    }
    
    /**
     * Testes de construção do buttongroup sem botões
     */
    public function testRenderWithoutButtons()
    {
        $this->assertEquals($this->helper->render(), '<div class="btn-group"></div>');
        $this->assertEquals($this->helper->render(['options' => ['attr' => 'foo']]), '<div attr="foo" class="btn-group"></div>');
    }
    
    /**
     * Testes de construção do buttongroup com botões
     */
    public function testRenderWithButtons()
    {
        $options = [
            'buttons' => [
                array(
                    'text' => 'clickme',
                    'class' => 'test',
                ),
            ],
            'options' => [
                'foo' => 'bar',
            ],
        ];
        $this->assertEquals($this->helper->render($options), '<div foo="bar" class="btn-group"><a href="#" class="test button" role="button">clickme</a></div>');
    }
}
