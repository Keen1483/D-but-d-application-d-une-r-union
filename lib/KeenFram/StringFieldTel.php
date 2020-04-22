<?php
namespace KeenFram;

class StringFieldTel extends StringField
{
    public function widget($type)
    {
        $type = 'tel';
        $this->setType($type);
    
        return $this->build($type);
    }
}