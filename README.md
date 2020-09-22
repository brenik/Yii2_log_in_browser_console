
# Yii2. Display debugging information in the browser console. Вывод отладочной информации в консоль браузера.

Вывод в консоль иногда очень удобна. Но в Yii2 я не смог найти готовой реализации, а свои логи Yii2 пишет в файлы, что не всегда удобно при отладке.

* Первое что я нашёл, и что наверное используют многие:

```php
echo '<pre>'.print_r($arr, true).'</pre>';
```

* Получили много текста.

```php
class AppController extends Controller
{
    public  function d($arr){
        echo '<pre>'.print_r($arr, true).'</pre>';
    }
}
```

* Свой контроллер расширяем от AppController, и теперь можем использовать такую конструкцию в контроллерах:
```php
 $test1="Точка входа 1";
 $this->d('бла бла бла actionIndex'.$test1);
```
* Но как оказалось, для того что бы увидеть этот текст на экране нужно ещё и остановить выполнение скрипта:
```php
       $test1="Точка входа 1";
       $this->d('actionIndex'.$test1);
       exit();
```
* После чего начинаются пляски, раскомментировать exit(), закомментировать, раскомментировать, закомментировать. Страшно не удобно. Но других вариантов я вначале не нашёл.
* А как насчёт вывода в видах. Обычно делаю так:
В корне Yii2 созадется файл functions.php

```php
<?php

 function d($arr){
     echo '<br>';
        echo '<pre>'.print_r($arr, true).'</pre>';
     echo '<br>';
}
```
Этот файл подключается в index.php
```php
require __DIR__ . '/../functions.php';
```
Теперь мы можем использовать такую конструкцию в видах:
```html
<?=d("Начало контента для страницы")?>
```
* А теперь непосредственно про вывод в консоль браузера. Выше перечисленные методы неудобны тем что для отладки их постоянно нужно то включать, то отключать.
Потому я продолжил искать возможность вывода информации в консоль браузера. И нашёл такой вариант:

```php
  function l($str){
        define("NL","\r\n");
        echo '<script type="text/javascript">'.NL;
        echo 'console.log("'.$arr.'");'.NL;
        echo '</script>'.NL;
    }
```
Здесь мы используем JavaScript для отладки PHP кода. Конечно не во всех браузерах есть консоль. И данное решение выводит только строку.

* Добавляем json_encode для того что бы видеть массив из объектов:
```php
        define("NL","\r\n");
        echo '<script type="text/javascript">'.NL;
        echo 'var jsarr = '.json_encode($arr).';';
        echo 'console.log(jsarr);'.NL;
        echo '</script>'.NL;
```
* Не совсем наглядно. Можно и развернуть наш массив
```php
        define("NL","\r\n");
        echo '<script type="text/javascript">'.NL;
        echo 'var jsarr = '.json_encode($arr).';';
		echo  'jsarr.forEach(function(element) { console.log(element);} )';
        echo '</script>'.NL;
```
 Но такой вариант уже не читает строку. Только массив, к тому же вывод не информативный.
* Добавляем проверку, определяемся строка или массив, после чего для массива используем функцию console.table
```php
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
```
*	Теперь мы получаем в консоли удобную табличку для отображения нашего массива. И строка выводится корректно.

