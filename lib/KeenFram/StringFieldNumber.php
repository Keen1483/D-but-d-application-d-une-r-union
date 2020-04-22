<?php
namespace KeenFram;

class StringFieldNumber extends StringField
{
    public function widget($type)
    {
        $type = 'number';
        $this->setType($type);

        return $this->build($type);
    }
}