<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para a class \GRE\Model\Table\PredioOcupacaoFormasTable
 */
class PredioOcupacaoFormasTableTest extends TestCase
{
    /**
     * Fixtures utilizados
     *
     * @var array
     */
    public $fixtures = ['app.predio_ocupacao_formas'];
    
    /**
     * Repositório a ser testado
     *
     * @var \GRE\Model\Table\PredioOcupacaoFormasTable
     */
    public $PredioOcupacaoFormas;
    
    /**
     * Configuração dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->PredioOcupacaoFormas = TableRegistry::get('PredioOcupacaoFormas');
    }
    
    /**
     * Teste do método getList()
     */
    public function testGetList()
    {
        $expected = [
            4 => 'NOME_4',
            2 => 'NOME_2',
            1 => 'NOME_1',
        ];
        $predioOcupacaoFormas = $this->PredioOcupacaoFormas->getList();
        
        $this->assertEquals(count($predioOcupacaoFormas), count($expected));
        
        $comparation = array_combine($predioOcupacaoFormas, $expected);
        foreach ($comparation as $k => $v) {
            $this->assertEquals($k, $v);
        }
    }
}
