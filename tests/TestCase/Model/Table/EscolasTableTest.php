<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Test case para o repositório \GRE\Model\Table\EscolasTable
 */
class EscolasTableTest extends TestCase
{
    /**
     * Fixtures utilizados
     *
     * @var array
     */
    public $fixtures = [
        'app.escolas',
        'app.escola_situacoes',
        'app.distritos',
        'app.municipios',
        'app.ufs',
    ];
    
    /**
     * Repositório a ser testado
     *
     * @var \GRE\Model\Table\EscolasTable
     */
    public $Escolas;
    
    /**
     * Configuração dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->Escolas = TableRegistry::get('Escolas');
    }
    
    /**
     * Teste do método getFilters()
     */
    public function testGetFilters()
    {
        $expectedFilters = [
            'nome' => '',
            'situacao_id' => 0,
            'rede' => true,
        ];
        
        $this->assertEquals($this->Escolas->getFilters(), $expectedFilters);
    }
    
    /**
     * Teste do método newEntity()
     */
    public function testNewEntity()
    {
        $escola = $this->Escolas->newEntity();
        $this->assertInstanceOf('GRE\Model\Entity\Escola', $escola);
    }
    
    /**
     * Teste do método listar(), aplicando o filtro default
     */
    public function testListarComFiltroPadrao()
    {                
        $expected = [
            array(
                'id' => 1,
                'rede' => 1,
                'situacao_id' => 1,
                'inep_codigo' => '11111111',
                'nome_curto' => 'NOME_CURTO_1',
                'deleted' => 0,
                'endereco_distrito' => [
                    'id' => 1,
                    'municipio' => [
                        'nome' => 'NOME_1',
                        'uf' => [
                            'sigla' => 'S1',
                        ],
                    ],
                ],
                'escola_situacao' => [
                    'nome' => 'NOME_1',
                    '_webapp_css_class' => 'CSS_1',
                ],
            ),
            array(
                'id' => 2,
                'rede' => 1,
                'situacao_id' => 2,
                'inep_codigo' => '22222222',
                'nome_curto' => 'NOME_CURTO_2',
                'deleted' => 0,
                'endereco_distrito' => [
                    'id' => 1,
                    'municipio' => [
                        'nome' => 'NOME_1',
                        'uf' => [
                            'sigla' => 'S1',
                        ],
                    ],
                ],
                'escola_situacao' => [
                    'nome' => 'NOME_2',
                    '_webapp_css_class' => 'CSS_2',
                ],
            ),
        ];
        
        $escolas = $this->Escolas->listar($this->Escolas->getFilters());
        $this->assertEquals($escolas->hydrate(false)->toArray(), $expected);
    }
    
    /**
     * Teste do método listar(), aplicando um filtro personalizado
     */
    public function testListarComFiltroPersonalizado()
    {
        $filtros = [
            'nome' => 'NOME',
            'situacao_id' => 1,
            'rede' => true,
        ];
        
        $expected = [
            array(
                'id' => 1,
                'rede' => 1,
                'situacao_id' => 1,
                'inep_codigo' => '11111111',
                'nome_curto' => 'NOME_CURTO_1',
                'deleted' => 0,
                'endereco_distrito' => [
                    'id' => 1,
                    'municipio' => [
                        'nome' => 'NOME_1',
                        'uf' => [
                            'sigla' => 'S1',
                        ],
                    ],
                ],
                'escola_situacao' => [
                    'nome' => 'NOME_1',
                    '_webapp_css_class' => 'CSS_1',
                ],
            ),
        ];
        
        $escolas = $this->Escolas->listar($filtros);
        $this->assertEquals($escolas->hydrate(false)->toArray(), $expected);
    }
    
    /**
     * Teste do método listar(), aplicando um conjunto de parâmetros do filtro
     * para retornar nenhum resultado
     */
    public function testListarComFiltroInvalido()
    {
        $filtros = [
            'situacao_id' => -1,
        ];
        $escolas = $this->Escolas->listar($filtros);
        $this->assertInstanceOf('\Cake\ORM\Query', $escolas);
        
        $expected = [];
        
        $this->assertEquals($escolas->hydrate(false)->toArray(), $expected);
    }
    
