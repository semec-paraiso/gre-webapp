<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para o repositório \GRE\Model\Table\MunicipiosTable
 */
class DistritosTableTest extends TestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = ['app.distritos'];
    
    /**
     * Repositório testado
     *
     * @var \GRE\Model\Table\MunicipiosTable
     */
    public $Distritos;
    
    /**
     * Configurações do caso de teste
     */
    public function setUp()
    {
        parent::setUp();
        $this->Distritos = TableRegistry::get('Distritos');
    }
    
    /**
     * Teste do método listarPorMunicipio() passando um município inexistente
     */
    public function testListarPorMunicipioWithAnInvalidMunicipio()
    {
        $this->assertEquals($this->Distritos->listarPorMunicipio(0)->count(), 0);
    }
    
    /**
     * Teste do método listarPorMunicipio passando um Município válido
     */
    public function testListarPorMunicipioWithAValidMunicipio()
    {
        $expected = [
            array(
                'id' => 2,
                'inep_codigo' => 22222,
                'nome' => 'NOME_2',
            ),
            array(
                'id' => 3,
                'inep_codigo' => 33333,
                'nome' => 'NOME_3',
            ),
            array(
                'id' => 4,
                'inep_codigo' => 44444,
                'nome' => 'NOME_4',
            ),
        ];
        
        $distritos = $this->Distritos->listarPorMunicipio(3);
        
        $this->assertInstanceOf('Cake\ORM\Query', $distritos);
        
        foreach($distritos as $key => $distrito) {
            $this->assertEquals($distrito->id, $expected[$key]['id']);
            $this->assertEquals($distrito->inep_codigo, $expected[$key]['inep_codigo']);
            $this->assertEquals($distrito->nome, $expected[$key]['nome']);
        }
    }
}
