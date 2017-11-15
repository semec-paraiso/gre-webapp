<?php

namespace GRE\View\Helper;

use Exception;
use Cake\View\Helper;
use Cake\Core\Configure;

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
    public $helpers = ['Html', 'Icon', 'Dropdown'];
    
    /**
     * Conjunto de associações entre aliases e classes CSS a serem incluidas
     * no botão
     * 
     * @var array
     */
    protected $_aliases = [];
    
    protected $_defaultAlias = 'default';
    
    /**
     * Opções default
     * 
     * @var array
     */
    protected $_defaultOptions = [
        'tag' => 'link',
        'class' => '',
        'url' => '#',
        'text' => '',
        'icon' => null,
        'escape' => false,
        'caret' => false,
        'dropdown' => null,
    ];
    
    /**
     * Inicializa o helper fornecendo os aliases
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $defaultConfig = [
            'buttons' => [],
        ];
        $config = array_merge($defaultConfig, $config);
        
        $buttonsConfig = [
            'aliases' => [],
        ];
        
        if (is_string($config['buttons'])) {
            Configure::load($config['buttons']);
            $buttonsConfig = array_merge($buttonsConfig, Configure::read('Buttons'));
        } else if (is_array($config['buttons'])) {
            $buttonsConfig = array_merge($buttonsConfig, $config['buttons']);
        } else {
            throw new Exception('Invalid button config');
        }
        
        $this->_aliases = $buttonsConfig['aliases'];
    }
    
    public function getAliases() : array
    {
        return $this->_aliases;
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
        $options = $this->_buildClasses($options);
        
        $url = $options['url'];
        unset($options['url']);
        
        $text = $options['text'];
        unset($options['text']);
        
        $caret = $this->_buildCaret($options);
        $icon = $this->_buildIcon($options);
        $text = trim("{$icon}{$text}{$caret}");
        unset($options['caret']);
        unset($options['icon']);
        
        $tag = $options['tag'];
        unset($options['tag']);
        
        $dropdown = '';
        if ($options['dropdown']) {
            $options = $this->addClass($options, 'dropdown-toggle');
            $options['data-toggle'] = 'dropdown';
            $dropdown = $this->Dropdown->render($options['dropdown']);
        }
        unset($options['dropdown']);
        
        switch ($tag) {
            case 'link':
                $options['role'] = 'button';
                return $this->Html->link($text, $url, $options) . $dropdown;
            case 'submit':
                $options['type'] = 'submit';
                return $this->Html->tag('button', $text, $options);
            default:
                throw new Exception("Invalid button tag: {$tag}");
        }
    }
    
    /**
     * Costroi o ícone caret no botão
     * 
     * @param array $options
     * @return string
     */
    protected function _buildCaret(array $options) : string
    {
        if ($options['caret'] === true) {
            return $this->Icon->render('caret');
        }
        return '';
    }
    
    /**
     * Adiciona as classes CSS referentes ao dimensionamento do botão
     * 
     * @param array $options
     * @return array
     */
    protected function _buildClasses(array $options = []) : array
    {
        if (!isset($options['class']) || empty($options['class'])) {
            $options = $this->addClass($options, $this->_defaultAlias);
        }
        $options = $this->addClass($options, 'button');
        $classes = explode(' ', $options['class']);
        foreach ($classes as $key => $class) {
            if (isset($this->_aliases[$class])) {
                $classes[$key] = $this->_aliases[$class];
            }
        }
        $options['class'] = implode(' ', $classes);
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
}
