<?php

namespace App\Validators;

use App\Services\Template\TemplateProvider;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use PHPUnit_Framework_TestCase;

class TemplateTest extends PHPUnit_Framework_TestCase
{
    /** @var TemplateProvider|MockObject */
    private $templateProvider;

    /** @var Template */
    private $validator;

    public function setUp()
    {
        $this->templateProvider = $this->getMock(TemplateProvider::class, [], [], '', false);
        $this->validator = new Template($this->templateProvider);
    }

    /**
     * @param mixed $invalidData The value being tested
     * @param array $templates
     *
     * @dataProvider invalidValueProvider
     */
    public function testValidateReturnsFalseForInvalidData($invalidData, array $templates)
    {
        $this->templateProvider->expects($this->any())
            ->method('getTemplates')
            ->willReturn($templates);

        $this->assertFalse($this->validator->validate('unused', $invalidData));
    }

    public function testValidData()
    {
        $this->templateProvider->expects($this->once())
            ->method('getTemplates')
            ->willReturn(['blog', 'page', 'post']);

        $this->assertTrue($this->validator->validate('unused', 'page'));
    }

    /**
     * @return array
     */
    public function invalidValueProvider()
    {
        return [
            'Invalid Template Name' => [123, []],
            'Unavailable Template' => ['page', ['post', 'blog']]
        ];
    }
}
