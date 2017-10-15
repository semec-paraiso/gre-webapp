<?php

namespace GRE\Model\Table;

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
        $this->hasMany('EscolaDependencias' ,[
            'foreignKey' => 'escola_local_id',
        ]);
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
                'EscolaLocais.descricao',
                'EscolaLocalTipos.nome',
                'PredioOcupacaoFormas.nome',
            ]
        ];
        $options = array_merge($defaultOptions, $options);
        
        $options['conditions']['EscolaLocais.escola_id'] = $escolaId;
        
        return parent::find('all', $options);
    }
}
