<?php

namespace GRE\Model\Table;

/**
 * Repositório `Escolas`
 *
 */
class EscolasTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->belongsTo('EscolaSituacoes', [
            'foreignKey'   => 'situacao_id',
            'propertyName' => 'escola_situacao',
        ]);
        $this->belongsTo('EnderecoDistrito', [
            'foreignKey'   => 'endereco_distrito_id',
            'className'    => 'Distritos',
            'propertyName' => 'endereco_distrito',
        ]);
    }

    public function listar(array $options = [])
    {
        $result = $this->find('all', [
            'contain' => [
                'EscolaSituacoes',
            ],
            'order' => [
                'Escolas.nome_curto ASC',
            ]
        ]);
        
        if (isset($options['search']['nome'])) {
            $result = $this->_filterResult($result, 'Escolas.nome_longo', $options['search']['nome']);
        }
        
        return $result;
    }

    /**
     * Obtém os dados de identificação de uma Escola
     *
     * @param type $primaryKey
     * @return \GRE\Model\Entity\Escola
     */
    public function getIdentificacao($primaryKey) : \GRE\Model\Entity\Escola
    {
        $options = [
            'contain' => [
                'EscolaSituacoes',
                'EnderecoDistrito.Municipios.Ufs',
            ],
            'fields' => [
                'Escolas.id',
                'EscolaSituacoes.nome',
                'Escolas.inep_codigo',
                'Escolas.nome_curto',
                'Escolas.nome_longo',
                'Escolas.nome_juridico',
                'Escolas.endereco_cep',
                'Escolas.endereco_logradouro',
                'Escolas.endereco_numero',
                'Escolas.endereco_complemento',
                'Escolas.endereco_bairro',
                'EnderecoDistrito.nome',
                'Municipios.nome',
                'Ufs.sigla',
            ],
        ];
        return parent::get($primaryKey, $options);
    }
}
