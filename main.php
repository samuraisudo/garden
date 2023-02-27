<?php
class Garden
{
  public $tree = [];
  public $count_fruit = [];
  function __construct($tree = [], $count_fruit = [])
  {
    $this->tree = $tree;
    $this->count_fruit = $count_fruit;
  }
  public function getTree(){
    return $this->tree;
  }
  public function getFruit(){
    return $this->count_fruit;
  }
  public function countFruit($tree_name, $count){
    if (!isset($this->count_fruit[$tree_name])) {
      $this->count_fruit[$tree_name] = 0;
    }
    $this->count_fruit[$tree_name] = $count;

  }
  public function newTree($tree_name, $count){
    if (!isset($this->tree[$tree_name])) {
      $this->tree[$tree_name] = 0;
      $this->count_fruit[$tree_name] = 0;
    }
    $this->tree[$tree_name] += $count;
  }
}


$garden = new Garden();
//1. Добавляем деревья в сад. Создаем 10 яблонь
$garden->newTree("Яблоня", 10);
//и 15 груши
$garden->newTree("Груша", 15);
// Задаем им параметры. Количество яболок на дереве и вес в гр
$garden->countFruit("Яблоня",  array(rand(40, 50), rand(150, 180)));
$garden->countFruit("Груша", array(rand(0, 20), rand(130, 170)));
echo "До сбора:\n";
print_r($garden->getTree());
print_r($garden->getFruit());

echo "\n------------------\nНачало сбора\n";
//Начинаем сбор фруктов.
foreach ($garden->getTree() as $tree_obj => $value) {
  //получаем общее количество фруктов одного вида
  $overcount = $garden->getFruit()[$tree_obj][0]*$garden->getTree()[$tree_obj];
  //получаем общий вес собранных фруктов одного вида в гр
  $all_weight = $garden->getFruit()[$tree_obj][1]*$overcount;
  //аннулируем количество фруктов с собранных деревьев
  $garden->countFruit($tree_obj, array(0, $garden->getFruit()[$tree_obj][1]));
  //выводим информацию о сборе
  echo "(".$tree_obj.") Количество плодов:".$overcount.". Общий вес:". $all_weight ."гр или ".($all_weight/1000)."кг\n";
}
echo "Конец сбора\n------------------\nПосле сбора:\n";
print_r($garden->getTree());
print_r($garden->getFruit());
?>
