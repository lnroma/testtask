<?php

/**
 * @autor naumov roman <family_89@mail.ru>
 *
 * @codepool modules
 * @package Shapes
 *
 * this class render index page, and form for editing shape point
 *
 * Class Shapes_Block_Show
 */
class Shapes_Block_Show extends Shapes_Block_Abstract
{

    /**
     * init show block
     */
    public function __construct() {
        parent::__construct();
        $this->_template = 'index';
    }

    /**
     * get form fields for render
     * @return array
     */
    public function getFormFields() {
        $fields =  array(
            'shapes[]' => array(
                'type' => 'select',
                'multiplicate' => '5',
                'values' => array(
                    '-' => '-',
                    'cube' => 'cube',
                    'round' => 'round',
                )
            ),
            'width[]' => array(
                'type' => 'text',
                'multiplicate' => '5',
                'label' => 'Width'
            ),
            'higth[]' => array(
                'type'  => 'text',
                'multiplicate' => '5',
                'label' => 'Higth'
            ),
            'x_position[]' => array(
                'type' => 'text',
                'multiplicate' => '5',
                'label' => 'X position'
            ),
            'y_position[]' => array(
                'type' => 'text',
                'multiplicate' => '5',
                'label' => 'Y position'
            ),
            'red[]' => array(
                'type' => 'text',
                'multiplicate' => '5',
                'label' => 'Color red',
            ),
            'green[]' => array(
                'type' => 'text',
                'multiplicate' => '5',
                'label' => 'Color green',
            ),
            'blue[]' => array(
                'type' => 'text',
                'multiplicate' => '5',
                'label' => 'Color blue',
            ),
            'size[]' => array(
                'type' => 'text',
                'multiplicate' => '1',
                'label' => 'Size holst'
            ),
            'enable[]' => array(
                'type' => 'checkbox',
                'multiplicate' => '5',
                'label' => 'enable'
            )
        );
        return $fields;
    }
}