<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


abstract class AbstractController
{
    protected function renderPartial(string $template, array $values)
    {
        $data = $values;

        require "templates/".$template.".phtml";
    }

    protected function render(string $template, array $values)
    {
        $data = $values;

        require "templates/layout.phtml";
    }

    protected function renderJson(array $values)
    {
        echo json_encode($values);
    }
}