<?php

namespace League\Glide\Api\Manipulator;

use League\Glide\Http\RequestFactory;
use Mockery;

class TextTest extends \PHPUnit_Framework_TestCase
{
    private $manipulator;

    public function setUp()
    {
        $this->manipulator = new Text();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testCreateInstance()
    {
        $this->assertInstanceOf('League\Glide\Api\Manipulator\Text', $this->manipulator);
    }

    public function testRun()
    {
        $this->markTestIncomplete();
        $image = Mockery::mock('Intervention\Image\Image', function ($mock) {
            $mock->shouldReceive('text')->with('The quick brown fox jumps over the lazy dog.')->once();
            $mock->shouldReceive('text')->with('foo/bar.ttf', '24', '#fdf6e3',
                                               'center', 'top', 45,
                                                $this->callback)->andReturn($mock)->once();
        });

        $this->assertInstanceOf(
            'Intervention\Image\Image',
            $this->manipulator->run(RequestFactory::create('image.jpg',
             ['tstring' => 'The quick brown fox jumps over the lazy dog.',
              'tfile' => 'foo/bar.ttf',
              'tsize' => '10',
              'tcolor' => '#fdf6e3',
              'talign' => 'center',
              'tvalign' => 'top',
              'tangle' => '45']), $image)
        );
    }

    public function testGetTextString()
    {
        $this->assertEquals('The quick brown fox jumps over the lazy dog.', $this->manipulator->getTextString('The quick brown fox jumps over the lazy dog.'));
        $this->assertEquals(false, $this->manipulator->getTextString(null));
    }

    public function testGetTextFile()
    {
        $this->assertEquals('foo/bar.ttf', $this->manipulator->getTextFile('foo/bar.ttf'));
        $this->assertEquals('1', $this->manipulator->getTextFile('1'));
        $this->assertEquals(false, $this->manipulator->getTextFile('0'));
        $this->assertEquals(false, $this->manipulator->getTextFile('6'));
        $this->assertEquals(false, $this->manipulator->getTextFile(null));
    }

    public function testGetTextSize()
    {
        $this->assertEquals('10', $this->manipulator->getTextSize('10'));
        $this->assertEquals(false, $this->manipulator->getTextSize('-10'));
        $this->assertEquals(false, $this->manipulator->getTextSize(null));
    }

    public function testGetTextColor()
    {
        $this->assertEquals('#ccc', $this->manipulator->getTextColor('#ccc'));
        $this->assertEquals(false, $this->manipulator->getTextColor('#cccc'));
        $this->assertEquals('#cccccc', $this->manipulator->getTextColor('#cccccc'));
        $this->assertEquals(false, $this->manipulator->getTextColor('#ccccccc'));
        $this->assertEquals('ccc', $this->manipulator->getTextColor('ccc'));
        //$this->assertEquals('rgb(255, 0, 0)', $this->manipulator->getTextColor('rgb(255, 0, 0)'));
        //$this->assertEquals('rgba(255, 0, 0, 1)', $this->manipulator->getTextColor('rgb(255, 0, 0, 1)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgx(255, 0, 0)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgb(-1, 0, 0)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgb(0, -1, 0)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgb(0, 0, -1)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgb(0, 0, -1, 1)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgbx(255, 0, 0, 1)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgba(-1, 0, 0, 1)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgba(0, -1, 0, 1)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgba(0, 0, -1, 1)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgba(255, 0, 0, -1)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor('rgba(255, 0, 0)'));
        //$this->assertEquals(false, $this->manipulator->getTextColor(null));
    }

    public function testGetTextAlign()
    {
        $this->markTestIncomplete();
        $this->assertEquals('left', $this->manipulator->getTextAlign('left'));
        $this->assertEquals('right', $this->manipulator->getTextAlign('right'));
        $this->assertEquals('center', $this->manipulator->getTextAlign('center'));
        $this->assertEquals(false, $this->manipulator->getTextAlign('top'));
        $this->assertEquals(false, $this->manipulator->getTextAlign(null));
    }

    public function testGetTextVAlign()
    {
        $this->markTestIncomplete();
        $this->assertEquals('top', $this->manipulator->getTextVAlign('top'));
        $this->assertEquals('bottom', $this->manipulator->getTextVAlign('bottom'));
        $this->assertEquals('middle', $this->manipulator->getTextVAlign('middle'));
        $this->assertEquals(false, $this->manipulator->getTextVAlign('left'));
        $this->assertEquals(false, $this->manipulator->getTextVAlign(null));
    }

    public function testGetTextAngle()
    {
        $this->markTestIncomplete();
        $this->assertEquals('10', $this->manipulator->getTextAngle('10'));
        $this->assertEquals(false, $this->manipulator->getTextAngle(null));
    }
}
