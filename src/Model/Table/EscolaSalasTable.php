<?php

namespace GRE\Model\Table;

use Cake\Validation\Validator;

/**
 * Repositório EscolaSalas
 *
 */
class EscolaSalasTable extends Table
{
    /**
     * Instruções de inicialização
     *
     * @param array $config
     */
    public function initialize(array $config)
    {
        $this->setEntityClass('EscolaSala');
        
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
        $validator->requirePresence('nome', 'create', 'Informe o nome da sala');
        $validator->requirePresence('capacidade', 'create', 'Informe a capacidade');
        
        $validator->notEmpty('escola_local_id', 'Informe o local');
        $validator->notEmpty('nome', 'Informe o nome da sala');
        $validator->notEmpty('capacidade', 'Informe a capacidade');
        
        $validator->integer('capacidade', 'Valor inválido');
        $validator->greaterThan('capacidade', 0, 'Valor inválido (mínimo: 1)');
        
        return $validator;
    }
    
    /**
     * Reescreve o método get() para obter a entidade EscolaSala com todas
     * as informações relevantes
     * 
     * @param int $escolaSalaId
     * @param array $options
     * @return \GRE\Model\Entity\EscolaSala
     */
    public function get($escolaSalaId, $options = array())
    {
        return parent::get($escolaSalaId, [
            'contain' => [
                'EscolaLocais' => [
                    'fields' => [
                        'EscolaLocais.id',
                        'EscolaLocais.nome',
                    ],
                    'Escolas' => [
                        'fields' => [
                            'Escolas.id',
                            'Escolas.nome_curto',
                        ],
                    ],
                ],
            ],
            'conditions' => [
                'EscolaLocais.deleted' => false,
            ]
        ]);
    }
}
