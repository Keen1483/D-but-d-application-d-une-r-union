<?php
namespace FormBuilder;
 
use \KeenFram\FormBuilder;
use \KeenFram\StringField;
use \KeenFram\TextField;
use \KeenFram\MaxLengthValidator;
use \KeenFram\NotNullValidator;
use KeenFram\StringFieldText;

class CommentFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringFieldText([
        'label' => 'Auteur',
        'name' => 'auteur',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Contenu',
        'name' => 'contenu',
        'rows' => 7,
        'cols' => 50,
        'validators' => [
          new NotNullValidator('Merci de spécifier votre commentaire'),
        ],
       ]));
  }
}