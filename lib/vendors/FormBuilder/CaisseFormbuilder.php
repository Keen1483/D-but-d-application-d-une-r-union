<?php
namespace FormBuilder;
 
use \KeenFram\FormBuilder;
use \KeenFram\StringField;
use \KeenFram\TextField;
use \KeenFram\MaxLengthValidator;
use \KeenFram\NotNullValidator;
use \KeenFram\StringFieldFile;
use \KeenFram\StringFieldNumber;
use \KeenFram\StringFieldTel;
use \KeenFram\StringFieldText;

class CaisseFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringFieldNumber([
        'label' => 'Entree',
        'name' => 'entree',
        ]))
        ->add(new StringFieldNumber([
           'label' => 'Sortie',
           'name' => 'sortie',
        ]))
        ->add(new TextField([
         'label' => 'Raison',
         'name' => 'raison',
         'rows' => 7,
         'cols' => 50,
         'validators' => [
           new NotNullValidator('Merci de spécifer la raison de l\'opération effectuée'),
         ],
       ]));
  }
}