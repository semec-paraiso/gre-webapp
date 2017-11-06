<?php

namespace GRE\Model\Table;

use GRE\Model\Entity\Escola;
use Cake\Validation\Validator;
use Cake\ORM\Query;

/**
 * Repositório da entidade `Escola`
 *
 */
class EscolasTable extends Table
{
    protected $_filters = [
        'nome' => '',
        'situacao_id' => 0,
        'rede' => true,
    ];
    
    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {   
        $this->belongsTo('EscolaSituacoes', [
            'foreignKey'   => 'situacao_id',
            'propertyName' => 'escola_situacao',
        ]);
        $this->belongsTo('EnderecoDistrito', [
            'foreignKey'   => 'endereco_distrito_id',
            'className'    => 'Distritos',
            'propertyName' => 'endereco_distrito',
        ]);
        $this->hasMany('EscolaLocais');
        $this->hasMany('Reconhecimentos');
    }
    
    /**
     * Regras de validação default
     * 
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {   
        $validator->requirePresence('situacao_id', 'create');
        $validator->requirePresence('nome_curto', 'create');
        $validator->requirePresence('nome_longo', 'create');
        $validator->requirePresence('nome_juridico', 'create');
        $validator->requirePresence('endereco_cep', 'create');
        $validator->requirePresence('endereco_distrito_id', 'create');
        $validator->requirePresence('endereco_logradouro', 'create');
        $validator->requirePresence('endereco_bairro', 'create');
        
        $validator->notEmpty('situacao_id', 'Informe a situação');
        $validator->notEmpty('nome_curto', 'Informe um nome curto');
        $validator->notEmpty('nome_longo', 'Informe um nome longo');
        $validator->notEmpty('nome_juridico', 'Informe o nome jurídico');
        $validator->notEmpty('endereco_cep', 'Informe o CEP');
        $validator->notEmpty('endereco_distrito_id', 'Informe o distrito');
        $validator->notEmpty('endereco_logradouro', 'Informe o logradouro');
        $validator->notEmpty('endereco_bairro', 'Informe o bairro');
        $validator->notEmpty('leg_criacao', 'Informe o Ato de criação');
        $validator->notEmpty('leg_denominacao', 'Informe o Ato de denominação');
        
        return $validator;
    }

    /**
     * Obtém a relação de escolas cadastradas
     * 
     * @param array $options
     * @return Query
     */
    public function listar(array $filter = []) : Query
    {
        $result = $this->find('all', [
            'contain' => [
                'EnderecoDistrito.Municipios.Ufs',
                'EscolaSituacoes',
            ],
            'fields' => [
                'Escolas.id',
                'Escolas.rede',
                'Escolas.situacao_id',
                'Escolas.inep_codigo',
                'Escolas.nome_curto',
                'EnderecoDistrito.id',
                'Municipios.nome',
                'Ufs.sigla',
                'EscolaSituacoes.nome',
                'EscolaSituacoes._webapp_label_style',
            ],
        ]);
        
        if (isset($filter['nome'])) {
            $result->where(['Escolas.nome_curto LIKE' => "%{$filter['nome']}%"]);
        }
        
        if (isset($filter['situacao_id']) && $filter['situacao_id'] != 0) {
            $result->where(['Escolas.situacao_id' => $filter['situacao_id']]);
        }
        
        if (isset($filter['rede']) && $filter['rede'] == 1) {
            $result->where(['Escolas.rede' => true]);
        }
        
        return $result;
    }
    
    /**
     * Obtém a lista de escolas cujo endereço está localizado no município
     * especificado
     * 
     * @param int $municipioId
     * @return Query
     */
    public function listarPorMunicipio($municipioId)
    {
        return $this->find('all', [
            'fields' => [
                'Escolas.id',
                'Escolas.nome_curto',
                'Escolas.endereco_distrito_id',
                'Escolas.deleted',
            ],
            'contain' => [
                'EnderecoDistrito' => [
                    'fields' => [
                        'EnderecoDistrito.id',
                        'EnderecoDistrito.municipio_id',
                        'EnderecoDistrito.nome',
                    ],
                    'Municipios' => [
                        'fields' => [
                            'Municipios.id',
                            'Municipios.nome',
                        ],
                    ],
                ],
            ],
            'conditions' => [
                'Municipios.id' => $municipioId,
                'Escolas.deleted' => false,
            ],
        ]);
    }
    
