<?php

namespace GRE\Model\Table;

use Cake\Validation\Validator;

use Cake\ORM\Query;

/**
 * Repositório da entidade `EscolaLocal`
 * 
 */
class EscolaLocaisTable extends Table
{
    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        $this->setDisplayField('descricao');
        
        $this->belongsTo('EscolaLocalTipos');
        $this->belongsTo('PredioOcupacaoFormas');
    }
    
    /**
     * Regras de validação default
     * 
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->requirePresence('nome', 'create', 'Informe o nome do local');
        $validator->requirePresence('predio_ocupacao_forma_id', 'create', 'Informe a forma de ocupação');
        $validator->requirePresence('escola_local_tipo_id', 'create', 'Informe o tipo do local');
        
        $validator->notEmpty('nome', 'Informe o nome do local');
        $validator->notEmpty('predio_ocupacao_forma_id', 'Informe a forma de ocupação');
        $validator->notEmpty('escola_local_tipo_id', 'Informe o tipo do local');
                
        return $validator;
    }
    
    /**
     * Obtém a lista de locais da escola especificada
     * 
     * @param int $escolaId
     * @param array $options
     * @return Query
     */
    public function listar(int $escolaId, array $options = []) : Query 
    {
        $defaultOptions = [
            'contain' => [
                'EscolaLocalTipos',
                'PredioOcupacaoFormas',
            ],
            'fields' => [
                'EscolaLocais.id',
                'EscolaLocais.nome',
                'EscolaLocalTipos.nome',
                'PredioOcupacaoFormas.nome',
            ]
        ];
        $options = array_merge($defaultOptions, $options);
        
        $options['conditions']['EscolaLocais.escola_id'] = $escolaId;
        
        return parent::find('all', $options);
    }
}
