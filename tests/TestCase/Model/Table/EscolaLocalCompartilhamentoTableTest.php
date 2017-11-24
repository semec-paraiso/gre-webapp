<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para o repositório \GRE\Model\Table\EscolaLocalCompartilhamentosTable
 */
class EscolaLocalCompartilhamentoTableTest extends TestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = [
        'app.escola_local_compartilhamentos',
        'app.escolas',
        'app.escola_locais',
    ];
    
    /**
     * Repositório a ser testado
     *
     * @var \GRE\Model\Table\EscolaLocalCompartilhamentosTable
     */
    public $EscolaLocalCompartilhamentos;
    
    /**
     * Configurações dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->EscolaLocalCompartilhamentos = TableRegistry::get('EscolaLocalCompartilhamentos');
    }
    
    /**
     * Teste do método get(), com um compartilhamento válido
     */
    public function testGet()
    {
        $expected = [
            'id' => 1,
            'escola_local' => [
                'id' => 1,
                'escola_id' => 1,
                'escola' => [
                    'id' => '1',
                    'nome_curto' => 'NOME_CURTO_1',
                ],
            ],
            'escola' => [
                'id' => '2',
                'nome_curto' => 'NOME_CURTO_2',
            ],
        ];
        $escolaLocalCompartilhamento = $this->EscolaLocalCompartilhamentos->get(1);
        $this->assertInstanceOf('\GRE\Model\Entity\EscolaLocalCompartilhamento', $escolaLocalCompartilhamento);
        $this->assertEquals($escolaLocalCompartilhamento->toArray(), $expected);
    }
    
    /**
     * Teste do método get(), com o id de um compartilhamento excluído
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetEscolaLocalCompartilhamentoExcluido()
    {
        $this->EscolaLocalCompartilhamentos->get(2);
    }
    
    /**
     * Teste do método get(), com o id de um compartilhamento inexistente
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetEscolaLocalCompartilhamentoInexistente()
    {
        $this->EscolaLocalCompartilhamentos->get(99999);
    }
    
    /**
     * Teste do método get(), com o id de um compartilhamento nulo
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetEscolaLocalCompartilhamentoComIdNull()
    {
        $this->EscolaLocalCompartilhamentos->get(null);
    }
    
    /**
     * Teste do método setDeleted
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function setDeleted()
    {
        $escolaLocalCompartilhamento = $this->EscolaLocalCompartilhamentos->get(1);
        $this->assertInstanceOf('\GRE\Model\Entity\EscolaLocalCompartilhamento', $escolaLocalCompartilhamento);
        $this->EscolaLocalCompartilhamentos->setDeleted($escolaLocalCompartilhamento);
        $escolaLocalCompartilhamento = $this->EscolaLocalCompartilhamentos->get(1);
    }
}
