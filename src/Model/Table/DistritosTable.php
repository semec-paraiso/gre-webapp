<?php

namespace GRE\Model\Table;

use Cake\ORM\Query;

/**
 * Repositório da entidade Distrito
 * 
 */
class DistritosTable extends Table
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
        
        $this->belongsTo('Municipios');
    }
    
    /**
     * Retorna a relação de Distritos cadastrados
     * 
     * @param array $options
     * @return Query
     */
    public function listar(array $options = []) : Query
    {
        $defaultOptions = [
            'order' => 'Distritos.nome ASC',
            'fields' => [
                'Distritos.id',
                'Distritos.nome',
            ]
        ];
        $options = array_merge($defaultOptions, $options);
        
        return $this->find('all', $options);
    }
}
