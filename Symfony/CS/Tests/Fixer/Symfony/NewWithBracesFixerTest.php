<?php

/*
 * This file is part of the Symfony CS utility.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\CS\Tests\Fixer\Symfony;

use Symfony\CS\Tests\Fixer\AbstractFixerTestBase;

/**
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 */
class NewWithBracesFixerTest extends AbstractFixerTestBase
{
    /**
     * @dataProvider provideStandardCases
     */
    public function testStandard($expected, $input = null)
    {
        $this->makeTest($expected, $input);
    }

    /**
     * @dataProvider provide54Cases
     * @requires PHP 5.4
     */
    public function test54($expected, $input = null)
    {
        $this->makeTest($expected, $input);
    }

    public function provideStandardCases()
    {
        return array(
            array('<?php $x = new X();', '<?php $x = new X;'),
            array('<?php $y = new Y() ;', '<?php $y = new Y ;'),
            array('<?php $foo = new $foo();', '<?php $foo = new $foo;'),
            array('<?php $baz = new {$bar->baz}();', '<?php $baz = new {$bar->baz};'),
            array('<?php $xyz = new X(new Y(new Z()));', '<?php $xyz = new X(new Y(new Z));'),
            array('<?php $foo = (new $bar())->foo;', '<?php $foo = (new $bar)->foo;'),
            array('<?php $self = new self();', '<?php $self = new self;'),
            array('<?php $static = new static();', '<?php $static = new static;'),
            array('<?php $magic = new __CLASS__();', '<?php $magic = new __CLASS__;'),
            array(
                '<?php $a = array( "key" => new DateTime(), );',
                '<?php $a = array( "key" => new DateTime, );',
            ),
            array(
                '<?php $a = array( "key" => new DateTime() );',
                '<?php $a = array( "key" => new DateTime );',
            ),
            array(
                '<?php $a = new $b[$c]();',
                '<?php $a = new $b[$c];',
            ),
            array(
                '<?php $a = new $b[$c[$d ? foo() : bar("bar[...]") - 1]]();',
                '<?php $a = new $b[$c[$d ? foo() : bar("bar[...]") - 1]];',
            ),
        );
    }

    public function provide54Cases()
    {
        return array(
            array(
                '<?php $a = [ "key" => new DateTime(), ];',
                '<?php $a = [ "key" => new DateTime, ];',
            ),
            array(
                '<?php $a = [ "key" => new DateTime() ];',
                '<?php $a = [ "key" => new DateTime ];',
            ),
        );
    }
}
