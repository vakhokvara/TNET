<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/task1', function () {


    function shortestWordLength($sentence) {
        $words = explode(' ', $sentence);
        $shortestLength = strlen($words[0]);

        foreach ($words as $word) {
            $wordLength = strlen($word);

            if ($wordLength < $shortestLength) {
                $shortestLength = $wordLength;
            }
        }

        return $shortestLength;
    }

    $sentence1 = "bitcoin take over the world maybe who knows perhaps";
    $sentence2 = "turns out random test cases are easier than writing out basic ones";

    echo shortestWordLength($sentence1);

});


Route::get('/task2', function (){

    function arrayElementCount($arr){

        $count = count($arr);

        foreach ($arr as $item){
            if(is_array($item)){
                $count += arrayElementCount($item);
            }
        }

        return $count;
    }
    $arr1 = [1,2,3];
    $arr2 = ["x", "y", ["z"]];
    $arr3 = [1, 2, [3, 4, [5]]];

    echo arrayElementCount($arr3);

});

Route::get('/task3', function (){

    function stringReplace($str){
        $replacedStr = '';

        for ($i=0; $i<strlen($str)-1; $i++){
            for($j=$i+1; $j<strlen($str)-1; $j++){
                if ($str[$i] == $str[$j]){
                    $replacedStr  .= ')';
                }else
                {
                    $replacedStr .= '(';
                }
            };
        }
        return $replacedStr;
    }

    $str1 = "din";
    $str2 = "recede";

    echo stringReplace($str2);

});

Route::get('/task4', function (){

    function solve($input) {
        $result = '';
        $count = '';

        for ($i = 0; $i < strlen($input); $i++) {
            $char = $input[$i];

            if (ctype_alpha($char)) {
                $result .= $char;
            } elseif (ctype_digit($char)) {
                $count .= $char;
            } elseif ($char == '(') {
                $startIndex = $i + 1;
                $nestedCount = 1;

                while ($nestedCount > 0) {
                    $i++;
                    if ($input[$i] == '(') {
                        $nestedCount++;
                    } elseif ($input[$i] == ')') {
                        $nestedCount--;
                    }
                }

                $substring = substr($input, $startIndex, $i - $startIndex);
                $result .= str_repeat(solve($substring), intval($count));
                $count = '';
            }
        }

        return $result;
    }

//    echo solve("3(ab)");
    echo solve("2(a3(b))");
});
