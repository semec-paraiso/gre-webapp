<?php

namespace GRE\Test\TestCase\Model\Entity;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para a entidade \GRE\Model\Entity\EscolaLocal
 */
class EscolaLocalTest extends TestCase
{
    /**
     * Fixtures utilizadas nos testes
     *
     * @var array
     */
    public $fixtures = [
        'app.escola_locais',
        'app.escola_salas',
        'app.escola_local_compartilhamentos',
    ];
    
    /**
     * Repositório EscolaLocais
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
     * Teste da propriedade qtdeSalas
     */
    public function testGetQtdeSalas()
    {
        $options = [
            'contain' => [
                'EscolaSalas' => [
                    'conditions' => [
                        'EscolaSalas.deleted' => false,
                    ],
                ],
            ],
        ];
        $escolaLocal = $this->EscolaLocais->get(4, $options);
        $this->assertEquals($escolaLocal->qtdeSalas, 1);
        $escolaLocal = $this->EscolaLocais->get(1, $options);
        $this->assertEquals($escolaLocal->qtdeSalas, 1);
        $escolaLocal = $this->EscolaLocais->get(3, $options);
        $this->assertEquals($escolaLocal->qtdeSalas, 0);
    }
    
    /**
     * Teste da propriedade qtdeSalas, sem carregar as salas
     * 
     * @expectedException \Exception
     */
    public function testGetQtdeSalasDeEntidadeIncompleta()
    {
        $escolaLocal = $this->EscolaLocais->get(1);
        $escolaLocal->qtdeSalas;
    }
    
    /**
     * Teste da propriedade qtdeCompartilhamentos
     */
    public function testGetQtdeCompartilhamentos()
    {
        $options = [
            'contain' => [
                'EscolaLocalCompartilhamentos' => [
                    'conditions' => [
                        'EscolaLocalCompartilhamentos.deleted' => false,
                    ],
                ],
            ],
        ];
        $escolaLocal = $this->EscolaLocais->get(1, $options);
        $this->assertEquals($escolaLocal->qtdeCompartilhamentos, 1);
        $escolaLocal = $this->EscolaLocais->get(4, $options);
        $this->assertEquals($escolaLocal->qtdeCompartilhamentos, 2);
        $escolaLocal = $this->EscolaLocais->get(3, $options);
        $this->assertEquals($escolaLocal->qtdeCompartilhamentos, 0);
    }
    
    /**
     * Teste da propriedade qtdeCompartilhamentos, sem carregar os 
     * compartilhamentos na entidade
     * 
     * @expectedException \Exception
     */
    public function testGetQtdeCompartilhamentosDeEntidadeIncompleta()
    {
        $escolaLocal = $this->EscolaLocais->get(1);
        $escolaLocal->qtdeCompartilhamentos;
    }
}
