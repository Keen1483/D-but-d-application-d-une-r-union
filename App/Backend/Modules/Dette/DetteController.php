<?php
namespace App\Backend\Modules\Dette;

use \KeenFram\BackController;
use \KeenFram\HTTPRequest;
use \Entity\Dette;
use \Entity\Membre;
use \FormBuilder\DetteFormBuilder;
use \KeenFram\FormHandler;

class DetteController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des dette');
    
        $manager = $this->managers->getManagerOf('Dette');
    
        $this->page->addVar('listeDettes', $manager->consulterDette());
        $this->page->addVar('nombreDettes', $manager->count());
    }

    public function executeInsertDette(HTTPRequest $request)
    {
      $this->processForm($request);

      	// On récupère le manager des Membre.
		$manager = $this->managers->getManagerOf('Membre');
 
		$listeMembre = $manager->getList();
 
		// On ajoute la variable $listeNews à la vue.
		$this->page->addVar('listeMembre', $listeMembre);
   
      $this->page->addVar('title', 'Ajout d\'une dette');
    }

    public function processForm(HTTPRequest $request)
    {
        $managerMembre = $this->managers->getManagerOf('Membre');
        $managerDette = $this->managers->getManagerOf('Dette');

        if ($request->method() == 'POST')
        {
            $dette = new Dette([
            'somme' => $request->postData('somme')
            ]);

            $data = [
                'nom' => ltrim($request->postData('nom')),
                'prenom' => ltrim($request->postData('prenom'))
            ];
var_dump($data);
            if(!$managerMembre->membreExists($data))
                $this->app->user()->setFlash('Ce membre n\'existe pas');
            else
            {
                $membre = $managerMembre->membreExists($data);
                $managerDette->setMembre($membre);

                $data['dete'] = $request->postData('somme');
                
                $this->page->addVar('data', $data);
            }
    
        }
        else
        {
            $dette = new Dette;
        }
   
        $formBuilder = new DetteFormBuilder($dette);
        $formBuilder->build();
    
        $form = $formBuilder->form();
    
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Dette'), $request);
    
        if ($formHandler->process())
        {
            $this->app->user()->setFlash($dette->isNew() ? 'La dette a bien été ajoutée !' : 'La dette a bien été modifiée !');
    
            $this->app->httpResponse()->redirect('/admin/');
        }
    
        $this->page->addVar('form', $form->createView());
    }
}