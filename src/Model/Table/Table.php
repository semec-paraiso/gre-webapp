<?php

namespace GRE\Model\Table;

use Cake\ORM\Table as CakeTable;
use Cake\ORM\Query;

class Table extends CakeTable
{
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
}
