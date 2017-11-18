<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para o repositório \GRE\Model\Table\UfsTable
 */
class UfsTableTest extends TestCase
{
    /**
     * Cenários
     *
     * @var array
     */
    public $fixtures = [
        'app.ufs',
    ];
    
    /**
     * Instância do repositório a ser testado
     * 
     * @var \GRE\Model\Table\UfsTable
     */
    public $Ufs;
    
    /**
     * Configuração dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->Ufs = TableRegistry::get('Ufs');
    }
    
    /**
     * Teste do método getList()
     */
    public function testGetList()
    {
        $expected = [
            1 => 'AC',
            3 => 'AM',
            2 => 'TO',
        ];
        $this->assertEquals($this->Ufs->getList(), $expected);
    }
}
