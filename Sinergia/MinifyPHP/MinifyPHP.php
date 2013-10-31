<?php

namespace Sinergia\MinifyPHP;

/**
 * Class MinifyPHP
 * @package Sinergia\MinifyPHP
 */
class MinifyPHP
{
    //constante para token customizado
    protected $T_CUSTOM = 1;
    //separador para auxílio no processamento
    public $separator = " ";
    //Lista com os tokens a serem removidos antes do retorno
    public $removeList = array();
    //Guarda a constante do último token processado para que possa ser usado no processamento atual
    private $previousTokenType = "";
    //Guarda a string do último token processado para que possa ser usado no processamento atual
    private $previousStr = "";

    /**
     * Gera todos os tokens, faz o processamento necessário e retorna string com código minimizado.
     * @param string $code
     * @return string
     */
    public function minify($code)
    {
        $tokens = token_get_all($code);
        $minified = "";

        //percorre todos os tokens e concatena
        foreach ($tokens as $token) {
            $result = $this->minifyToken($token);
            $minified .= $result;
            if (!empty($result)) {
                @$this->previousStr = $result;
            }
        }

        return $minified;
    }

    /**
     * Analiza os tokens individualmente e os retorna com a formatação
     * necessária para formação de arquivo min após concatenação
     * @param $token
     * @return string
     */
    public function minifyToken($token)
    {
        if (!is_array($token)) {
            $type = $this->T_CUSTOM;
            $str = $token;
        } else {
            list($type, $str) = $token;
            if ($type != T_WHITESPACE) {
                @$this->previousTokenType = $type;
            }
        }

        switch ($type) {

            case @T_WHITESPACE :
                return "";
            case @T_DOC_COMMENT :
            case @T_COMMENT :
            case @T_INLINE_HTML :
            case @T_ML_COMMENT :
                return in_array($type, $this->removeList) ? "" : $str;
            case @T_ECHO :
            case @T_CLASS :
            case @T_FUNCTION :
            case @T_ABSTRACT :
            case @T_CASE :
            case @T_CONST :
            case @T_CONTINUE :
            case @T_DIR :
            case @T_FILE :
            case @T_FUNC_C :
            case @T_METHOD_C :
            case @T_NS_C :
            case @T_TRAIT_C :
            case @T_ELSE :
            case @T_FINALLY :
            case @T_FINAL :
            case @T_GLOBAL :
            case @T_GOTO :
            case @T_INTERFACE :
            case @T_LINE :
            case @T_LOGICAL_AND :
            case @T_LOGICAL_OR :
            case @T_LOGICAL_XOR :
            case @T_NAMESPACE :
            case @T_NEW :
            case @T_OLD_FUNCTION :
            case @T_OPEN_TAG :
            case @T_PRIVATE :
            case @T_PUBLIC :
            case @T_PROTECTED :
            case @T_PRINT :
            case @T_RETURN :
            case @T_STATIC :
            case @T_STRING_VARNAME :
            case @T_SWITCH :
            case @T_THROW :
            case @T_TRAIT :
            case @T_USE :
            case @T_VAR :
            case @T_INCLUDE :
            case @T_INCLUDE_ONCE :
            case @T_REQUIRE :
            case @T_REQUIRE_ONCE :
                return $str . $this->separator;
            case @T_EXTENDS :
            case @T_IMPLEMENTS :
            case @T_INSTANCEOF :
            case @T_INSTEADOF :
            case @T_AS :
                return $this->separator . $str . $this->separator;
            case @T_LNUMBER :
            case @T_DNUMBER :
                return $this->ptNumber($str);
            case $this->T_CUSTOM :
                return $this->custom($str);
            default:
                return $str;
        }
    }

    /**
     * Se o caracter for um número verifica se o anterior é '.' e adiciona espaço antes do número.
     * @param $str
     * @return string
     */
    protected function ptNumber($str)
    {
        if ($this->previousStr == ' .') {
            return $this->separator . $str;
        }
        return $str;
    }

