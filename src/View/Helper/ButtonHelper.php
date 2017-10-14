<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

/**
 * Helper para construção do HTML de botões
 * 
 */
class ButtonHelper extends Helper
{
    /**
     * Outros helpers utilizados
     * 
     * @var array
     */
    public $helpers = ['Html', 'Icon'];
    
    /**
     * Conjunto de associações entre aliases e classes CSS a serem incluidas
     * no botão
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
        'sizes'  => [],
    ];
    
    /**
     * Opções default
     * 
     * @var array
     */
    protected $_defaultOptions = [
        'type'   => 'link',
        'class'  => '',
        'url'    => '#',
        'text'   => '',
        'icon'   => null,
        'style'  => 'default',
        'size'   => 'default',
        'escape' => false,
    ];
    
    /**
     * Estilo padrão do botão
     * 
     * @var string
     */
    protected $_defaultStyle = 'default';
    
    /**
     * Tamanho padrão do botão
     * 
     * @var string
     */
    protected $_defaultSize = 'default';
    
    /**
     * Inicializa o helper fornecendo os aliases
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        $this->_aliases = array_merge($this->_defaultAliases, $config);
    }
    
    /**
     * Constroi e retorna o HTML do botão
     * 
     * @param array $options
     * @return string
     */
    public function render(array $options = []) : string
    {
        $options = array_merge($this->_defaultOptions, $options);
        $options = $this->_buildBase($options);
        $options = $this->_buildStyle($options);
        $options = $this->_buildSize($options);
        
        $url = $options['url'];
        unset($options['url']);
        
        $text = $options['text'];
        unset($options['text']);
        
        $icon = $this->_buildIcon($options);
        $text = trim("{$icon} {$text}");
        unset($options['icon']);
        
        $type = $options['type'];
        unset($options['type']);
        
        switch ($type) {
            case 'link':
                return $this->Html->link($text, $url, $options);
            case 'submit':
                $options['type'] = 'submit';
                return $this->Html->tag('button', $text, $options);
            default:
                trigger_error("Invalid button type: {$type}", E_USER_WARNING);
        }
    }
    
    /**
     * Adiciona uma classe CSS ao array de opções do botão
     * 
     * @param array $options
     * @param string $class
     * @return array
     */
    protected function _addClass(array $options, string $class) : array
    {
        $options = array_merge(['class' => ''], $options);
        $options['class'] = trim("{$class} {$options['class']}");
        return $options;
    }
    
    /**
     * Adiciona as classes CSS de base do botão
     * 
     * @param type $options
     * @return array
     */
    protected function _buildBase(array $options = []) : array
    {
        $class = $this->_aliases['base'] ?? '';
        $options = $this->_addClass($options, $class);
        return $options;
    }
    
    /**
     * Adiciona as classes CSS para estilizar o botão
     * 
     * @param array $options
     * @return array
     */
    protected function _buildStyle(array $options = []) : array
    {
        $class = $this->_aliases['styles'][$options['style']] ?? $this->_defaultOptions['style'];
        $options = $this->_addClass($options, $class);
        unset($options['style']);
        return $options;
    }
    
    /**
     * Adiciona as classes CSS referentes ao dimensionamento do botão
     * 
     * @param array $options
     * @return array
     */
    protected function _buildSize(array $options = []) : array
    {
        $class = $this->_aliases['sizes'][$options['size']] ?? $this->_defaultOptions['size'];
        $options = $this->_addClass($options, $class);
        unset($options['size']);
        return $options;
    }
    
    /**
     * Retorna o HTML do ícone a ser inserido no botão
     * 
     * @param array $options
     * @return string
     */
    protected function _buildIcon(array $options = []) : string
    {
        $options = array_merge(['icon' => null], $options);
        if ($options['icon'] === null) {
            return '';
        }
        return $this->Icon->render($options['icon']);
    }
    
    /**
     * Chamada dinâmica baseada no estilo do botão
     * 
     * @param string $method
     * @param array $params
     * @return string
     */
    public function __call($method, $params)
    {
        $params[0]['style'] = $method;
        return $this->render($params[0]);
    }
}
