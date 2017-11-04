<?php

namespace GRE\Model\Table;

use Cake\ORM\Query;

/**
 * Repositório base da aplicação
 * 
 */
class Table extends \Cake\ORM\Table
{
    /**
     * Campos possíveis de serem filtrados nas buscas
     * 
     * Utilizar o formato:
     * array(
     *     'campo1' => 'valorDefault',
     *     'campo2' => 'valorDefault',
     *     // ...
     * )
     *
     * @var array
     */
    protected $_filters = [];
    
    /**
     * Instruções de inicialização de todos os repositórios
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->addBehavior('Timestamp');
    }
 
    /**
     * Obtém os campos para filtragem e seus valores default
     * 
     * @return array
     */
    public function getFilters()
    {
        return $this->_filters;
    }
}