    /**
     * Utilizado para chamar funcoes customizadas
     * @param $str
     * @return string
     */
    protected function custom($str)
    {
        $str = $this->operadores($str);
        $this->previousTokenType = null;
        return $str;
    }

    /**
     * Verifica se é necessário colocar espaço antes ou depois dos caracteres contidos no array $operadores
     * @param $str
     * @return string
     */
    protected function operadores($str)
    {
        $operadores = array ('+', '-', '*', '/', '\\', '<', '>', '=', '|', '^', '%', '!', '.', ':',);
        if ($this->previousTokenType == @T_END_HEREDOC && $str == ';') {
            $str .= PHP_EOL;
        }
        if (($str == '.' && ($this->previousTokenType == T_LNUMBER || $this->previousTokenType == T_DNUMBER))) {
            $str = $this->separator . $str;
        }
        if (in_array($str, $operadores)) {
            if (in_array($this->previousStr, $operadores)) {
                $str = $this->separator . $str;
            }
        }

        return $str;
    }

    /*
        Tokens com retorno sem alteracoes

            case @T_START_HEREDOC :
            case @T_END_HEREDOC :
            case @T_DOUBLE_ARROW :
            case @T_LIST :
            case T_VARIABLE :
            case T_ARRAY :
            case T_ARRAY_CAST :
            case T_BOOL_CAST :
            case T_BREAK :
            case T_CALLABLE :
            case T_CATCH :
            case T_CLASS_C :
            case T_CLONE :
            case T_CLOSE_TAG :
            case T_CURLY_OPEN :
            case T_DECLARE :
            case T_DEFAULT :
            case T_DO :
            case T_CONSTANT_ENCAPSED_STRING :
            case T_DOLLAR_OPEN_CURLY_BRACES :
            case T_DOUBLE_CAST :
            case T_DOUBLE_COLON :
            case T_ELSEIF :
            case T_EMPTY :
            case T_ENCAPSED_AND_WHITESPACE :
            case T_ENDDECLARE :
            case T_ENDFOR :
            case T_ENDFOREACH :
            case T_ENDIF :
            case T_ENDSWITCH :
            case T_ENDWHILE :
            case T_EVAL :
            case T_EXIT :
            case T_FOR :
            case T_FOREACH :
            case T_IF :
            case T_HALT_COMPILER :
            case T_INT_CAST :
            case T_ISSET :
            case T_NS_SEPARATOR :
            case T_OBJECT_CAST :
            case T_OBJECT_OPERATOR :
            case T_NUM_STRING :
            case T_OPEN_TAG_WITH_ECHO :
            case T_PAAMAYIM_NEKUDOTAYIM :
            case T_STRING_CAST :
            case T_TRY :
            case T_UNSET_CAST :
            case T_UNSET :
            case T_WHILE :
            case @T_AND_EQUAL :          //Operators
            case @T_BOOLEAN_AND :
            case @T_BOOLEAN_OR :
            case @T_CONCAT_EQUAL :
            case @T_INC :
            case @T_DEC :
            case @T_DIV_EQUAL :
            case @T_IS_EQUAL :
            case @T_IS_GREATER_OR_EQUAL :
            case @T_IS_IDENTICAL :
            case @T_IS_NOT_EQUAL :
            case @T_IS_NOT_IDENTICAL :
            case @T_IS_SMALLER_OR_EQUAL :
            case @T_MOD_EQUAL :
            case @T_MUL_EQUAL :
            case @T_MINUS_EQUAL :
            case @T_OR_EQUAL :
            case @T_PLUS_EQUAL :
            case @T_SL :
            case @T_SL_EQUAL :
            case @T_SR :
            case @T_SR_EQUAL :
            case @T_XOR_EQUAL :
            case @T_YIELD :
                return $str;
            */
}
