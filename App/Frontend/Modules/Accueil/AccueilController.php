<?php
namespace App\Frontend\Modules\Accueil;

use \KeenFram\BackController;
use \KeenFram\HTTPRequest;

class AccueilController extends BackController
{
    public function executeIndex(HTTPRequest $request)
	{
		// On ajoute une définition pour le titre.
		$this->page->addVar('title', 'APProot');
	}
}