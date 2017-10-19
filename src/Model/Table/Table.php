<?php

namespace GRE\Model\Table;

use Cake\ORM\Query;

/**
 * Repositório base da aplicação
 * 
 */
class Table extends \Cake\ORM\Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->addBehavior('Timestamp');
    }
    /**
     * Filtra uma query
     * 
     * @param Query $query Query a ser filtrada
     * @param string $field Campo a ser aplicado o filtro
     * @param string $search Fragmento do texto a ser buscado
     * 
     * @return Query
     */
    protected function _filterResult(Query $query, string $field, string $search) : Query
    {
        $query->where([$field . ' LIKE' => '%' . trim($search) .'%']);
        return $query;
    }
    
    /**
     * Obtém uma lista de opções para popular input selects
     * 
     * @param array $options
     * @return array
     */
    public function getOptions(array $options = []) : array
    {
        return $this->find('list', $options)->toArray();
    }
    
    /**
     * Retorna o array `$data` apenas com os conjuntos de chave/valor cujas
     * chaves estejam no array `$keys`
     * 
     * @param array $data
     * @param array $keys
     * @return array
     */
    protected function _filterData(array $data, array $keys) : array
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
