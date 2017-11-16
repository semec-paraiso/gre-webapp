<?php

namespace GRE\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use GRE\View\Helper\BoxHelper;

/**
 * Caso de testes para a classe BoxHelper
 */
class BoxHelperTest extends TestCase
{
    /**
     * Helper a ser testado
     *
     * @var BoxHelper
     */
    public $helper;
    
    /**
     * Configuraçoes do caso de teste
     */
    public function setUp()
    {
        parent::setUp();
        $this->helper = new BoxHelper(new View);
    }
    
    /**
     * Testa a construção do header vazio
     */
    public function testHeaderEmpty()
    {
        $this->assertEquals($this->helper->header(), '<div class="box-header"></div>');
    }
    
    /**
     * Testa a construção do header com título
     */
    public function testHeaderWithTitle()
    {
        $options = [
            'text' => 'Title',
            'foo' => 'bar',
        ];
        $this->assertEquals($this->helper->header($options), '<div foo="bar" class="box-header"><h3 class="box-title">Title</h3></div>');
    }
    
    /**
     * Testa a construção do header com ícone e título
     */
    public function testHeaderWithTitleAndIcon()
    {
        $options = [
            'text' => 'Title',
            'icon' => 'foo',
        ];
        $this->assertEquals($this->helper->header($options), '<div class="box-header"><h3 class="box-title"><i class="foo"></i>Title</h3></div>');
    }
    
    /**
     * Testa a construção do header com ícone, título e toolbar
     */
    public function testHeaderWithTitleAndIconAndToolbar()
    {
        $options = [
            'text' => 'Title',
            'icon' => 'foo',
            'toolbar' => [
                'groups' => [
                    array(
                        'buttons' => [
                            array(
                                'text' => 'clickme',
                            ),
                        ],
                    ),
                ],
            ],
        ];
        $this->assertEquals($this->helper->header($options), '<div class="box-header"><h3 class="box-title"><i class="foo"></i>Title</h3><div class="box-tools"><div class="btn-toolbar"><div class="btn-group"><a href="#" class="default button" role="button">clickme</a></div></div></div></div>');
    }
}
