<?php

namespace Baileylo\Core\Laravel\Html;

class FormBuilder extends \Illuminate\Html\FormBuilder
{
    public function csrfLink($text, array $options)
    {
        $options['class'] = isset($options['class']) ? $options['class'] . ' link' : 'link';
        $open = $this->open($options);

        $buttonAttr = ['type' => 'submit'];
        if(isset($options['title'])) {
            $buttonAttr['title'] = $options['title'];
        }

        $body = $this->button($text, $buttonAttr);
        $close = $this->close();

        return "{$open}{$body}{$close}";
    }
}
