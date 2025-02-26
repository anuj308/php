<?php



// question 3
$arr=array();
$n=(int)readline("enter no of inputs");
for($i=0;$i<$n;$i++){
    $a=(int)readline();
    array_push($arr,$a);
}
// $arr=[1,2,3,1,1,4,5,1,4,5];b
$w=0;
$ans=0;
$c=0;

for($i=0;$i<count($arr);$i++){
    for($j=0;$j<count($arr);$j++){
        if($arr[$i]==$arr[$j]){
            $c=$c+1;
        }
    }
    if($ans<$c){
        $ans=$c;
        $w=$arr[$i];
    }
    $c=0;
}

echo $w. " is repeating most, i.e ". $ans. " times";

?>

