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
    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
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
        
        return $validator;
    }

    /**
     * Obtém a relação de escolas cadastradas
     * 
     * @param array $options
     * @return Query
     */
    public function listar(array $options = []) : Query
    {
        $result = $this->find('all', [
            'contain' => [
                'EscolaSituacoes',
            ],
            'order' => [
                'Escolas.nome_curto ASC',
            ]
        ]);
        
        if (isset($options['search']['nome'])) {
            $result = $this->_filterResult($result, 'Escolas.nome_longo', $options['search']['nome']);
        }
        
        return $result;
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
     * Obtêm as dependências da escola especificada
     * 
     * @param int $escolaId
     * @return Escola
     */
    public function getDependencias(int $escolaId) : Escola
    {
        $options = [
            'contain' => [
                'EscolaLocais' => [
                    'EscolaDependencias' => [
                        'EscolaDependenciaTipos',
                    ],
                ],
            ],
        ];
        
        return parent::get($escolaId, $options);
    }
}
