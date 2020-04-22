<?php
namespace KeenFram;

class StringFieldText extends StringField
{
    public function widget($type)
    {
        $type = 'text';
        $this->setType($type);

        return $this->build($type);
    }
}