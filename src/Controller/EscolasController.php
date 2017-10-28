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
        $escolas = $this->paginate($this->Escolas->listar());
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
                    'action' => 'identificacaoExibir',
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
     * Retira a escola da rede GRE
     * 
     * @param int $escolaId
     * @return void
     */
    public function greRetirar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            if ($this->Escolas->greRetirar($escola)) {
                $this->Flash->success('A escola foi retirada da rede GRE.');
            } else {
                $this->Flash->error('Ocorreu um erro ao retirar a escola da rede GRE.');
            }
            return $this->redirect([
                'action' => 'identificacaoExibir',
                $escola->id,
            ]);
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Integra a escola à rede GRE
     * 
     * @param int $escolaId
     * @return void
     */
    public function greIntegrar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            if ($this->Escolas->greIntegrar($escola)) {
                $this->Flash->success('A escola foi integrada à rede GRE.');
            } else {
                $this->Flash->error('Ocorreu um erro ao integrar a escola à rede GRE.');
            }
            return $this->redirect([
                'action' => 'identificacaoExibir',
                $escola->id,
            ]);
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }

    /**
     * Visualização dos dados de identificação de uma escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function identificacaoExibir($escolaId = null)
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
                        'action' => 'identificacaoExibir',
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
    
    /**
     * Visualização das informações gerais da infraestrutura da escola especificada
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraCaracterizacaoExibir($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getCaracterizacao($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Edição da caracterização da infraestrutura da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraCaracterizacaoEditar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getCaracterizacao($escolaId);
            if ($this->request->is(['post', 'put'])) {
                $escola = $this->Escolas->patchCaracterizacao($escola, $this->request->getData());
                $escola->id = $escolaId;
                if ($this->Escolas->save($escola)) {
                    $this->Flash->success('As informações da escola foram atualizadas!');
                    return $this->redirect([
                        'action' => 'infraCaracterizacaoExibir',
                        $escolaId,
                    ]);
                }
            }
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Listagem dos locais de funcionamento da escola especificada
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraLocaisListar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            $this->loadModel('EscolaLocais');
            $escolaLocais = $this->EscolaLocais->listar($escola->id);
            $this->set(compact('escola'));
            $this->set(compact('escolaLocais'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Cadastro de local de funcionamento da escola especificada
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraLocaisCadastrar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            $this->loadModel('EscolaLocais');
            $escolaLocal = $this->EscolaLocais->newEntity();
            if($this->request->is(['post', 'put'])) {
                $escolaLocal = $this->EscolaLocais->patchEntity($escolaLocal, $this->request->getData());
                $escolaLocal->escola_id = $escola->id;
                if ($this->EscolaLocais->save($escolaLocal)) {
                    $this->Flash->success('O local foi cadastrado com sucesso!');
                    return $this->redirect([
                        'action' => 'infraLocaisListar',
                        $escola->id,
                    ]);
                }
                $this->Flash->error('Não foi possível salvar as informações!');
            }
            $this->loadModel('PredioOcupacaoFormas');
            $this->loadModel('EscolaLocalTipos');
            $this->set('predioOcupacaoFormas', $this->PredioOcupacaoFormas->getOptions());
            $this->set('escolaLocalTipos', $this->EscolaLocalTipos->getOptions());
            $this->set(compact('escolaLocal'));
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Edição das informações do local de funcionamento da escola
     * 
     * @param int $escolaLocalId
     * @return void
     */
    public function infraLocaisEditar($escolaLocalId = null)
    {
        try {            
            $this->loadModel('EscolaLocais');
            $escolaLocal = $this->EscolaLocais->get($escolaLocalId);
            $escola = $escolaLocal->escola;
            if($this->request->is(['post', 'put'])) {
                $escolaLocal = $this->EscolaLocais->patchEntity($escolaLocal, $this->request->getData());
                $escolaLocal->id = $escolaLocalId;
                $escolaLocal->escola_id = $escola->id;
                if ($this->EscolaLocais->save($escolaLocal)) {
                    $this->Flash->success('As informações do local foram atualizadas.');
                    return $this->redirect([
                        'action' => 'infraLocaisListar',
                        $escolaLocal->escola_id,
                    ]);
                }
                $this->Flash->error('Não foi possível salvar as informações!');
            }
            $this->loadModel('PredioOcupacaoFormas');
            $this->loadModel('EscolaLocalTipos');
            $this->set('predioOcupacaoFormas', $this->PredioOcupacaoFormas->getOptions());
            $this->set('escolaLocalTipos', $this->EscolaLocalTipos->getOptions());
            $this->set(compact('escolaLocal'));
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Exclusão do local de funcionamento da escola
     * 
     * @param int $escolaLocalId
     * @return void
     */
    public function infraLocaisExcluir($escolaLocalId = null)
    {
        try {            
            $this->loadModel('EscolaLocais');
            $escolaLocal = $this->EscolaLocais->get($escolaLocalId);
            $escola = $escolaLocal->escola;
            if($this->request->is(['post', 'put'])) {
                if ($this->EscolaLocais->setDeleted($escolaLocal)) {
                    $this->Flash->success('O local de funcionamento foi excluído do sistema.');
                    return $this->redirect([
                        'action' => 'infraLocaisListar',
                        $escola->id,
                    ]);
                }
                $this->Flash->error('Não foi possível salvar as informações!');
            }
            $this->set(compact('escolaLocal'));
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Local de funcionamento da escola inválido.');
            return $this->redirect(['action' => 'listar']);
        }
    }

}
