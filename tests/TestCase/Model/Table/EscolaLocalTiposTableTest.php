<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para o repositório \GRE\Model\Table\EscolaLocaisTable
 */
class EscolaLocalTiposTableTest extends TestCase
{
    /**
     * Fixtures utilizados
     *
     * @var array
     */
    public $fixtures = ['app.escola_local_tipos'];
    
    /**
     * Repositório a ser testado
     *
     * @var \GRE\Model\Table\EscolaLocaisTable
     */
    public $EscolaLocalTipos;
    
    /**
     * Configuração dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->EscolaLocalTipos = TableRegistry::get('EscolaLocalTipos');
    }

    /**
     * Teste do método getList()
     */
    public function testGetList()
    {
        $expected = [
            3 => 'NOME_3',
            1 => 'NOME_1',
            4 => 'NOME_4',
            2 => 'NOME_2',
        ];
        $escolaLocalTipos = $this->EscolaLocalTipos->getList();
        
        /*
         * Verifica se o método getList() está retornando a quantidade de
         * registroscorreta
         */
        $this->assertEquals(count($expected), count($escolaLocalTipos));
        
        /*
         * Verifica se os resultados estão na ordem esperada
         */
        $comparation = array_combine($expected, $escolaLocalTipos);
        foreach ($comparation as $key => $value) { 
            $this->assertEquals($key, $value);
        }
    }
}
