<?php namespace App\Libraries;

class Template
{
    public function render($view, $data = [])
    {
        return view($view, $data);
    }
}