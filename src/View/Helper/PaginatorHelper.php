<?php

namespace GRE\View\Helper;

use Cake\View\Helper\PaginatorHelper as CakePaginatorHelper;

/**
 * Modificações adicionais na classe `PaginatorHelper`, através de herança
 * 
 */
class PaginatorHelper extends CakePaginatorHelper
{
    /**
     * Sobrescrita do método `numbers` para a inclusão do HTML necessário
     * para a estilização da paginação estilo Bootstrap
     * 
     * @param array $options
     * @return string
     */
    public function numbers(array $options = array())
    {
        $defaultOptions = [
            'before' => '',
            'after'  => '',
            'class'  => '',
        ];
        $options = array_merge($defaultOptions, $options);
        $options['class'] = trim("pagination pagination-sm inline {$options['class']}");
        
        $options['before'] .= $this->Html->tag('div', null, ['class' => 'box-tools pull-left']);
        $options['before'] .= $this->Html->tag('ul', null, $options);
        $options['after']   = '</ul><div>' . $options['after'];
        
        return parent::numbers($options);
    }
}