    /**
     * Teste do método listarPorMunicipio(), informando o id existente
     */
    public function testListarPorMunicipioComMunicipioValido()
    {
        $expected = [
            array(
                'id' => 1,
                'nome_curto' => 'NOME_CURTO_1',
                'endereco_distrito_id' => 1,
                'deleted' => 0,
                'endereco_distrito' => [
                    'id' => 1,
                    'municipio_id' => 1,
                    'nome' => 'NOME_1',
                    'municipio' => [
                        'id' => 1,
                        'nome' => 'NOME_1',
                    ],
                ],
            ),
            array(
                'id' => 2,
                'nome_curto' => 'NOME_CURTO_2',
                'endereco_distrito_id' => 1,
                'deleted' => 0,
                'endereco_distrito' => [
                    'id' => 1,
                    'municipio_id' => 1,
                    'nome' => 'NOME_1',
                    'municipio' => [
                        'id' => 1,
                        'nome' => 'NOME_1',
                    ],
                ],
            ),
        ];
        
        $escolas = $this->Escolas->listarPorMunicipio(1)
                                 ->enableHydration(false)
                                 ->toArray();
        $this->assertEquals($escolas, $expected);
    }
    
    /**
     * Teste do método listarPorMunicipio(), informando o id de um município
     * inexistente
     */
    public function testListarPorMunicipioComMunicipioInvalido()
    {
        $this->assertEquals($this->Escolas->listarPorMunicipio(99999)->count(), 0);
    }
    
    /**
     * Teste do método listarPorMunicipio(), informando o id de um município
     * inexistente
     */
    public function testListarPorMunicipioComMunicipioNulo()
    {
        $this->assertEquals($this->Escolas->listarPorMunicipio(null)->count(), 0);
    }
    
    /**
     * Teste do método getIdentificacao(), informando o id existente
     */
    public function testGetIdentificacaoComEscolaValida()
    {
        $expected = [
            'id' => 2,
            'situacao_id' => 2,
            'rede' => 1,
            'inep_codigo' => '22222222',
            'nome_curto' => 'NOME_CURTO_2',
            'nome_longo' => 'NOME_LONGO_2',
            'nome_juridico' => 'NOME_JURIDICO_2',
            'endereco_cep' => '22222222',
            'endereco_logradouro' => 'ENDERECO_LOGRADOURO_2',
            'endereco_numero' => 'ENDERECO_NUMERO_2',
            'endereco_complemento' => 'ENDERECO_COMPLEMENTO_2',
            'endereco_bairro' => 'ENDERECO_BAIRRO_2',
            'deleted' => 0,
            'endereco_distrito' => [
                'nome' => 'NOME_1',
                'municipio_id' => 1,
                'municipio' => [
                    'id' => 1,
                    'nome' => 'NOME_1',
                    'uf_id' => 1,
                    'uf' => [
                        'id' => 1,
                        'sigla' => 'S1'
                    ],
                ],
            ],
            'escola_situacao' => [
                'nome' => 'NOME_2',
            ],
        ];
        
        $escola = $this->Escolas->getIdentificacao(2)->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getIdentificacao(), informando o id inexistente
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetIdentificacaoComEscolaInexistente()
    {
        $this->Escolas->getIdentificacao(99999);
    }
    
    /**
     * Teste do método getIdentificacao(), informando o id nulo
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetIdentificacaoComChavePrimariaNula()
    {
        $this->Escolas->getIdentificacao(null);
    }
    
    /*
    public function testGetLegislacaoFuncionamento()
    {
        
    }
    
    public function testGetReconhecimentos()
    {
        
    }
    
    public function testPatchIdentificacao()
    {
        
    }
    
    public function testPatchLegislacaoFuncionamento()
    {
        
    }
    
    public function testPatchContatos()
    {
        
    }
    
    public function testPatchCaracterizacao()
    {
        
    }
    
    public function testGetCaracterizacao()
    {
        
    }
    
    public function testGetContatos()
    {
        
    }
    
    public function testGetSalas()
    {
        
    }
    
    public function testGetCompartilhamentos()
    {
        
    }
    
    public function testGetRegirar()
    {
        
    }
    
    public function testGetIntegrar()
    {
        
    }
     * 
     */
}
