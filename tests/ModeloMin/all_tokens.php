<?php
 namespace Foo\Bar;include 'dummy.php';require 'dummy.php';include_once 'dummy.php';require_once 'dummy.php';trait MyTrait{function foo(){}}trait YourTrait{function foo(){}}goto label;abstract class ClasseAbstrata extends \stdClass{const c=0;use MyTrait,YourTrait{MyTrait::foo insteadof YourTrait;}};interface Interf{};final class Classe extends ClasseAbstrata implements Interf{public static $public='Public';protected $protected='Protected';private $private='Private';public $v='v';function &f(Array$p1,String$p2,Int$p3,Callable$c){global $v;__DIR__ ;__TRAIT__ ;__NAMESPACE__ ;__FILE__ ;__LINE__ ;__CLASS__;__METHOD__ ;self::$public;parent::c;return __FUNCTION__ ;}};$obj=@new Classe();isset($obj->v);$obj=clone$obj;$obj=(object)$obj;list($v)=(int)2;$v+=1;$v-=1;$v*=2;$v/=1;$v=$v*(1+0 -1/1)%1;$v++;$v--;$v&=1;$v=$v&1;$v|=3;$v=$v|1;$v^=2;$v=$v^1;$v<<=1;$v<<1;$v>>=3;$v>>3;$v%=(double)1.0;$b=1<2;$b=1>2;$b=1<=2;$b=1>=2;$n=null;empty($v);$a1=array(array('key'=>'value','KEY'=>"VALUE"));foreach($a1 as $a2):$a=(array)$a2;break;endforeach;for(;false;):eval("");endfor;do{continue ;}while(0>=1);while(1<=0):exit();die();endwhile;$j=<<<Heredoc
teste";
Heredoc;
$s=<<<Heredoc
text";
Heredoc;
$s=<<<'nowdoc'
text";
nowdoc;
$s.="other {$v} 'teste' \"teste\" $a[key] ${v }".(String)Classe::c.'single quotes';$exp=(bool)((true==true)&&(true===true)||(true!=false)and (true!==false)or truexor (!false));try{throw new \Exception();}catch(\Exception$e){if(!($e instanceof \Exception)):print "";elseif(false):echo "";?><?="";?><?php
 else :endif;}switch ($v):case 0:break;default:break;endswitch;function (){};unset($v);(unset)$s;__halt_compiler();
