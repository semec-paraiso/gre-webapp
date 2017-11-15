<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

/**
 * Constroi menus dropdown
 * 
 */
class DropdownHelper extends Helper
{
    /**
     * Outros helpers utilizados
     *
     * @var array
     */
    public $helpers = ['Html', 'Icon'];
    
    /**
     * Opções default do dropdown
     *
     * @var array
     */
    protected $_defaultOptions = [
        'items' => [],
    ];
    
    /**
     * Opções default dos itens do dropdown
     *
     * @var array
     */
    protected $_defaultItemOptions = [
        'type' => 'link',
        'text' => '',
        'url' => '#',
        'icon' => false,
        'escape' => false,
    ];
    
    /**
     * Constroi e retorna o HTML do dropdown
     * 
     * @param array $options
     * @return string
     */
    public function render(array $options = []) : string
    {
        $options = array_merge($this->_defaultOptions, $options);
        
        $itemsHtml = '';
        
        foreach ($options['items'] as $item) {
            $itemsHtml .= $this->_renderItem($item);
        }
        unset($options['items']);
        
        $options = $this->addClass($options, 'dropdown-menu');
        
        return $this->Html->tag('ul', $itemsHtml, $options);
    }
    
    /**
     * Constroi um item do dropdown
     * 
     * @param array $options
     * @return string
     */
    protected function _renderItem(array $options = []) : string
    {
        $options = array_merge($this->_defaultItemOptions, $options);
        
        switch ($options['type']) {
            case 'divider':
                return $this->_renderDivider($options);
            case 'link':
            default:
                return $this->_renderLink($options);
        }
    }
    
    /**
     * Constroi um item do dropdown como um divisor
     * 
     * @param array $options
     * @return string
     */
    protected function _renderDivider(array $options = []) : string
    {
        unset($options['type']);
        unset($options['text']);
        unset($options['icon']);
        unset($options['url']);
        
        $options = $this->addClass($options, 'divider');
        $options['role'] = 'separator';
        
        return $this->Html->tag('li', '', $options);
    }
    
    /**
     * Constroi um item do dropdown como um link
     * 
     * @param array $options
     * @return string
     */
    protected function _renderLink(array $options = []) : string
    {
        $linkOptions = [
            'escape' => false,
        ];
                
        $text = $options['text'];
        unset($options['text']);
        
        $text = trim("{$this->_renderIcon($options)}{$text}");
        unset($options['icon']);
        
        $url = $options['url'];
        unset($options['url']);
        
        unset($options['type']);
        
        $linkHtml = $this->Html->link($text, $url, $linkOptions);
        
        return $this->Html->tag('li', $linkHtml, $options);
    }
    
    /**
     * Constroi o icone do item do dropdown
     * 
     * @param array $options
     * @return string
     */
    protected function _renderIcon(array $options = []) : string
    {
        if ($options['icon']) {
            return $this->Icon->render($options['icon']);
        }
        return '';
    }
}
