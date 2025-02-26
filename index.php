<!-- <?php
// wap to add two number
$a = 10;
$b = 20;
$ans = $a + $b;
echo "$ans\n";

$s = "anuj";
echo $s;

if else 
if($a<20){
    echo "its true\n";
}else{
    echo "its false\n";
}

if else if 
$days =["mon","tue","wed","thu","fri","sat","sun"];
$num = 2;

// input from the user

$num=(int)readline("Enter the number(0 to 6): ");
if($days[$num]=="mon"){
    echo "it is mon\n";
}
else if($days[$num]=="tue"){
    echo "it is tue\n";
}
else if($days[$num]=="wed"){
    echo "it is wed\n";
}
else if($days[$num]=="thu"){
    echo "it is thu\n";
}
else if($days[$num]=="fri"){
    echo "it is fri\n";
}
else if($days[$num]=="sat"){
    echo "it is sat\n";
}
else if($days[$num]=="sun"){
    echo "it is sun\n";
}else{
    echo "enter a valid number\n";
}

constants
define("name","anuj");
echo name;

wap to take a string input and print it

$st=(string)readline("Write a string: ");
echo $st;

wap to print 1 to 10 with loops

for($i=1;$i<=10;$i++){
    echo $i."\n";
}

$d =[];
for($i=0;$i<=6;$i++){
    $d[$i]=(string)readline("enter day: ");
}
for($i=0;$i<=6;$i++){
    echo "$d[$i] \n";
}

to find the count or length of an arr
echo count($d);

wap to convert int datatype to string

$a=5;
$b="anuj";
$c=20.12;
echo (string)$a, " " , $b ,"\n";

echo gettype($a),"\n"; // data type
echo gettype($c),"\n"; // data type
echo var_dump($a,$b,$c) , "\n"; // data type & value

$arr = [ [1,2,3],[4,5,6],[7,8,9]];
$arr1 = array(array(1,2,3),array(4,5,6),array(7,8,9));

for($i=0;$i<count($arr);$i++){
    for($j=0;$j<count($arr[$i]);$j++){
        echo $arr[$i][$j], " ";
    }
    echo "\n";
}

 wap to add all number of an array

$arr1 = [ [1,2,3],[4,5,6],[7,8,9]];
$ans=0;
for($i=0;$i<count($arr);$i++){
    for($j=0;$j<count($arr[$i]);$j++){
        $ans+= $arr[$i][$j];

}}
echo $ans. "\n";b
associative array
key - value

$arr1=["key"=>"value","name"=>"anuj"];
echo $arr1["key"]. "\n";
echo $arr1["name"]. "\n";

foreach loop
$days=['mon','tue','wed','thu','fri','sat','sun'];
foreach($days as $i){
    echo $i. "\n";
}

print associative array using foreach
$arr1=["key"=>"value","name"=>"anuj"];
foreach($arr1 as $key=>$value){
    echo $key. " ". $value. "\n";
}

wap to add values
$arr2=["key"=>"2","name"=>"6"];
$sum=0;
// $st="";
foreach($arr2 as $key=>$value){
    // $st=$st . " ". $value;
    $sum+=$value;
}
echo $sum;
echo $st;

wap to modify the values of an associative array
$arr3=array("i1"=>10,"i2"=>20,"i3"=>30);
foreach($arr3 as $keys=>$values){
    $arr3[$keys]=$values*3;
}
foreach($arr3 as $i){
    echo $i. "\n";
}

$arr4=[[1,2,3],[4,5,6],[7,8,9]];
$res=0;
foreach($arr4 as $value){
    foreach($value as $i){
        $res = $res + $i;
    }
}
echo $res;

while loop
$i=0;
while($i<3){
    $i++;
}
print $i;

$i=0;
while($i++){ // condition false but i++ changes i =1
    print $i;
}
print $i; /// output 1

// $i=1;
// for(;;){ // infinite loop no condition
//     echo $i++;
//     echo "</br>";
// }


?> -->