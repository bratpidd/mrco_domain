<?php
define("x", "5");
$x = x + 10;
echo x;




$var = "kukareku";
echo '$var';
echo $var;
echo("$var");
print($var);


$ar = array(
    array(
        'name' => 'Иванов',
        'specialty' => 'хирург'
    ),
    array (
            'name' => 'Петров',
            'specialty' => 'кардиолог'
    )
);
function noIvanov($array){
    $response = [];
    foreach ($array as $v){
        if ($v['name'] !== 'Иванов') {$response[] = $v;}
    }
    return $response;
}
print_r(noIvanov($ar));
?>
