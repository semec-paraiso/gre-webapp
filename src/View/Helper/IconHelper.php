<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

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
     * Inicialização do helper
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $defaultConfig = [
            'aliases' => [],
        ];
        $config = array_merge($defaultConfig, $config);
        
        $this->setConfig($config);
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
        
        $class = $this->getConfig()['aliases'][$class] ?? $class;
        $options['class'] = trim("{$class} {$options['class']}");
        
        return $this->Html->tag('i', '', $options);
    }
}