<?php
// wap to insert a value in an array in a position
$arr=array("1","2","3","4","5");
$in=(int)readline("Enter the index: ");
$num=(int)readline("Enter the value: ");
$arr[$in]=$num;

print_r($arr);

wap to insert $ at 3rd position
$a = count($arr);
echo $a;
for($i=count($arr);$i>2;$i--){
    $arr[$i]=$arr[$i-1];
}
$arr[2]="$";
print_r($arr);

// wap to sort the associative array
// 2. Write a PHP script to sort the following associative array :
// array("Sophia"=>"31","Jacob"=>"41","
// William"=>"39","Ramesh"=>"40") in
// a) ascending order sort by value
// b) ascending order sort by Key
// c) descending order sorting by Value
// d) descending order sorting by Key

// sort() - sort arrays in ascending order
// rsort() - sort arrays in descending order

$arr1=array("Sophia"=>"31","Jacob"=>"41","William"=>"39","Ramesh"=>"40");
asort($arr1);
echo "asort() - sort associative arrays in ascending order, according to the value";
foreach($arr1 as $keys => $values){
    echo "$keys => $values\n";
}

echo "ksort() - sort associative arrays in ascending order, according to the key";
ksort($arr1);

foreach($arr1 as $keys => $values){
    echo "$keys => $values\n";
}

arsort($arr1);
echo "arsort() - sort associative arrays in descending order, according to the value";

foreach($arr1 as $keys => $values){
    echo "$keys => $values\n";
}
krsort($arr1);
echo "krsort() - sort associative arrays in descending order, according to the key";

foreach($arr1 as $keys => $values){
    echo "$keys => $values\n";
}


3. Write a PHP script to calculate and display average temperature, five lowest and highest temperatures.
Recorded temperatures : 78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73
Expected Output :
Average Temperature is : 70.6 
List of seven lowest temperatures : 60, 62, 63, 63, 64, 
List of seven highest temperatures : 76, 78, 79, 81, 85,

$arr3=[78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73];

$sum=0;
for($i=0;$i<count($arr3);$i++){
    $sum=$sum+$arr3[$i];
}
sort($arr3);
$avg=$sum/count($arr3);
echo "average temp: $avg";
echo "\nlowest temperature: ";
for($i=0;$i<7;$i++){
    echo $arr3[$i];
}

echo "\nhighest temperature: ";
for($i=count($arr3)-1;$i>count($arr3)-8;$i--){
    echo $arr3[$i];
}

print_r($arr3);

1 3 4 0
60 20 15 12
60



?>