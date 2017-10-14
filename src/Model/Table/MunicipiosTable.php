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
     * Obtém a relação de municípios cadastrados
     * 
     * @param array $options
     * @return Query
     */
    public function listar(array $options = array()) : Query
    {
        $defaultOptions = [
            'order' => 'Municipios.nome ASC',
        ];
        $options = array_merge($defaultOptions, $options);
        
        return $this->find('all', $options);
    }
}
