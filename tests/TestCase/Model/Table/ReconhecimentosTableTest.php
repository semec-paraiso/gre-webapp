<?php

namespace GRE\Test\TestCase\Model\Table;

use ArrayObject;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\I18n\FrozenDate;

/**
 * Caso de teste do repositório \GRE\Model\Table\ReconhecimentosTable
 */
class ReconhecimentosTableTest extends TestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = [
        'app.reconhecimentos',
        'app.escolas',
    ];
    
    /**
     * Repositório testado
     *
     * @var \GRE\Model\Table\ReconhecimentosTable
     */
    public $Reconhecimentos;
    
    /**
     * Configurações dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->Reconhecimentos = TableRegistry::get('Reconhecimentos');
    }
    
    /**
     * Teste do método beforeMarshal()
     */
    public function testBeforeMarshal()
    {
        $data = new ArrayObject([
            'validade' => '24/11/2017',
            'foo' => 'bar',
        ]);
        $expected = new ArrayObject([
            'validade' => '2017-11-24',
            'foo' => 'bar',
        ]);
        $data = $this->Reconhecimentos->beforeMarshal(new Event('none'), $data, new ArrayObject);
        $this->assertEquals($data, $expected);
    }
    
    /**
     * Teste do método get(), com o id de um Reconhecimento válido
     */
    public function testGet()
    {
        $expected = [
            'id' => 1,
            'curso' => 'CURSO_1',
            'ato' => 'ATO_1',
            'validade' => new FrozenDate('2017-11-22'),
            'deleted' => 0,
            'escola' => [
                'id' => 1,
                'nome_curto' => 'NOME_CURTO_1',
            ],
        ];
        $reconhecimento = $this->Reconhecimentos->get(1);
        $this->assertInstanceOf('\GRE\Model\Entity\Reconhecimento', $reconhecimento);
        $this->assertEquals($reconhecimento->toArray(), $expected);
    }
    
    /**
     * Teste do método get(), com o id de um Reconhecimento excluído
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetReconhecimentoExcluido()
    {
        $this->Reconhecimentos->get(3);
    }
    
    /**
     * Teste do método get(), com o id de um Reconhecimento inexistente
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetReconhecimentoInexistente()
    {
        $this->Reconhecimentos->get(99999);
    }
    
    /**
     * Teste do método get(), com o id nulo
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetReconhecimentoComIdNull()
    {
        $this->Reconhecimentos->get(null);
    }
    
    /**
     * Teste do método setDeleted()
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testSetDeleted()
    {
        $reconhecimento = $this->Reconhecimentos->get(1);
        $this->assertInstanceOf('\GRE\Model\Entity\Reconhecimento', $reconhecimento);
        $this->Reconhecimentos->setDeleted($reconhecimento);
        $reconhecimento = $this->Reconhecimentos->get(1);
    }
}
