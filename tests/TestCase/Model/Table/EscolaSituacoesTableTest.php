<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para o repositório \GRE\Model\Table\EscolaSituacoesTable
 */
class EscolaSituacoesTableTest extends TestCase
{
    /**
     * Fixtures utilizados
     *
     * @var array
     */
    public $fixtures = ['app.escola_situacoes'];
    
    /**
     * Repositório a ser testado
     *
     * @var \GRE\Model\Table\EscolaSituacoesTable
     */
    public $EscolaSituacoes;
    
    /**
     * Congiguração dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->EscolaSituacoes = TableRegistry::get('EscolaSituacoes');
    }
    
    /**
     * Teste para o método getList()
     */
    public function testGetList()
    {
        $expected = [
            1 => 'Em funcionamento',
            4 => 'NOME_4',
            2 => 'Paralisada'  
        ];
        $escolaSituacoes = $this->EscolaSituacoes->getList();
        
        /**
         * Compara a quantidade de registros retornada com a quantidade 
         * de registros esperada
         */
        $this->assertEquals(count($expected), count($escolaSituacoes));
        
        /**
         * Compara se cada registro retornado é igual a cada registro esperado,
         * na ordem esperada
         */
        $compare = array_combine($expected, $escolaSituacoes);
        foreach ($compare as $k => $v) {
            $this->assertEquals($k, $v);
        }
    }
}
