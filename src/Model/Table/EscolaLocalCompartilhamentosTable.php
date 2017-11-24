<?php

namespace GRE\Model\Table;

use Cake\Validation\Validator;
use GRE\Model\Entity\EscolaLocalCompartilhamento;

/**
 * Repositório `EscolaLocalCompartilhamentos`
 */
class EscolaLocalCompartilhamentosTable extends Table
{
    /**
     * Filtros aplicáveis
     *
     * @var array
     */
    protected $_filters = [
        'escola_local_id' => 0,
    ];

    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config = [])
    {
        parent::initialize($config);

        $this->belongsTo('Escolas');
        $this->belongsTo('EscolaLocais', [
            'foreignKey' => 'escola_local_id',
            'propertyName' => 'escola_local',
        ]);
    }
    
    /**
     * Regras de validação default
     * 
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->requirePresence('escola_local_id', 'create', 'Informe o local');
        $validator->requirePresence('escola_id', 'create', 'Informe o local');
        
        $validator->notEmpty('escola_local_id', 'Informe o local');
        $validator->notEmpty('escola_id', 'Informe a escola');
        
        $validator->integer('escola_local_id', 'Informe o local');
        $validator->integer('escola_id', 'Informe a escola');
        
        return $validator;
    }
    
    /**
     * Reescreve o método get() para incluir informações adicionais à entidade
     * EscolaLocalCompartilhamento
     * 
     * @param int $escolaLocalCompartilhamentoId
     * @param array $options
     * @return EscolaLocalCompartilhamento
     */
    public function get($escolaLocalCompartilhamentoId, $options = array())
    {
        return parent::get((int) $escolaLocalCompartilhamentoId, [
            'fields' => [
                'EscolaLocalCompartilhamentos.id',
            ],
            'contain' => [
                'EscolaLocais' => [
                    'fields' => [
                        'EscolaLocais.id',
                        'EscolaLocais.escola_id',
                    ],
                    'Escolas' => [
                        'fields' => [
                            'Escolas.id',
                            'Escolas.nome_curto',
                        ]
                    ],
                ],
                'Escolas' => [
                    'fields' => [
                        'Escolas.id',
                        'Escolas.nome_curto',
                    ]
                ],
            ],
            'conditions' => [
                'EscolaLocalCompartilhamentos.deleted' => false,
            ],
        ]);
    }
    
    /**
     * Marca o compartilhamento de local como excluído
     * 
     * @param EscolaLocalCompartilhamento $escolaLocalCompartilhamento
     * @return EscolaLocalCompartilhamento | bool
     */
    public function setDeleted(EscolaLocalCompartilhamento $escolaLocalCompartilhamento)
    {
        $escolaLocalCompartilhamento->deleted = true;
        return $this->save($escolaLocalCompartilhamento);
    }
}
