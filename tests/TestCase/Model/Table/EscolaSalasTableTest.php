<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para o repositório \GRE\Model\Table\EscolaSalasTable
 */
class EscolasSalasTableTest extends TestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = [
        'app.escola_salas',
        'app.escola_locais',
        'app.escolas',
    ];
    
    /**
     * Repositório a ser testado
     *
     * @var \GRE\Model\Table\EscolaSalasTable
     */
    public $EscolaSalas;
    
    /**
     * Configurações dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->EscolaSalas = TableRegistry::get('EscolaSalas');
    }
    
    /**
     * Teste do método get(), com uma sala válida
     */
    public function testGet()
    {
        $expected = [
            'id' => 1,
            'nome' => 'NOME_1',
            'capacidade' => 30,
            'deleted' => 0,  
            'escola_local' => [
                'id' => 1,
                'nome' => 'NOME_1',
                'escola' => [
                    'id' => 1,
                    'nome_curto' => 'NOME_CURTO_1',
                ],
            ],
        ];
        $escolaSala = $this->EscolaSalas->get(1);
        $this->assertInstanceOf('\GRE\Model\Entity\EscolaSala', $escolaSala);
        $this->assertEquals($escolaSala->toArray(), $expected);
    }
    
    /**
     * Teste do método get(), com o id de uma sala excluída
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetEscolaSalaExcluida()
    {
        $this->EscolaSalas->get(2);
    }
    
    /**
     * Teste do método get(), com o id de uma sala inexistente
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetEscolaSalaInexistente()
    {
        $this->EscolaSalas->get(99999);
    }
    
    /**
     * Teste do método get(), com sala com id nulo
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetEscolaSalaComIdNull()
    {
        $this->EscolaSalas->get(null);
    }
    
    /**
     * Teste do método setDeleted()
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testsetDeleted()
    {
        $escolaSala = $this->EscolaSalas->get(1);
        $this->assertInstanceOf('\GRE\Model\Entity\EscolaSala', $escolaSala);
        $this->EscolaSalas->setDeleted($escolaSala);
        $this->EscolaSalas->get(1);
    }
}
