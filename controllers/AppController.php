<?php
/**
 * Created by User: Fox.
 * Date: 20.10.2018
 * Time: 10:07
 */

namespace app\controllers;

use yii\web\Controller;

class AppController extends Controller
{
    public  function d($arr){
        echo '<pre>'.print_r($arr, true).'</pre>';
    }

    function l($arr){
        define("NL","\r\n");
        echo '<script type="text/javascript">'.NL;
        echo 'var jsarr = '.json_encode($arr).';';
        if (is_string($arr)) {
            echo 'console.log(jsarr);' . NL;
        }
        else            {
            echo 'console.table(jsarr);' . NL;
        }
        echo '</script>'.NL;
    }

}


