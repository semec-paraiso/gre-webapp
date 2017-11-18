<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para o repositório \GRE\Model\Table\MunicipiosTable
 */
class MunicipiosTableTest extends TestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = ['app.municipios'];
    
    /**
     * Repositório testado
     *
     * @var \GRE\Model\Table\MunicipiosTable
     */
    public $Municipios;
    
    /**
     * Configurações do caso de teste
     */
    public function setUp()
    {
        parent::setUp();
        $this->Municipios = TableRegistry::get('Municipios');
    }
    
    /**
     * Teste do método listarPorUf() passando uma UF inexistente
     */
    public function testListarPorUfwithAnInvalidUf()
    {
        $this->assertEquals($this->Municipios->listarPorUf(0)->count(), 0);
    }
    
    /**
     * Teste do método listarPorUf passando uma UF válida
     */
    public function testListarPorUfwithAValidUf()
    {
        $expected = [
            array(
                'id' => 5,
                'inep_codigo' => 55555,
                'nome' => 'Araguaína',
            ),
            array(
                'id' => 4,
                'inep_codigo' => 4444,
                'nome' => 'Gurupi',
            ),
            array(
                'id' => 3,
                'inep_codigo' => 33333,
                'nome' => 'Palmas',
            ),
        ];
        
        foreach($this->Municipios->listarPorUf(2) as $key => $municipio) {
            $this->assertEquals($municipio->id, $expected[$key]['id']);
            $this->assertEquals($municipio->inep_codigo, $expected[$key]['inep_codigo']);
            $this->assertEquals($municipio->nome, $expected[$key]['nome']);
        }
    }
}
