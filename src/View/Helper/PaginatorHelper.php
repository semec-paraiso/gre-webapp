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
            'before'  => '',
            'after'   => '',
            'class'   => '',
            'modulus' => 4,
        ];
        $options = array_merge($defaultOptions, $options);
        $options['class'] = trim("pagination pagination-sm inline {$options['class']}");
        
        $options['before'] .= $this->Html->tag('div', null, ['class' => 'box-tools']);
        $options['before'] .= $this->Html->tag('ul', null, ['class' => $options['class']]);
        $options['before'] .= $this->first('«');
        $options['before'] .= $this->prev('‹');
        unset($options['class']);

        $options['after'] = '</ul><div>' . $options['after'];
        $options['after'] = $this->last('»') . $options['after'];
        $options['after'] = $this->next('›') . $options['after'];
        
        return parent::numbers($options);
    }
}
