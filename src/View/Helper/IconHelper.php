<?php

namespace GRE\View\Helper;

use Cake\View\Helper;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;

/**
 * Helper para construção de tags HTML para exibição de icones
 */
class IconHelper extends Helper
{
    /**
     * Outros helpers utilizados
     * 
     * @var array
     */
    public $helpers = ['Html'];
    
    /**
     * Aliases de ícones
     *
     * @var array
     */
    protected $_aliases = [];
    
    /**
     * Inicialização do helper
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $defaultConfig = [
            'icons' => [],
        ];
        $config = array_merge($defaultConfig, $config);

        $iconConfig = [
            'aliases' => [],
        ];
        
        if (is_string($config['icons'])) {
            Configure::load($config['icons']);
            $iconConfig = array_merge($iconConfig, Configure::read('Icons'));
            
        } else if (is_array($config['icons'])) {
            $iconConfig = array_merge($iconConfig, $config['icons']);
        } else {
            throw new Exception("Invalid type for key \$config['icons']");
        }
        $this->_aliases = $iconConfig['aliases'];
    }
    
    /**
     * Obtém o array de aliases do helper
     * 
     * @return array
     */
    public function getAliases()
    {
        return $this->_aliases;
    }
    
    /**
     * Constroi e retorna o HTML para exibição de um ícone
     * 
     * @param string $class
     * @param array $options
     * 
     * @return string
     */
    public function render(string $class, array $options = []) : string
    {
        $defaultOptions = [
            'class' => '',
        ];
        $options = array_merge($defaultOptions, $options);
        
        $class = isset($this->_aliases[$class]) ? $this->_aliases[$class] : $class;
        $options = $this->addClass($options, $class);
        
        return $this->Html->tag('i', '', $options);
    }
}
