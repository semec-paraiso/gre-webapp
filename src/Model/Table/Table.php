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
     * Injeta os filtros de pesquisa no repositório
     * 
     * @param array $filters
     */
    public function setFilters(array $filters)
    {
        $this->_filters = $filters;
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
    
    /**
     * Retorna o array `$data` apenas com os conjuntos de chave/valor cujas
     * chaves estejam no array `$keys`
     * 
     * @param array $data
     * @param array $keys
     * @return array
     */
    public function filterData(array $data, array $keys) : array
    {
        $filtered = [];
        
        foreach ($keys as $key) {
            if (isset($data[$key])) {
                $filtered[$key] = $data[$key];
            }
        }
        
        return $filtered;
    }
}