    /**
     * Obtém os dados de identificação de uma Escola
     *
     * @param type $primaryKey
     * @return \GRE\Model\Entity\Escola
     */
    public function getIdentificacao($primaryKey) : \GRE\Model\Entity\Escola
    {
        $options = [
            'contain' => [
                'EscolaSituacoes',
                'EnderecoDistrito.Municipios.Ufs',
            ],
            'fields' => [
                'Escolas.id',
                'Escolas.rede',
                'EscolaSituacoes.nome',
                'Escolas.inep_codigo',
                'Escolas.nome_curto',
                'Escolas.nome_longo',
                'Escolas.nome_juridico',
                'Escolas.endereco_cep',
                'Escolas.endereco_logradouro',
                'Escolas.endereco_numero',
                'Escolas.endereco_complemento',
                'Escolas.endereco_bairro',
                'EnderecoDistrito.nome',
                'Municipios.id',
                'Municipios.nome',
                'Ufs.id',
                'Ufs.sigla',
            ],
        ];
        return parent::get($primaryKey, $options);
    }
    
    /**
     * Retorna a entidade Escola com os dados da legislação de funcionamento
     * 
     * @param int $escolaId
     * @return Escola
     */
    public function getLegislacaoFuncionamento($escolaId) : Escola
    {
        $options = [
            'fields' => [
                'Escolas.id',
                'Escolas.rede',
                'Escolas.nome_curto',
                'Escolas.leg_criacao',
                'Escolas.leg_denominacao',
            ],
        ];
        return parent::get($escolaId, $options);
    }
    
    /**
     * Retorna a entidade Escola com os dados dos reconhecimentos de curso
     * 
     * @param int $escolaId
     * @return Escola
     */
    public function getReconhecimentos($escolaId) : Escola
    {
        $options = [
            'contain' => [
                'Reconhecimentos',
            ],
        ];
        
        $escola = $this->get($escolaId, $options);
        
        // Remove da lista os reconhecimentos deletados
        foreach ($escola->reconhecimentos as $key => $reconhecimento) {
            if ($reconhecimento->deleted) {
                unset($escola->reconhecimentos[$key]);
            }
        }
        
        return $escola;
    }
    
    /**
     * Retorna a entidade `Escola` com os dados de identificação contidos no
     * array `$data`
     * 
     * @param Escola $escola
     * @param array $data
     * @param array $options
     * @return Escola
     */
    public function patchIdentificacao(Escola $escola, array $data, array $options = []) : Escola
    {
        $fields = [
            'id',
            'situacao_id',
            'inep_codigo',
            'nome_curto',
            'nome_longo',
            'nome_juridico',
            'endereco_cep',
            'endereco_distrito_id',
            'endereco_logradouro',
            'endereco_numero',
            'endereco_complemento',
            'endereco_bairro',
        ];
        
        $data = $this->_filterData($data, $fields);

        return parent::patchEntity($escola, $data, $options);
    }
    
    /**
     * Retorna a entidade `Escola` com os dados de legislação de funcionamento
     * contidos no array `$data`
     * 
     * @param Escola $escola
     * @param array $data
     * @return Escola
     */
    public function patchLegislacaoFuncionamento(Escola $escola, array $data) : Escola
    {
        $fields = [
            'id',
            'leg_criacao',
            'leg_denominacao',
        ];
        
        $data = $this->_filterData($data, $fields);
        
        return $this->patchEntity($escola, $data);
    }
    
