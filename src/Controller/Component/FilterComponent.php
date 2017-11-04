<?php

namespace GRE\Controller\Component;

use Cake\Controller\Component;

/**
 * Componente para auxiliar os controllers na filtragem de resultados
 * 
 */
class FilterComponent extends Component
{
    /**
     * Outros componentes utilizados
     *
     * @var array
     */
    public $components = ['Cookie'];
    
    /**
     * Chave do cookie
     * 
     * @var string
     */
    const COOKIE_KEY = 'Filters';
    
    /**
     * Todos os filtros armazenados
     *
     * @var array
     */
    protected $_filters = [];
    
    /**
     * Requisição do cliente
     *
     * @var \Cake\Http\Client\Request
     */
    protected $_request;
    
    /**
     * Instruções de inicialização do componente
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->_request = $this->getController()->request;
        
        $this->_load();
    }
    
    /**
     * Realiza a leitura dos parâmetros da requisição em busca dos valores dos
     * campos a serem filtrados
     * 
     * @param string $filterName
     * @param array $fields
     * @return array
     */
    public function build(string $filterName, array $fields) : array
    {
        $filters = [];
        foreach ($fields as $field => $defaultValue) {
            $value = $this->_request->getQuery($field);
            if ($value === null) {
                if (isset($this->_filters[$filterName][$field])) {
                    $filters[$field] = $this->_filters[$filterName][$field];
                } else {
                    $filters[$field] = $defaultValue;
                }
            } else {
                $value = trim($value);
                if ($value === '' && isset($this->_filters[$filterName][$field])) {
                    unset($this->_filters[$filterName][$field]);
                    $filters[$field] = $defaultValue;
                } else {
                    $this->_filters[$filterName][$field] = $value;
                    $filters[$field] = $value;
                }
            }
        }
        $this->_store();
        return $filters;
    }
    
    /**
     * Carrega o cookie dos filtros armazenados
     * 
     * @return void
     */
    protected function _load()
    {
        $this->_filters = unserialize($this->Cookie->read(self::COOKIE_KEY));
        
        if (!$this->_filters) {
            $this->_filters = array();
        }
    }
    
    /**
     * Armazena o cookie dos filtros criados
     * 
     * @return void
     */
    protected function _store()
    {
        $this->Cookie->write(self::COOKIE_KEY, serialize($this->_filters));
    }
}
