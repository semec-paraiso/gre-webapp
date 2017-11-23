<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para o repositório \GRE\Model\Table\EscolaLocaisTable
 */
class EscolaLocaisTableTest extends TestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = [
        'app.escola_locais',
        'app.escolas',
    ];
    
    /**
     * Repositório a ser testado
     *
     * @var \GRE\Model\Table\EscolaLocaisTable
     */
    public $EscolaLocais;
    
    /**
     * Configurações dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->EscolaLocais = TableRegistry::get('EscolaLocais');
    }
    
    /**
     * Teste do método get()
     */
    public function testGet()
    {
        $expected = [
            'id' => 1,
            'nome' => 'NOME_1',
            'predio_ocupacao_forma_id' => 1,
            'escola_local_tipo_id' => 1,
            'deleted' => 0,
            'escola' => [
                'id' => 1,
                'nome_curto' => 'NOME_CURTO_1',
                'deleted' => 0,
            ],
        ];
        $escolaLocal = $this->EscolaLocais->get(1);
        $this->assertInstanceOf('\GRE\Model\Entity\EscolaLocal', $escolaLocal);
        $escolaLocal = $escolaLocal->toArray();
        $this->assertEquals($escolaLocal, $expected);
    }
    
    /**
     * Teste do método get(), informando o id de uma excola excluída
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetComLocalExcluido()
    {
        $this->EscolaLocais->get(2);
    }
    
    /**
     * Teste do método setDeleted()
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testSetDeleted()
    {
        $escolaLocal = $this->EscolaLocais->get(1);
        $this->assertInstanceOf('\GRE\Model\Entity\EscolaLocal', $escolaLocal);
        $this->EscolaLocais->setDeleted($escolaLocal);
        $this->EscolaLocais->get(1);
    }
    
    /**
     * Teste do método getList()
     */
    public function testGetList()
    {
        $expected = [
            1 => 'NOME_1',
            3 => 'NOME_3',
        ];
        $escolaLocais = $this->EscolaLocais->getList(1);
        $this->assertEquals($escolaLocais, $expected);
    }
}
