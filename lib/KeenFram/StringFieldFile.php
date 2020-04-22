<?php
namespace KeenFram;

class StringFieldFile extends StringField
{
    public function widget($type)
    {
        $type = 'file';
        $this->setType($type);
    
        return $this->build($type);
    }
}