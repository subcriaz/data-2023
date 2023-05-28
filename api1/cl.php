<!DOCTYPE html>
<html>
<body>

<?php

include_once 'cl2.php';
// require  '../class/cl3.php';
include_once dirname(__FILE__) . '/class/cl3.php';
class Fruit {
  // Properties
  public $name;
  public $color;

  // Methods
  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }
}

$apple = new Fruit();
$banana = new Fruit();
$apple->set_name('Apple1');
$banana->set_name('Banana1');

echo $apple->get_name();
echo "<br> 123";
echo $banana->get_name();
?>
 
</body>
</html>
