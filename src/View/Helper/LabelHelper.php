<?php

namespace GRE\View\Helper;

use Exception;
use Cake\View\Helper;
use Cake\Core\Configure;

/**
 * Helper para a construção do HTML para a exibição de labels
 * 
 */
class LabelHelper extends Helper
{
    /**
     * Outros helpers utilizados
     *
     * @var array 
     */
    public $helpers = ['Html'];
    
    /**
     * Array com o conjunto de aliases e classes CSS para estilizar o label
     *
     * @var array
     */
    protected $_aliases = [];
    
    /**
     * Opções default para a construção do label
     *
     * @var array
     */
    protected $_defaultOptions = [
        'text'  => '',
        'class' => '',
        'escape' => false,
    ];
    
    /**
     * Inicialização do helper
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        $defaultConfig = [
            'labels' => [],
        ];
        $config = array_merge($defaultConfig, $config);
        
        $labelsConfig = [
            'aliases' => [],
        ];
        
        if (is_string($config['labels'])) {
            Configure::load($config['labels']);
            $labelsConfig = array_merge($labelsConfig, Configure::read('Labels'));
        } else if (is_array($config['labels'])) {
            $labelsConfig = array_merge($labelsConfig, $config['labels']);
        } else {
            throw new Exception("Invalid \$config['labels'] key");
        }
        $this->_aliases = $labelsConfig['aliases'];
    }
    
    /**
     * Retorna os aliases definidos no helper
     * 
     * @return array
     */
    public function getAliases() : array
    {
        return $this->_aliases;
    }
    
    /**
     * Constroi e retorna o HTML para a exibição de um label
     * 
     * @param array $options
     * @return string
     */
    public function render(array $options = []) : string
    {
        $options = array_merge($this->_defaultOptions, $options);
        $options = $this->_buildAliases($options);
        
        $text = $options['text'];
        unset($options['text']);
        
        return $this->Html->tag('span', $text, $options);
    }
    
    /**
     * Substitui as classes definidas de acordo com os aliases
     * 
     * @param array $options
     * @return array
     */
    protected function _buildAliases(array $options = []) : array
    {
        $options = array_merge(['class' => []] ,$options);
        $options = $this->addClass($options, 'label');
        
        $classes = explode(' ', $options['class']);
        
        foreach ($classes as $key => $class) {
            if (isset($this->_aliases[$class])) {
                $classes[$key] = $this->_aliases[$class];
            }
        }
        
        $options['class'] = implode(' ', $classes);
        return $options;
    }
}
