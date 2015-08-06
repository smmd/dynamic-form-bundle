<?php

namespace Linio\DynamicFormBundle\Tests\FormlyMapper\FormlyField;

use Linio\DynamicFormBundle\FormlyMapper\FormlyField\UrlField;

class UrlFieldTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UrlField
     */
    protected $formlyField;

    public function testIsAddingUrlFields()
    {
        $fieldConfiguration = [
            'name' => 'url',
            'type' => 'url',
            'options' => [
                'required' => true,
                'label' => 'URL',
            ],
            'validation' => [
                'Symfony\Component\Validator\Constraints\Regex' => [
                    'pattern' => '^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$',
                    'message' => 'The url do not have the correct format',
                ],
            ],
        ];

        $expected = [
            'key' => 'url',
            'type' => 'input',
            'templateOptions' => [
                'type' => 'url',
                'label' => 'URL',
                'required' => true,
                'pattern' => '^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$',
            ],
            'validation' => [
                'messages' => 'The url do not have the correct format',
            ],
        ];

        $this->formlyField->setFieldConfiguration($fieldConfiguration);
        $this->formlyField->generateCommonConfiguration();
        $actual = $this->formlyField->getFieldConfiguration();

        $this->assertEquals($expected, $actual);
    }

    public function setup()
    {
        $this->formlyField = new UrlField();
    }
}
