<?php

use Sinergia\MinifyPHP\MinifyPHP;

class MinifyPHPTest extends PHPUnit_Framework_Testcase
{
    protected $minify;

    public function setUp()
    {
        $this->minify = new MinifyPHP();
        $this->minify->separator = " ";
    }

    public function testPHP()
    {
        $code = "2;";
        $mini = $this->minify->minify("<?$code");
        $expected = "<?2;";
        eval($code);
        $this->assertEquals($expected, $mini);
    }
}
