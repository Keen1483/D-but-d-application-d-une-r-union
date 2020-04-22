<?php
namespace FormBuilder;
 
use \KeenFram\FormBuilder;
use \KeenFram\StringField;
use \KeenFram\TextField;
use \KeenFram\MaxLengthValidator;
use \KeenFram\NotNullValidator;
use KeenFram\StringFieldFile;
use \KeenFram\StringFieldTel;
use \KeenFram\StringFieldText;
use \KeenFram\StringFieldNumber;

class DetteFormBuilder extends FormBuilder
{
  public function build()
  {
    /*$this->form->add(new StringFieldText([
    'label' => 'Nom',
    'name' => 'nom',
    'maxLength' => 20,
    'validators' => [
      new MaxLengthValidator('Le nom spécifié est trop long (20 caractères maximum)', 20),
      new NotNullValidator('Merci de spécifier le nom du membre'),
    ],
    ]))
    ->add(new StringFieldText([
        'label' => 'Prenom',
        'name' => 'prenom',
        'maxLength' => 20,
        'validators' => [
            new MaxLengthValidator('Le prenom spécifié est trop long (20 caractères maximum)', 20),
            new NotNullValidator('Merci de spécifier le prenom du membre'),
        ],
    ]))
    ->add(new StringFieldNumber([
    'label' => 'Somme',
    'name' => 'somme',
    'validators' => [
        new NotNullValidator('Merci de spécifer la somme à empruntée'),
    ],
    ]));*/
    
    $this->form->add(new StringFieldNumber([
      'label' => 'Somme',
      'name' => 'somme',
      'validators' => [
          new NotNullValidator('Merci de spécifer la somme à empruntée'),
      ],
      ]));
  }
}