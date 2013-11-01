<?php

use Sinergia\MinifyPHP\MinifyPHP;

class MinifyPHPTest extends PHPUnit_Framework_Testcase
{
    /**
     * @var MinifyPHP
     */
    protected $minify;

    /**
     * Instancia a classe minify
     */
    public function setUp()
    {
        $this->minify = new MinifyPHP();
        $this->minify->separator = " ";
    }

    /**
     * Teste mínimo
     */
    public function test1()
    {
        $code = "2;";
        $mini = $this->minify->minify("<?php $code");
        $expected = "<?php  2;" . PHP_EOL;
        $this->assertEquals($expected, $mini);
    }

    /**
     * Testa minifizacao de arquivo.
     */
    public function testArquivoArrays()
    {
        $code = file_get_contents ('/Users/paliari/daniel/minifyphp/tests/fixtures/ArquivoArrays.php');
        $result = file_get_contents ('/Users/paliari/daniel/minifyphp/tests/ModeloMin/ArquivoArrays.php');
        $this->minify->removeList = array (
            @T_DOC_COMMENT,
            @T_COMMENT,
            @T_INLINE_HTML,
            @T_ML_COMMENT,
        );
        $mini = $this->minify->minify($code);
        $this->assertEquals($result, $mini);
    }

    /**
     * Testa minimizacao de todos os tokens possíveis no php
     */
    public function testAll_tokens()
    {
        $code = file_get_contents ('/Users/paliari/daniel/minifyphp/tests/fixtures/all_tokens.php');
        $result = file_get_contents ('/Users/paliari/daniel/minifyphp/tests/ModeloMin/all_tokens.php');
        $this->minify->removeList = array (
            @T_DOC_COMMENT,
            @T_COMMENT,
            @T_INLINE_HTML,
            @T_ML_COMMENT,
        );
        $mini = $this->minify->minify($code);
        $this->assertEquals($result, $mini);
    }

    /**
     * Testa minimizacao da classe CPF
     */
    public function testCpf()
    {
        $code = file_get_contents ('/Users/paliari/daniel/minifyphp/tests/fixtures/CPF.php');
        $result = file_get_contents ('/Users/paliari/daniel/minifyphp/tests/ModeloMin/CPF.php');
        $this->minify->removeList = array (
            @T_DOC_COMMENT,
            @T_COMMENT,
            @T_INLINE_HTML,
            @T_ML_COMMENT,
        );
        $mini = $this->minify->minify($code);
        $this->assertEquals($result, $mini);
    }
}
