<?php

namespace GRE\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Controller Escolas
 * 
 */
class EscolasController extends AppController
{
    /**
     * Action default
     * 
     * @return void
     */
    public function index()
    {
        return $this->redirect(['action' => 'listar']);
    }

    /**
     * Listagem das escolas cadastradas
     * 
     * @return void
     */
    public function listar()
    {
        $escolas = $this->paginate($this->Escolas->listar(['search' => $this->request->query]));
        $this->set(compact('escolas'));
    }
    
    /**
     * Cadastro de nova escola
     * 
     * @return void
     */
    public function cadastrar()
    {
        $escola = $this->Escolas->newEntity();
        if ($this->request->is(['post', 'put'])) {
            $escola = $this->Escolas->patchIdentificacao($escola, $this->request->getData());
            if ($this->Escolas->saveIdentificacao($escola)) {
                $this->Flash->success('Escola cadastrada com sucesso!');
                return $this->redirect([
                    'action' => 'identificacaoVisualizar',
                    h($escola->id),
                ]);
            }
            $this->Flash->error('Não foi possível cadastrar a escola!');
            $escola = $this->Escolas->patchEntity($escola, $this->request->getData());
        }
        $this->loadModel('EscolaSituacoes');
        $this->loadModel('Ufs');
        $this->set(compact('escola'));
        $this->set('escolaSituacoes', $this->EscolaSituacoes->getOptions());
        $this->set('ufs', $this->Ufs->getOptions());
    }

    /**
     * Visualização dos dados de identificação de uma escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function identificacaoVisualizar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Edição das informações de identificação da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function identificacaoEditar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            if ($this->request->is(['post', 'put'])) {
                $escola = $this->Escolas->patchIdentificacao($escola, $this->request->getData());
                $this->Flash->success('As informações da escola foram atualizadas!');
                if ($this->Escolas->saveIdentificacao($escola)) {
                    return $this->redirect([
                        'action' => 'identificacaoVisualizar',
                        h($escola->id),
                    ]);
                }
                $this->Flash->error('Não foi possível salvar as informações da escola!');
                $escola = $this->Escolas->patchEntity($escola, $this->request->getData());
            }
            $this->loadModel('EscolaSituacoes');
            $this->loadModel('Ufs');
            $this->set(compact('escola'));
            $this->set('escolaSituacoes', $this->EscolaSituacoes->getOptions());
            $this->set('ufs', $this->Ufs->getOptions());
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    public function infraGeralVisualizar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }

}
