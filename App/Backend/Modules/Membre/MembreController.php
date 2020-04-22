<?php
namespace App\Backend\Modules\Membre;

use \KeenFram\BackController;
use \KeenFram\HTTPRequest;
use \Entity\Membre;
use \FormBuilder\MembreFormBuilder;
use \KeenFram\FormHandler;

class MembreController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des membres');

        $manager = $this->managers->getManagerOf('Membre');

        $this->page->addVar('listeMembre', $manager->getList());
        $this->page->addVar('nombreMembre', $manager->count());
    }

    public function executeInsertMembre(HTTPRequest $request)
    {
        $this->processForm($request);

        $this->page->addVar('title', 'Inscription d\'un membre');
    }

    public function executeUpdateMembre(HTTPRequest $request)
    {
        $this->processForm($request);
        
        $this->page->addVar('title', 'Modification du membre');
    }

    public function executeDeleteMembre(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('Membre')->delete($request->getData('id'));

        $this->app->user()->setFlash('La membre a bien été supprimée !');
 
        $this->app->httpResponse()->redirect('/admin/membre-index.html');
    }

    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST')
        {
            $membre = new Membre([
            'nom' => $request->postData('nom'),
            'prenom' => $request->postData('prenom'),
            'telephone' => $request->postData('telephone'),
            'photo' => $request->postData('photo'),
            ]);
    
            if ($request->getExists('id'))
            {
                $membre->setId($request->getData('id'));
            }
        }
        else
        {
            // L'identifiant du membre est transmis si on veut la modifier
            if ($request->getExists('id'))
            {
                $membre = $this->managers->getManagerOf('Membre')->getUnique($request->getData('id'));
            }
            else
            {
                $membre = new Membre;
            }
        }
    
        $formBuilder = new MembreFormBuilder($membre);
        $formBuilder->build();
    
        $form = $formBuilder->form();
    
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Membre'), $request);
    
        if ($formHandler->process())
        {
            $this->app->user()->setFlash($membre->isNew() ? 'Le membre a bien été ajoutée !' : 'Le membre a bien été modifiée !');
    
            $this->app->httpResponse()->redirect('/admin/membre-index.html');
        }
    
        $this->page->addVar('form', $form->createView());
    }
}