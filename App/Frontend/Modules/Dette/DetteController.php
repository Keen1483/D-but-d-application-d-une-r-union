<?php
namespace App\Frontend\Modules\Dette;

use \KeenFram\BackController;
use \KeenFram\HTTPRequest;
use \Entity\Dette;


class DetteController extends BackController
{
    public function executeIndex(HTTPRequest $request)
	{
		// On ajoute une définition pour le titre.
		$this->page->addVar('title', 'Liste des dettes');
 
		// On récupère le manager des dette.
		$manager = $this->managers->getManagerOf('Dette');
 
		$listeDettes = $manager->consulterDette();
 
		// On ajoute la variable $listeDettes à la vue.
		$this->page->addVar('listeDettes', $listeDettes);
	}

	public function executeShowDette(HTTPRequest $request)
	{
		$dettes = $this->managers->getManagerOf('Dette')->consulterUniqueDette($request->getData('id'));
 
 
		$this->page->addVar('title', 'Historique de la dette');
		$this->page->addVar('dettes', $dettes);

		$membre = $this->managers->getManagerOf('Membre')->getUnique($request->getData('id'));
 
		if (empty($membre))
		{
			$this->app->httpResponse()->redirect404();
		}
 
		$this->page->addVar('membre', $membre);
	
	}
}