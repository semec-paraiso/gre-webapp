<?php

namespace GRE\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Cake\Core\Configure;
use GRE\View\Helper\IconHelper;

/**
 * Test case para o helper Icon
 */
class IconHelperTest extends TestCase
{
    /**
     * Instância do helper Icon
     *
     * @var IconHelper
     */
    public $helper;
    
    /**
     * Configuração inicial
     */
    public function setUp()
    {
        parent::setUp();
        $this->helper = new IconHelper(new View());
    }
    
    /**
     * Testa a inicialização do helper passando um valor inválido para a chave
     * 'icons'
     * 
     * @expectedException \Exception
     */
    public function testInitializeWithInvalidConfigMustThrownAnException()
    {
        $config = [
            'icons' => new \stdClass(),
        ];
        $this->helper->initialize($config);
    }
    
    /**
     * Testa o método de incialização do helper passando um array vazio para
     * a chave 'icons' do parâmetro $config
     */
    public function testInitializeWithAnEmptyArrayForIconsKeyForConfig()
    {
        $config = [
            'icons' => []
        ];
        $this->helper->initialize($config);
        $this->assertEquals($this->helper->getAliases(), array());
    }
    
    /**
     * Testa o método de incialização do helper passando um array completo para
     * a chave 'icons' do parâmetro $config
     */
    public function testInitializeWithACompleteIconsKeyForConfig()
    {
        $config = [
            'icons' => [
                'aliases' => [
                    'foo' => 'bar',
                ],
            ],
        ];
        $this->helper->initialize($config);
        $aliases = $this->helper->getAliases();
        $this->assertTrue(isset($aliases['foo']));
        $this->assertEquals($aliases['foo'], $config['icons']['aliases']['foo']);
    }
    
    /**
     * Testa o método de incialização do helper passando o nome de do arquivo
     * de configuração 'tests' para a a chave 'icons' do parâmetro $config
     */
    public function testInitializeWithConfigFileForConfig()
    {
        Configure::load('tests');
        $config = Configure::read('Icons');
        $this->helper->initialize(['icons' => 'tests']);
        $this->assertEquals($this->helper->getAliases()['foo'], $config['aliases']['foo']);
    }
}
