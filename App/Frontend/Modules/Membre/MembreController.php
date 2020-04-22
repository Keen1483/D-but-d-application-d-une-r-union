<?php
namespace App\Frontend\Modules\Membre;

use \KeenFram\BackController;
use \KeenFram\HTTPRequest;

class MembreController extends BackController
{
    public function executeIndex(HTTPRequest $request)
	{
		// On ajoute une définition pour le titre.
		$this->page->addVar('title', 'Liste des membres');
 
		// On récupère le manager des Membre.
		$manager = $this->managers->getManagerOf('Membre');
 
		$listeMembre = $manager->getList();
 
		// On ajoute la variable $listeNews à la vue.
		$this->page->addVar('listeMembre', $listeMembre);
	}

	public function executeShowMembre(HTTPRequest $request)
	{
		$membre = $this->managers->getManagerOf('Membre')->getUnique($request->getData('id'));
 
		if (empty($membre))
		{
			$this->app->httpResponse()->redirect404();
		}
 
		$this->page->addVar('title', $membre->nom().' '.$membre->prenom());
		$this->page->addVar('membre', $membre);
	}
}