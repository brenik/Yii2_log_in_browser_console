<?php

 function d($arr){
     echo '<br>';
        echo '<pre>'.print_r($arr, true).'</pre>';
     echo '<br>';
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