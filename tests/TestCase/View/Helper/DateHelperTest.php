<?php

namespace GRE\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Cake\I18n\FrozenDate;
use GRE\View\Helper\DateHelper;

/**
 * Caso de teste para a classe DateHelper
 */
class DateHelperTest extends TestCase
{
    /**
     * Helper a ser testado
     *
     * @var DateHelper
     */
    public $helper;
    
    /**
     * Configuração inicial do caso de teste
     */
    public function setUp()
    {
        parent::setUp();
        $this->helper = new DateHelper(new View());
    }
    
    /**
     * Teste do método br()
     */
    public function testBr()
    {
        $date = (new FrozenDate())->setDate('2017', '11', '15');
        $this->assertEquals($this->helper->br($date), '15/11/2017');
    }
    
    /**
     * Teste do método br() com datas inválidas
     */
    public function testBrWithInvalidDate()
    {
        $this->assertEquals($this->helper->br(''), '');
        $this->assertNull($this->helper->br(null));
    }
}
