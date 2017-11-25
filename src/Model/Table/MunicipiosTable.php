<?php

namespace GRE\Model\Table;

use Cake\ORM\Query;

/**
 * Repositório da entidade Municipios
 * 
 */
class MunicipiosTable extends Table
{
    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setDisplayField('nome');

        $this->belongsTo('Ufs');
    }

    /**
     * Obtém a relação de municípios associados à UF especificada
     * 
     * @param int $ufId
     * 
     * @return Query
     */
    public function listarPorUf($ufId) : Query
    {        
        return $this->find('all', [
            'fields' => [
                'id',
                'inep_codigo',
                'nome',
            ],
            'order' => [
                'Municipios.nome ASC',
            ],
            'conditions' => [
                'Municipios.uf_id' => (int) $ufId,
            ],
        ]);
    }
}
