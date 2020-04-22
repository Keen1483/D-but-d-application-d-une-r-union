<?php
namespace KeenFram;

abstract class StringField extends Field
{
  protected $maxLength;
  protected $type;

  public function buildWidget()
  {
    return $this->widget($this->type);
  }

  abstract public function widget($type);

  public function build($type)
  {
      $widget = '';

      if (!empty($this->errorMessage))
      {
          $widget .= $this->errorMessage.'<br />';
      }
  
      $widget .= '<label>'.$this->label.'</label><input type="'. $type .'" name="'.$this->name.'"';
  
      if (!empty($this->value))
      {
          $widget .= ' value="'.htmlspecialchars($this->value).'"';
      }
  
      if (!empty($this->maxLength))
      {
          $widget .= ' maxlength="'.$this->maxLength.'"';
      }
  
      return $widget .= ' />';
  }
 
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
 
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }

  public function setType($type)
  {
    $arrayType = ['text', 'password', 'tel', 'email', 'url', 'range', 'radio', 'checkbox', 'file', 'number'];

    if(!in_array($type, $arrayType))
    {
      throw new \InvalidArgumentException('Le type de champ '. $type .' n\'est pas disponible');
    }

    $this->type = $type;
  }
}