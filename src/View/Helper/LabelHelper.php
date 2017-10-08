<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

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
     * Aliases default
     *
     * @var array
     */
    protected $_defaultAliases = [
        'base'   => '',
        'styles' => [],
    ];
    
    /**
     * Opções default para a construção do label
     *
     * @var array
     */
    protected $_defaultOptions = [
        'text'  => '',
        'class' => '',
        'style' => 'default',
    ];
    
    /**
     * Inicialização do helper
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        $config = array_merge(['aliases' => []], $config);
        $this->_aliases = array_merge($this->_defaultAliases, $config['aliases']);
    }
    
    /**
     * Acrescenta uma classe CSS no array de opções do label
     * 
     * @param string $class
     * @param array $options
     * @return array
     */
    protected function _addClass(string $class, array $options = []) : array
    {
        $options = array_merge(['class' => ''], $options);
        $options['class'] = trim("{$class} {$options['class']}");
        return $options;
    }
    
    /**
     * Adiciona a classe CSS base do label
     * 
     * @param array $options
     * @return array
     */
    protected function _buildBase(array $options = []) : array
    {
        $options = $this->_addClass($this->_aliases['base'], $options);
        return $options;
    }
    
    /**
     * Acrecenta a classe CSS de estilização básica do label
     * 
     * @param array $options
     * @return array
     */
    protected function _buildStyle(array $options = []) : array
    {
        $options['style'] = $options['style'] ?? $this->_defaultOptions['style'];
        $options['style'] = $this->_aliases['styles'][$options['style']] ?? $options['style'];
        $options = $this->_addClass($options['style'], $options);
        unset($options['style']);
        return $options;
    }
    
    /**
     * Constroi e retorna o HTML para a exibição de um label
     * 
     * @param array $options
     * @return string
     */
    public function render(array $options = []) : string
    {
        $options = $this->_buildBase($options);
        $options = $this->_buildStyle($options);
        
        $text = $options['text'];
        unset($options['text']);
        
        return $this->Html->tag('span', $text, $options);
    }
}
