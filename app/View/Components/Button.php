<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    public function isHtml($text){
        $text = trim($text);
        return $text !== strip_tags($text);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function(array $data){
            return $this->isHtml($data['slot']) ? 'components.buttons.with-icon' : 'components.buttons.with-text';
        };
    }
}