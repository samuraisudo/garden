<?php
class Garden
{
  public $tree = [];
  function __construct($tree = [])
  {
    $this->tree = $tree;
  }
  public function getTree(){
    return $this->tree;
  }
  public function newTree($tree_name, $tree_id, $count, $weight){
    #создаем вид дерева если его нет
    if (!isset($this->tree[$tree_name])) {
      $this->tree[$tree_name] = [];
    }
    $inf = [];
    #создаем уникальное дерево
    for ($ii=0; $ii < $tree_id; $ii++) {
      #создаем уникальное яблоко которое имеет свои параметры
      for ($i=0; $i < mt_rand(intval($count[0]), intval($count[1])); $i++) {

        $inf[$i] = mt_rand(intval($weight[0]), intval($weight[1]));
      }
      $this->tree[$tree_name][$ii] = $inf;
    }
  }
}

$garden = new Garden();
//Создаем дерево, 10 и 15шт. Передаем 2 массива. в одном количество яблок, а в другом их вес в гр
$garden->newTree("Яблоня", 10,  array(40, 50), array(150, 180));
$garden->newTree("Груша", 15, array(0, 20), array(130, 170));
#получаем массив с видами деревьев и проходимся по ним
foreach ($garden->getTree() as $key => $value){
  #массив для яблок
  $fruitcount = array();
  #массив для веса яблок
  $fruitgrcount = array();
  #проходимся по деревьям, собирая яблоки и их вес
  foreach ($value as $key2 => $value2) {
    $fruitcount[] = count($value2);
    foreach ($value2 as $key3 => $value3) {
      $fruitgrcount[] = $value3;
    }
  }
  echo "(".$key.") Количество плодов: ".array_sum($fruitcount)." Общий вес: ".array_sum($fruitgrcount)."гр или ".(array_sum($fruitgrcount)/1000)."кг\n";
}