    /**
     * Retorna a entidade `Escola` com os dados de contato contidos no array
     * `$data`
     * 
     * @param Escola $escola
     * @param array $data
     * @return Escola
     */
    public function patchContatos(Escola $escola, array $data) : Escola
    {
        $fields = [
            'fone_1',
            'fone_2',
            'fone_3',
            'fone_4',
            'email',
        ];
        $data = $this->_filterData($data, $fields);
        return $this->patchEntity($escola, $data);
    }


    /**
     * Retorna a entidade `Escola` com os dados de caracterização da
     * infraestrutura contidos no array `$data`
     * 
     * @param Escola $escola
     * @param array $data
     * @param array $options
     * @return Escola
     */
    public function patchCaracterizacao(Escola $escola, array $data, array $options = []) : Escola
    {
        $fields = [
            'id',
            'nome_curto',
            'infra_agua_filtrada',
            'infra_agua_abast_publica',
            'infra_agua_abast_poco',
            'infra_agua_abast_cacimba',
            'infra_agua_abast_fonte',
            'infra_agua_abast_inexistente',
            'infra_energia_abast_publica',
            'infra_energia_abast_gerador',
            'infra_energia_abast_outros',
            'infra_energia_abast_inexistente',
            'infra_esgoto_rede',
            'infra_esgoto_fossa',
            'infra_esgoto_inexistente',
            'infra_lixo_coleta',
            'infra_lixo_queima',
            'infra_lixo_joga',
            'infra_lixo_recicla',
            'infra_lixo_enterra',
            'infra_lixo_outros',
            'infra_dep_almoxarifado',
            'infra_dep_alojamento_aluno',
            'infra_dep_alojamento_professor',
            'infra_dep_area_verde',
            'infra_dep_auditorio',
            'infra_dep_banheiro_acessivel',
            'infra_dep_banheiro_infantil',
            'infra_dep_banheiro_chuveiro',
            'infra_dep_banheiro_dentro',
            'infra_dep_banheiro_fora',
            'infra_dep_bercario',
            'infra_dep_biblioteca',
            'infra_dep_vias_deficientes',
            'infra_dep_lab_ciencias',
            'infra_dep_lab_informatica',
            'infra_dep_lavanderia',
            'infra_dep_parque_infantil',
            'infra_dep_patio_coberto',
            'infra_dep_patio_descoberto',
            'infra_dep_quadra_coberta',
            'infra_dep_quadra_descoberta',
            'infra_dep_refeitorio',
            'infra_dep_sala_diretoria',
            'infra_dep_sala_leitura',
            'infra_dep_sala_professores',
            'infra_dep_sala_recursos',
            'infra_dep_sala_diretoria',
            'infra_dep_nenhuma',
            'infra_equip_parabolica',
            'infra_equip_dvd',
            'infra_equip_som',
            'infra_equip_tv',
            'infra_equip_copiadora',
            'infra_equip_fax',
            'infra_equip_impressora',
            'infra_equip_impressora_multi',
            'infra_equip_filmadora',
            'infra_equip_projetor',
            'infra_equip_retroprojetor',
            'infra_equip_videocassete',
            'infra_pc_admin',
            'infra_pc_alunos',
            'infra_internet',
            'infra_internet_banda_larga',
        ];
        $data = $this->_filterData($data, $fields);
        return parent::patchEntity($escola, $data, $options);
    }
    
    /**
     * Salva os dados de identificação de uma escola
     * 
     * @param Escola $escola
     * @param array $options
     * @return Escola|bool
     */
    public function saveIdentificacao(Escola $escola, array $options = [])
    {
        return parent::save($escola, $options);
    }
    
