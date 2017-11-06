<?php

namespace GRE\Model\Table;

use Cake\Validation\Validator;

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
}
