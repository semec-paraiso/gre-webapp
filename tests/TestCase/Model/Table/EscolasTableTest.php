<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenDate;

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
        'app.escola_salas',
        'app.escola_situacoes',
        'app.escola_locais',
        'app.escola_local_tipos',
        'app.escola_local_compartilhamentos',
        'app.predio_ocupacao_formas',
        'app.distritos',
        'app.municipios',
        'app.ufs',
        'app.reconhecimentos',
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
     * Teste do método getIdentificacao(), informando o id inexistente
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetIdentificacaoComEscolaExcluida()
    {
        $this->Escolas->getIdentificacao(3);
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
    
    /**
     * Teste do método getLegislacaoFuncionamento(), com uma escola válida
     */
    public function testGetLegislacaoFuncionamentoComEscolaValida()
    {
        $expected = [
            'id' => 1,
            'rede' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'leg_criacao' => 'LEG_CRIACAO_1',
            'leg_denominacao' => 'LEG_DENOMINACAO_1',
            'deleted' => 0,
        ];
        $escola = $this->Escolas->getLegislacaoFuncionamento(1)
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getLegislacaoFuncionamento, com uma escola inválida
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetLegislacaoFuncionamentoComEscolaInvalida()
    {
        $this->Escolas->getLegislacaoFuncionamento(999999);
    }
    
    /**
     * Teste do método getLegislacaoFuncionamento(), com uma escola excluída
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetLegislacaoFuncionamentoComEscolaExcluida()
    {
        $this->Escolas->getLegislacaoFuncionamento(3);
    }
    
    /**
     * Teste do método getLegislacaoFuncionamento(), com um id nulo
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetLegislacaoFuncionamentoComIdNulo()
    {
        $this->Escolas->getLegislacaoFuncionamento(null);
    }

    /**
     * Teste do método getReconhecimentos(), com uma escola válida
     */
    public function testGetReconhecimentos()
    {
        $expected = [
            'id' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'reconhecimentos' => [
                array(
                    'escola_id' => 1,
                    'curso' => 'CURSO_1',
                    'ato' => 'ATO_1',
                    'validade' => new FrozenDate('2017-11-22'),
                    'deleted' => 0
                ),
                array(
                    'escola_id' => 1,
                    'curso' => 'CURSO_2',
                    'ato' => 'ATO_2',
                    'validade' => new FrozenDate('2017-11-22'),
                    'deleted' => 0
                ),
            ]
        ];
        $escola = $this->Escolas->getReconhecimentos(1)
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getReconhecimentos(), com uma escola válida sem nenhum
     * reconhecimento cadastrado
     */
    public function testGetReconhecimentosComEscolaValidaSemReconhecimentos()
    {
        $expected = [
            'id' => 2,
            'nome_curto' => 'NOME_CURTO_2',
            'reconhecimentos' => []
        ];
        $escola = $this->Escolas->getReconhecimentos(2)
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getReconhecimentos(), com uma escola inválida
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetReconhecimentosComEscolaInvalida()
    {
        $escola = $this->Escolas->getReconhecimentos(9999);
    }
    
    /**
     * Teste do método getReconhecimentos(), com um id nulo
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetReconhecimentosComIdDaEscolaNull()
    {
        $escola = $this->Escolas->getReconhecimentos(null);
    }
    
    /**
     * Teste do método getReconhecimentos(), com uma escola excluída
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetReconhecimentosComEscolaExcluida()
    {
        $escola = $this->Escolas->getReconhecimentos(3);
    }
    
    /**
     * Teste do método getCaracterizacao(), com uma escola válida
     */
    public function testGetCaracterizacao()
    {
        $expected = [
            'id' => 1,
            'rede' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'infra_agua_filtrada' => 1,
            'infra_agua_abast_publica' => 1,
            'infra_agua_abast_poco' => 0,
            'infra_agua_abast_cacimba' => 0,
            'infra_agua_abast_fonte' => 0,
            'infra_agua_abast_inexistente' => 0,
            'infra_energia_abast_publica' => 1,
            'infra_energia_abast_gerador' => 0,
            'infra_energia_abast_outros' => 0,
            'infra_energia_abast_inexistente' => 0,
            'infra_esgoto_rede' => 0,
            'infra_esgoto_fossa' => 1,
            'infra_esgoto_inexistente' => 0,
            'infra_lixo_coleta' => 1,
            'infra_lixo_queima' => 0,
            'infra_lixo_joga' => 0,
            'infra_lixo_recicla' => 1,
            'infra_lixo_enterra' => 0,
            'infra_lixo_outros' => 0,
            'infra_dep_almoxarifado' => 0,
            'infra_dep_alojamento_aluno' => 0,
            'infra_dep_alojamento_professor' => 0,
            'infra_dep_area_verde' => 1,
            'infra_dep_auditorio' => 0,
            'infra_dep_banheiro_acessivel' => 1,
            'infra_dep_banheiro_infantil' => 1,
            'infra_dep_banheiro_chuveiro' => 0,
            'infra_dep_banheiro_dentro' => 1,
            'infra_dep_banheiro_fora' => 0,
            'infra_dep_bercario' => 0,
            'infra_dep_biblioteca' => 1,
            'infra_dep_vias_deficientes' => 1,
            'infra_dep_lab_ciencias' => 0,
            'infra_dep_lab_informatica' => 0,
            'infra_dep_lavanderia' => 0,
            'infra_dep_parque_infantil' => 1,
            'infra_dep_patio_coberto' => 1,
            'infra_dep_patio_descoberto' => 1,
            'infra_dep_quadra_coberta' => 0,
            'infra_dep_quadra_descoberta' => 1,
            'infra_dep_refeitorio' => 0,
            'infra_dep_sala_diretoria' => 1,
            'infra_dep_sala_leitura' => 1,
            'infra_dep_sala_professores' => 1,
            'infra_dep_sala_recursos' => 0,
            'infra_dep_nenhuma' => 0,
            'infra_equip_parabolica' => 1,
            'infra_equip_dvd' => 1,
            'infra_equip_som' => 2,
            'infra_equip_tv' => 2,
            'infra_equip_copiadora' => 2,
            'infra_equip_fax' => 0,
            'infra_equip_impressora' => 3,
            'infra_equip_impressora_multi' => 1,
            'infra_equip_filmadora' => 1,
            'infra_equip_projetor' => 1,
            'infra_equip_retroprojetor' => 1,
            'infra_equip_videocassete' => 1,
            'infra_pc_admin' => 8,
            'infra_pc_alunos' => 0,
            'infra_internet' => 1,
            'infra_internet_banda_larga' => 1, 
            'deleted' => 0,            
        ];
        $escola = $this->Escolas->getCaracterizacao(1)
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getCaracterizacao(), com um id nulo
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetCaracterizacaoComIdDaEscolaNull()
    {
        $this->Escolas->getCaracterizacao(null);
    }
    
    /**
     * Teste do método getCaracterizacao(), com uma escola inválida
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetCaracterizacaoDeEscolaInexistente()
    {
        $this->Escolas->getCaracterizacao(999999);
    }
    
    /**
     * Teste do método getCaracterizacao(), com uma escola excluída
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetCaracterizacaoDeEscolaExcluida()
    {
        $this->Escolas->getCaracterizacao(3);
    }
    
    /**
     * Teste do método getContatos(), com uma escola válida
     */
    public function testGetContatos()
    {
        $expected = [
            'id' => 1,
            'rede' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'fone_1' => 'FONE1_1',
            'fone_2' => 'FONE2_1',
            'fone_3' => 'FONE3_1',
            'fone_4' => 'FONE4_1',
            'email' => 'EMAIL_1',
            'website' => 'WEBSITE_1',
            'deleted' => 0,
        ];
        $escola = $this->Escolas->getContatos(1)
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }

    /**
     * Teste do método getContatos(), com uma escola inválida
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetContatosDeEscolaInexistente()
    {
        $escola = $this->Escolas->getContatos(99999);
    }
    
    /**
     * Teste do método getContatos(), com uma escola excluída
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetContatosDeEscolaExcluida()
    {
        $escola = $this->Escolas->getContatos(3);
    }
    
    /**
     * Teste do método getContatos(), com um id nulo
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetContatosComIdDaEscolaNull()
    {
        $escola = $this->Escolas->getContatos(null);
    }
    
    /**
     * Teste do método getLocais(), com uma escola válida
     */
    public function testGetLocais()
    {
        $expected = [
            'id' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'escola_locais' => [
                array(
                    'id' => 1,
                    'nome' => 'NOME_1',
                    'escola_id' => 1,
                    'escola_local_tipo_id' => 1,
                    'predio_ocupacao_forma_id' => 1,
                    'deleted' => 0,
                    'predio_ocupacao_forma' => [
                        'id' => 1,
                        'nome' => 'NOME_1',
                    ],
                    'escola_local_tipo' => [
                        'id' => 1,
                        'nome' => 'NOME_1',
                    ],
                ),
                array(
                    'id' => 3,
                    'nome' => 'NOME_3',
                    'escola_id' => 1,
                    'escola_local_tipo_id' => 3,
                    'predio_ocupacao_forma_id' => 3,
                    'deleted' => 0,
                    'predio_ocupacao_forma' => [
                        'id' => 3,
                        'nome' => 'NOME_3',
                    ],
                    'escola_local_tipo' => [
                        'id' => 3,
                        'nome' => 'NOME_3',
                    ],
                ),
            ],
        ];
        $escola = $this->Escolas->getLocais(1)
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getLocais(), com uma escola sem locais cadastrados
     */
    public function testGetLocaisDeEscolaSemLocais()
    {
        $expected = [
            'id' => 4,
            'nome_curto' => 'NOME_CURTO_4',
            'escola_locais' => [],
        ];
        $escola = $this->Escolas->getLocais(4)
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getLocais(), com uma escola excluída
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetLocaisDeEscolaExcluida()
    {
        $this->Escolas->getLocais(3);
    }
    
    /**
     * Teste do método getLocais(), com uma escola inexistente
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetLocaisDeEscolaInexistente()
    {
        $this->Escolas->getLocais(99999);
    }
    
    /**
     * Teste do método getLocais(), com um id nulo
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetLocaisDeEscolaComIdNull()
    {
        $this->Escolas->getLocais(null);
    }
    
    /**
     * Teste do método getSalas(), com uma escola válida
     */
    public function testGetSalas()
    {
        $expected = [
            'id' => 1,
            'rede' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'deleted' => 0,
            'escola_locais' => [
                array(
                    'id' => 1,
                    'escola_id' => 1,
                    'nome' => 'NOME_1',
                    'deleted' => 0,
                    'escola_salas' => [
                        array(
                            'id' => 1,
                            'escola_local_id' => 1,
                            'nome' => 'NOME_1',
                            'capacidade' => 30,
                            'deleted' => 0,
                        ),
                    ],
                ),
                array(
                    'id' => 3,
                    'escola_id' => 1,
                    'nome' => 'NOME_3',
                    'deleted' => 0,
                    'escola_salas' => [],
                ),
            ],
        ];
        $escola = $this->Escolas->getSalas(1)
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getSalas(), com uma escola válida, com um filtro de local
     * válido
     */
    public function testGetSalasComFiltroDeLocalValido()
    {
        $expected = [
            'id' => 1,
            'rede' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'deleted' => 0,
            'escola_locais' => [
                array(
                    'id' => 1,
                    'escola_id' => 1,
                    'nome' => 'NOME_1',
                    'deleted' => 0,
                    'escola_salas' => [
                        array(
                            'id' => 1,
                            'escola_local_id' => 1,
                            'nome' => 'NOME_1',
                            'capacidade' => 30,
                            'deleted' => 0,
                        ),
                    ],
                ),
            ],
        ];
        $escola = $this->Escolas->getSalas(1, ['escola_local_id' => 1])
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getSalas(), com uma escola válida, com um filtro para
     * um local inexistente
     */
    public function testGetSalasComFiltroDeLocalInexistente()
    {
        $expected = [
            'id' => 1,
            'rede' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'deleted' => 0,
            'escola_locais' => [],
        ];
        $escola = $this->Escolas->getSalas(1, ['escola_local_id' => 99999])
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getSalas(), com uma escola inexistente
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetSalasDeEscolaInexistente()
    {
        $escola = $this->Escolas->getSalas(99999);
    }
    
    /**
     * Teste do método getSalas(), com uma escola excluída
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetSalasDeEscolaExcluida()
    {
        $escola = $this->Escolas->getSalas(3);
    }
    
    /**
     * Teste do método getSalas(), com uma escola com id null
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetSalasDeEscolaComIdNull()
    {
        $escola = $this->Escolas->getSalas(null);
    }
    
    /**
     * Teste do método getSalas(), com uma escola com id inválido
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetSalasDeEscolaComIdInvalido()
    {
        $escola = $this->Escolas->getSalas('INVALIDO');
    }
    
    /**
     * Teste do método getCompartilhamentos(), com uma escola válida
     */
    public function testGetCompartilhamentos()
    {
        $expected = [
            'id' => 1,
            'rede' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'deleted' => 0,
            'escola_locais' => [
                array(
                    'id' => 1,
                    'escola_id' => 1,
                    'escola_local_compartilhamentos' => [
                        array(
                            'id' => 1,
                            'escola_local_id' => 1,
                            'escola_id' => 2,
                            'escola' => [
                                'id' => 2,
                                'nome_curto' => 'NOME_CURTO_2',
                                'inep_codigo' => '22222222',
                                'endereco_distrito' => [
                                    'id' => 1,
                                    'municipio_id' => 1,
                                    'municipio' => [
                                        'id' => 1,
                                        'uf_id' => 1,
                                        'nome' => 'NOME_1',
                                        'uf' => [
                                            'id' => 1,
                                            'sigla' => 'S1',
                                        ]
                                    ]
                                ]
                            ]
                        ),
                    ],
                ),
                array(
                    'id' => 3,
                    'escola_id' => 1,
                    'escola_local_compartilhamentos' => [],
                ),
            ],
        ];
        $escola = $this->Escolas->getCompartilhamentos(1)
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getCompartilhamentos(), com uma escola válida, com filtro
     * para um local válido
     */
    public function testGetCompartilhamentosComFiltro()
    {
        $expected = [
            'id' => 1,
            'rede' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'deleted' => 0,
            'escola_locais' => [
                array(
                    'id' => 3,
                    'escola_id' => 1,
                    'escola_local_compartilhamentos' => [],
                ),
            ],
        ];
        $escola = $this->Escolas->getCompartilhamentos(1, ['escola_local_id' => 3])
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getCompartilhamentos(), com uma escola válida, com filtro
     * para um local inexistente
     */
    public function testGetCompartilhamentosComFiltroInvalido()
    {
        $expected = [
            'id' => 1,
            'rede' => 1,
            'nome_curto' => 'NOME_CURTO_1',
            'deleted' => 0,
            'escola_locais' => [],
        ];
        $escola = $this->Escolas->getCompartilhamentos(1, ['escola_local_id' => 99999])
                                ->toArray();
        $this->assertEquals($escola, $expected);
    }
    
    /**
     * Teste do método getCompartilhamentos(), com uma escola inexistente
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetCompartilhamentosDeEscolaInexistente()
    {
        $this->Escolas->getCompartilhamentos(99999);
    }
    
    /**
     * Teste do método getCompartilhamentos(), com uma escola inexistente
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetCompartilhamentosDeEscolaExcluida()
    {
        $this->Escolas->getCompartilhamentos(3);
    }
    
    /**
     * Teste do método getCompartilhamentos(), com uma escola com id null
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetCompartilhamentosDeEscolaComIdNull()
    {
        $this->Escolas->getCompartilhamentos(null);
    }
    
    /**
     * Teste do método getCompartilhamentos(), com uma escola com id inválido
     * 
     * @expectedException \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function testGetCompartilhamentosDeEscolaComIdInvalido()
    {
        $this->Escolas->getCompartilhamentos('INVALIDO');
    }
    
    /**
     * Teste do método PatchIdentificacao()
     */
    public function testPatchIdentificacao()
    {
        $data = [
            'id' => 1,
            'situacao_id' => 1,
            'inep_codigo' => '999',
            'inep_codigo_TO_DISCARD' => '999',
            'nome_curto' => 'xxxxx',
            'nome_longo' => 'xxxxx',
            'nome_longo_TO_DISCARD' => 'xxxxx',
            'nome_juridico' => 'xxxxx',
            'endereco_cep' => 'xxxxxxxx',
            'endereco_distrito_id' => 1,
            'endereco_logradouro' => 'xxxx',
            'endereco_logradouro_TO_DISCARD' => 'xxxx',
            'endereco_numero' => 'xxxx',
            'endereco_complemento' => 'xxxx',
            'endereco_bairro' => 'xxxx',
        ];
        $expected = [
            'id' => 1,
            'situacao_id' => 1,
            'inep_codigo' => '999',
            'nome_curto' => 'xxxxx',
            'nome_longo' => 'xxxxx',
            'nome_juridico' => 'xxxxx',
            'endereco_cep' => 'xxxxxxxx',
            'endereco_distrito_id' => 1,
            'endereco_logradouro' => 'xxxx',
            'endereco_numero' => 'xxxx',
            'endereco_complemento' => 'xxxx',
            'endereco_bairro' => 'xxxx',
        ];
        $escola = $this->Escolas->newEntity();
        $escola = $this->Escolas->patchIdentificacao($escola, $data);
        $this->assertEquals($escola->toArray(), $expected);
    }
    
    /**
     * Teste do método PatchLegislacaoFuncionamento()
     */
    public function testPatchLegislacaoFuncionamento()
    {
        $data = [
            'id_TO_DISCARD' => 1,
            'id' => 1,
            'leg_criacao' => 'lllllll',
            'leg_criacaod_TO_DISCARD' => 'lllllll',
            'leg_denominacao' => 'lllllll',
            'leg_denominacaod_TO_DISCARD' => 'lllllll',
        ];
        $expected = [
            'id' => 1,
            'leg_criacao' => 'lllllll',
            'leg_denominacao' => 'lllllll',
        ];
        $escola = $this->Escolas->newEntity();
        $escola = $this->Escolas->patchLegislacaoFuncionamento($escola, $data);
        $this->assertEquals($escola->toArray(), $expected);
    }
    
    /**
     * Teste do método patchContatos()
     */
    public function testPatchContatos()
    {
        $data = [
            'id' => 1,
            'fone_1' => 'ttttt',
            'fone_1_TO_DISCARD' => 'ttttt',
            'fone_2' => 'ttttt',
            'fone_2_TO_DISCARD' => 'ttttt',
            'fone_3' => 'ttttt',
            'fone_3_TO_DISCARD' => 'ttttt',
            'fone_4' => 'ttttt',
            'email_TO_DISCARD' => 'tttttt',
            'email' => 'tttttt',
            'website' => 'http://www.lol',
        ];
        $expected = [
            'id' => 1,
            'fone_1' => 'ttttt',
            'fone_2' => 'ttttt',
            'fone_3' => 'ttttt',
            'fone_4' => 'ttttt',
            'email' => 'tttttt',
            'website' => 'http://www.lol',
        ]; 
        $escola = $this->Escolas->newEntity();
        $escola = $this->Escolas->patchContatos($escola, $data);
        $this->assertEquals($escola->toArray(), $expected);
    }
    
    /**
     * Teste do método PatchCaracterizacao()
     */
    public function testPatchCaracterizacao()
    {
        $data = [
            'id' => 1,
            'infra_agua_filtrada' => 1,
            'infra_agua_abast_publica' => 1,
            'infra_agua_abast_poco' => 1,
            'infra_agua_abast_cacimba' => 1,
            'infra_agua_abast_fonte' => 1,
            'infra_agua_abast_inexistente' => 1,
            'infra_energia_abast_publica' => 1,
            'infra_energia_abast_gerador' => 1,
            'infra_energia_abast_outros' => 1,
            'infra_energia_abast_inexistente' => 1,
            'infra_esgoto_rede' => 1,
            'infra_esgoto_fossa' => 1,
            'infra_esgoto_inexistente' => 1,
            'infra_lixo_coleta' => 1,
            'infra_lixo_queima' => 1,
            'infra_lixo_joga' => 1,
            'infra_lixo_recicla' => 1,
            'infra_lixo_enterra' => 1,
            'infra_lixo_outros' => 1,
            'infra_dep_almoxarifado' => 1,
            'infra_dep_alojamento_aluno' => 1,
            'infra_dep_alojamento_professor' => 1,
            'infra_dep_area_verde' => 1,
            'infra_dep_auditorio' => 1,
            'infra_dep_banheiro_acessivel' => 1,
            'infra_dep_banheiro_infantil' => 1,
            'infra_dep_banheiro_chuveiro' => 1,
            'infra_dep_banheiro_dentro' => 1,
            'infra_dep_banheiro_fora' => 1,
            'infra_dep_bercario' => 1,
            'infra_dep_biblioteca' => 1,
            'infra_dep_vias_deficientes' => 1,
            'infra_dep_lab_ciencias' => 1,
            'infra_dep_lab_informatica' => 1,
            'infra_dep_lavanderia' => 1,
            'infra_dep_parque_infantil' => 1,
            'infra_dep_patio_coberto' => 1,
            'infra_dep_patio_descoberto' => 1,
            'infra_dep_quadra_coberta' => 1,
            'infra_dep_quadra_descoberta' => 1,
            'infra_dep_refeitorio' => 1,
            'infra_dep_sala_diretoria' => 1,
            'infra_dep_sala_leitura' => 1,
            'infra_dep_sala_professores' => 1,
            'infra_dep_sala_recursos' => 1,
            'infra_dep_nenhuma' => 1,
            'infra_equip_parabolica' => 1,
            'infra_equip_dvd' => 1,
            'infra_equip_som' => 1,
            'infra_equip_tv' => 1,
            'infra_equip_copiadora' => 1,
            'infra_equip_fax' => 1,
            'infra_equip_impressora' => 1,
            'infra_equip_impressora_multi' => 1,
            'infra_equip_filmadora' => 1,
            'infra_equip_projetor' => 1,
            'infra_equip_retroprojetor' => 1,
            'infra_equip_videocassete' => 1,
            'infra_pc_admin' => 1,
            'infra_pc_alunos' => 1,
            'infra_internet' => 1,
            'infra_internet_banda_larga' => 1,
            'INVALID' => 1,
        ];
        $expected = [
            'id' => 1,
            'infra_agua_filtrada' => 1,
            'infra_agua_abast_publica' => 1,
            'infra_agua_abast_poco' => 1,
            'infra_agua_abast_cacimba' => 1,
            'infra_agua_abast_fonte' => 1,
            'infra_agua_abast_inexistente' => 1,
            'infra_energia_abast_publica' => 1,
            'infra_energia_abast_gerador' => 1,
            'infra_energia_abast_outros' => 1,
            'infra_energia_abast_inexistente' => 1,
            'infra_esgoto_rede' => 1,
            'infra_esgoto_fossa' => 1,
            'infra_esgoto_inexistente' => 1,
            'infra_lixo_coleta' => 1,
            'infra_lixo_queima' => 1,
            'infra_lixo_joga' => 1,
            'infra_lixo_recicla' => 1,
            'infra_lixo_enterra' => 1,
            'infra_lixo_outros' => 1,
            'infra_dep_almoxarifado' => 1,
            'infra_dep_alojamento_aluno' => 1,
            'infra_dep_alojamento_professor' => 1,
            'infra_dep_area_verde' => 1,
            'infra_dep_auditorio' => 1,
            'infra_dep_banheiro_acessivel' => 1,
            'infra_dep_banheiro_infantil' => 1,
            'infra_dep_banheiro_chuveiro' => 1,
            'infra_dep_banheiro_dentro' => 1,
            'infra_dep_banheiro_fora' => 1,
            'infra_dep_bercario' => 1,
            'infra_dep_biblioteca' => 1,
            'infra_dep_vias_deficientes' => 1,
            'infra_dep_lab_ciencias' => 1,
            'infra_dep_lab_informatica' => 1,
            'infra_dep_lavanderia' => 1,
            'infra_dep_parque_infantil' => 1,
            'infra_dep_patio_coberto' => 1,
            'infra_dep_patio_descoberto' => 1,
            'infra_dep_quadra_coberta' => 1,
            'infra_dep_quadra_descoberta' => 1,
            'infra_dep_refeitorio' => 1,
            'infra_dep_sala_diretoria' => 1,
            'infra_dep_sala_leitura' => 1,
            'infra_dep_sala_professores' => 1,
            'infra_dep_sala_recursos' => 1,
            'infra_dep_nenhuma' => 1,
            'infra_equip_parabolica' => 1,
            'infra_equip_dvd' => 1,
            'infra_equip_som' => 1,
            'infra_equip_tv' => 1,
            'infra_equip_copiadora' => 1,
            'infra_equip_fax' => 1,
            'infra_equip_impressora' => 1,
            'infra_equip_impressora_multi' => 1,
            'infra_equip_filmadora' => 1,
            'infra_equip_projetor' => 1,
            'infra_equip_retroprojetor' => 1,
            'infra_equip_videocassete' => 1,
            'infra_pc_admin' => 1,
            'infra_pc_alunos' => 1,
            'infra_internet' => 1,
            'infra_internet_banda_larga' => 1,
        ]; 
        $escola = $this->Escolas->newEntity();
        $escola = $this->Escolas->patchCaracterizacao($escola, $data);
        $this->assertEquals($escola->toArray(), $expected);
    }
    
    /**
     * Teste do método greRetirar()
     */
    public function testGreRegirar()
    {
        $escola = $this->Escolas->get(1);
        $this->assertEquals($escola->rede, 1);
        $this->Escolas->greRetirar($escola);
        $escola = $this->Escolas->get(1);
        $this->assertEquals($escola->rede, 0);
    }
    
    /**
     * Teste do método greIntegrar()
     */
    public function testGreIntegrar()
    {
        $escola = $this->Escolas->get(4);
        $this->assertEquals($escola->rede, 0);
        $this->Escolas->greIntegrar($escola);
        $escola = $this->Escolas->get(4);
        $this->assertEquals($escola->rede, 1);
    }
}