    /**
     * Obtém a Escola com seus dados de caracterização da infraestrutura
     * 
     * @param int $escolaId
     * @return Escola
     */
    public function getCaracterizacao(int $escolaId) : Escola
    {
        $options = [
            'fields' => [
                'Escolas.id',
                'Escolas.rede',
                'Escolas.nome_curto',
                'Escolas.infra_agua_filtrada',
                'Escolas.infra_agua_abast_publica',
                'Escolas.infra_agua_abast_poco',
                'Escolas.infra_agua_abast_cacimba',
                'Escolas.infra_agua_abast_fonte',
                'Escolas.infra_agua_abast_inexistente',
                'Escolas.infra_energia_abast_publica',
                'Escolas.infra_energia_abast_gerador',
                'Escolas.infra_energia_abast_outros',
                'Escolas.infra_energia_abast_inexistente',
                'Escolas.infra_esgoto_rede',
                'Escolas.infra_esgoto_fossa',
                'Escolas.infra_esgoto_inexistente',
                'Escolas.infra_lixo_coleta',
                'Escolas.infra_lixo_queima',
                'Escolas.infra_lixo_joga',
                'Escolas.infra_lixo_recicla',
                'Escolas.infra_lixo_enterra',
                'Escolas.infra_lixo_outros',
                'Escolas.infra_dep_almoxarifado',
                'Escolas.infra_dep_alojamento_aluno',
                'Escolas.infra_dep_alojamento_professor',
                'Escolas.infra_dep_area_verde',
                'Escolas.infra_dep_auditorio',
                'Escolas.infra_dep_banheiro_acessivel',
                'Escolas.infra_dep_banheiro_infantil',
                'Escolas.infra_dep_banheiro_chuveiro',
                'Escolas.infra_dep_banheiro_dentro',
                'Escolas.infra_dep_banheiro_fora',
                'Escolas.infra_dep_bercario',
                'Escolas.infra_dep_biblioteca',
                'Escolas.infra_dep_vias_deficientes',
                'Escolas.infra_dep_lab_ciencias',
                'Escolas.infra_dep_lab_informatica',
                'Escolas.infra_dep_lavanderia',
                'Escolas.infra_dep_parque_infantil',
                'Escolas.infra_dep_patio_coberto',
                'Escolas.infra_dep_patio_descoberto',
                'Escolas.infra_dep_quadra_coberta',
                'Escolas.infra_dep_quadra_descoberta',
                'Escolas.infra_dep_refeitorio',
                'Escolas.infra_dep_sala_diretoria',
                'Escolas.infra_dep_sala_leitura',
                'Escolas.infra_dep_sala_professores',
                'Escolas.infra_dep_sala_recursos',
                'Escolas.infra_dep_sala_diretoria',
                'Escolas.infra_dep_nenhuma',
                'Escolas.infra_equip_parabolica',
                'Escolas.infra_equip_dvd',
                'Escolas.infra_equip_som',
                'Escolas.infra_equip_tv',
                'Escolas.infra_equip_copiadora',
                'Escolas.infra_equip_fax',
                'Escolas.infra_equip_impressora',
                'Escolas.infra_equip_impressora_multi',
                'Escolas.infra_equip_filmadora',
                'Escolas.infra_equip_projetor',
                'Escolas.infra_equip_retroprojetor',
                'Escolas.infra_equip_videocassete',
                'Escolas.infra_pc_admin',
                'Escolas.infra_pc_alunos',
                'Escolas.infra_internet',
                'Escolas.infra_internet_banda_larga',
            ],
        ];
        
        return $this->get($escolaId, $options);
    }
    
    /**
     * Retorna a entidade Escola com as informações de contato
     * 
     * @param int $escolaId
     * @return Escola
     */
    public function getContatos($escolaId)
    {
        return $this->get($escolaId, array(
            'fields' => [
                'Escolas.id',
                'Escolas.rede',
                'Escolas.nome_curto',
                'Escolas.fone_1',
                'Escolas.fone_2',
                'Escolas.fone_3',
                'Escolas.fone_4',
                'Escolas.email',
                'Escolas.deleted',
            ],
            'conditions' => [
                'Escolas.deleted' => false,
            ],
        ));
    }
    
