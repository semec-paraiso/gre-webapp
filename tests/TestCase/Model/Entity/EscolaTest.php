<?php

namespace GRE\Test\TestCase\Model\Entity;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para a entidade \GRE\Model\Entity\Escola
 */
class EscolaTest extends TestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = [
        'app.escolas',
        'app.escola_locais',
        'app.escola_salas',
        'app.escola_local_compartilhamentos',
        'app.distritos',
        'app.ufs',
        'app.municipios',
    ];
    
    /**
     * Repositório Escolas
     *
     * @var \GRE\Model\Table\EscolasTable
     */
    public $Escolas;
    
    /**
     * Configurações dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->Escolas = TableRegistry::get('Escolas');
    }
    
    /**
     * Testa o método geQtdeSalas()
     */
    public function testGetQtdeSalas()
    {
        $escola = $this->Escolas->getSalas(1);
        $this->assertEquals($escola->qtdeSalas, 1);
        
        $escola = $this->Escolas->getSalas(2);
        $this->assertEquals($escola->qtdeSalas, 2);
    }
    
    /**
     * Testa o método geQtdeSalas() sem carregar as salas de aula na entidade
     * 
     * @expectedException \Exception
     */
    public function testGetQtdeSalasComEntidadeIncompleta()
    {
        $escola = $this->Escolas->get(1);
        $this->assertEquals($escola->qtdeSalas, 0);
    }
    
    /**
     * Testa o método geQtdeCompartilhamentos()
     */
    public function testGetQtdeCompartilhamentos()
    {
        $escola = $this->Escolas->getCompartilhamentos(1);
        $this->assertEquals($escola->qtdeCompartilhamentos, 1);
        
        $escola = $this->Escolas->getCompartilhamentos(2);
        $this->assertEquals($escola->qtdeCompartilhamentos, 2);
    }
    
    /**
     * Testa o método geQtdeCompartilhamentos()
     * 
     * @expectedException \Exception
     */
    public function testGetQtdeCompartilhamentosComEntidadeIncompleta()
    {
        $escola = $this->Escolas->get(2);
        $this->assertEquals($escola->qtdeCompartilhamentos, 2);
    }
}
