<?php
namespace App\Backend\Modules\Caisses;
 
use \KeenFram\BackController;
use \KeenFram\HTTPRequest;
use \Entity\Caisses;
use \Entity\CaisseDivers;
use \Entity\CaisseDiversTontines;
use \Entity\CaisseFanfare;
use \Entity\CaisseFondsSecours;
use \Entity\CaisseInterets;
use \Entity\CaisseSanctions;
use \Entity\CaisseTotal;
use \FormBuilder\CaisseFormBuilder;
use \KeenFram\FormHandler;

class CaissesController extends BackController
{
  public function executeInsertCaisses(HTTPRequest $request)
  {
    $formsDiversTontines = $this->processForm($request, 'diversTontines', 'caisse_divers_tontines');
    $this->page->addVar('formsDiversTontines', $formsDiversTontines->createView());

    $formsSanctions = $this->processForm($request, 'sanctions', 'caisse_sanctions');
    $this->page->addVar('formsSanctions', $formsSanctions->createView());

    $formsFondsSecours = $this->processForm($request, 'fondsSecours', 'caisse_fonds_secours');
    $this->page->addVar('formsFondsSecours', $formsFondsSecours->createView());

    $formsFanfare = $this->processForm($request, 'fanfare', 'caisse_fanfare');
    $this->page->addVar('formsFanfare', $formsFanfare->createView());

    $formsInterets = $this->processForm($request, 'interets', 'caisse_interets');
    $this->page->addVar('formsInterets', $formsInterets->createView());

    $formsDivers = $this->processForm($request, 'divers', 'caisse_divers');
    $this->page->addVar('formsDivers', $formsDivers->createView());

    $this->page->addVar('title', 'Entées et sorties du jour');
  }

  public function processForm(HTTPRequest $request, $suff, $table)
  {
    $caisseNom = '\Entity\Caisse' . ucfirst($suff);
    $manager = $this->managers->getManagerOf('Caisses');

    if($request->method() == 'POST')
    {
      $caisse = new $caisseNom([
        'entree' => $request->postData('entree'),
        'sortie' => $request->postData('sortie'),
        'raison' => $request->postData('raison')
      ]);

      $table = $request->postData('table');

      if ($request->getExists('id'))
      {
        $caisse->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la caisse est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $manager->setTable($table);
        $caisse = $manager->getUnique($request->getData('id'));
      }
      else
      {
        $caisse = new $caisseNom;
      }
    }

    $formBuilder = new CaisseFormBuilder($caisse);
    $formBuilder->build();
 
    $form = $formBuilder->form();

    $manager->setTable($table);
    $formHandler = new FormHandler($form, $manager, $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($caisse->isNew() ? 'La caisse a bien été ajoutée !' : 'La caisse a bien été modifiée !');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    return $form;
  }
}