    /**
     * Retorna a entidade Escola com o id especificado, incluindo seus locais
     * e Salas de aula
     * 
     * @param int $escolaId
     * @param array $filters
     * 
     * @return Escola
     */
    public function getSalas($escolaId, array $filters = []) : Escola
    {
        $options = [
            'fields' => [
                'Escolas.id',
                'Escolas.rede',
                'Escolas.nome_curto',
            ],
            'contain' => [
                'EscolaLocais' => [
                    'fields' => [
                        'EscolaLocais.id',
                        'EscolaLocais.escola_id',
                        'EscolaLocais.nome',
                        'EscolaLocais.deleted',
                    ],
                    'conditions' => [
                        'EscolaLocais.deleted' => false,
                    ],
                    'EscolaSalas' => [
                        'fields' => [
                            'EscolaSalas.id',
                            'EscolaSalas.escola_local_id',
                            'EscolaSalas.nome',
                            'EscolaSalas.capacidade',
                            'EscolaSalas.deleted',
                        ],
                        'conditions' => [
                            'EscolaSalas.deleted' => false,
                        ],
                    ],
                ],
            ],
        ];
                
        if (isset($filters['escola_local_id']) && $filters['escola_local_id'] != 0) {
            $options['contain']['EscolaLocais']['EscolaSalas']['conditions']['EscolaSalas.escola_local_id'] = $filters['escola_local_id'];
        }
        
        return $this->get($escolaId, $options);
    }

    /**
     * Obtém a entidade Escola com os compartilhamentos de local de funcionamento
     * 
     * @param int $escolaId
     * @param array $filters
     * 
     * @return Escola
     */
    public function getCompartilhamentos($escolaId, array $filters = []) : Escola
    {
        $options = [
            'fields' => [
                'Escolas.id',
                'Escolas.rede',
                'Escolas.nome_curto',
            ],
            'conditions' => [
                'Escolas.deleted' => false,
            ],
            'contain' => [
                'EscolaLocais' => [
                    'fields' => [
                        'EscolaLocais.id',
                        'EscolaLocais.escola_id',
                        'EscolaLocais.nome',
                    ],
                    'conditions' => [
                        'EscolaLocais.deleted' => false,
                    ],
                    'EscolaLocalCompartilhamentos' => [
                        'fields' => [
                            'EscolaLocalCompartilhamentos.id',
                            'EscolaLocalCompartilhamentos.escola_local_id',
                            'EscolaLocalCompartilhamentos.escola_id',
                        ],
                        'conditions' => [
                            'EscolaLocalCompartilhamentos.deleted' => false,
                        ],
                        'Escolas' => [
                            'fields' => [
                                'Escolas.id',
                                'Escolas.nome_curto',
                                'Escolas.inep_codigo',
                            ],
                            'conditions' => [
                                'Escolas.deleted' => false,
                            ],
                            'EnderecoDistrito' => [
                                'fields' => [
                                    'EnderecoDistrito.id',
                                    'EnderecoDistrito.municipio_id',
                                ],
                                'Municipios' => [
                                    'fields' => [
                                        'Municipios.id',
                                        'Municipios.uf_id',
                                        'Municipios.nome',
                                    ],
                                    'Ufs' => [
                                        'fields' => [
                                            'Ufs.id',
                                            'Ufs.sigla',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        
        if (isset($filters['escola_local_id']) && $filters['escola_local_id'] != 0) {
            $options['contain']['EscolaLocais']['EscolaLocalCompartilhamentos']['conditions']['EscolaLocalCompartilhamentos.escola_local_id'] = $filters['escola_local_id'];
        }
        
        return $this->get($escolaId, $options);
    }
    
    /**
     * Define a escola especificada como participante da rede GRE
     * 
     * @param Escola $escola
     * @return Escola | bool
     */
    public function greRetirar(Escola $escola)
    {
        $escola->rede = false;
        return $this->save($escola);
    }
    
    /**
     * Define a escola especificada como NÃO participante da rede GRE
     * 
     * @param Escola $escola
     * @return Escola | bool
     */
    public function greIntegrar(Escola $escola)
    {
        $escola->rede = true;
        return $this->save($escola);
    }
}
