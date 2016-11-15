<?php
//Victor Carlos Cornejo
//IS218 Design Patterns
//Mini Program #2 Factory/Decorator/Strategy


// factory design that will create the "string" for the strategy and decorator to use.
 class carFactory {
     public static function createCar($brand)   {
      $obj= new car;
      $obj->brand=$brand;       
      return $obj;
     }
     }



// class for the car string coming in.
 class Car{
    public $brand;   
    // the array just has  a string inside of BMW are expensive
    public function __construct($brand)
    {
      $this->brand= $brand;     
    }
    public function getBrand()
    {
      return $this->brand;
    } 
 }


//Start of Strategy 
// here in the outportion below all the code i declare a strategy to be used.
// the starts here are to add slashes or explaimations to the string.
class stringstrat{
    // sets strategy to null so nothing is by default.
    private $strategy = null;
    public function __construct($stratType)
    {
    switch ($stratType) {
       // CASE  E for exlaimation points
       case "E":
         $this->strategy = new decorateExclaimation();
       break;
       // CASE S is for slashes
       case "S":
         $this->strategy = new decorateSlashes();
       break;
      }
    }
    public function showCarBrand($car)
    {
        return $this->strategy->showBrand($car);
    }
}
// end of startegy cases
// decorator portion starts
// all decorators require an interface from what ive read and researched that holds a function to be called again in its subclasses.
interface strategydecorator{
  public function showBrand($car);
}
// this sub decorator class  thats just adds ! after every word.
// since on of the homeworks was for string was str_replace, i thought that seems simple enough to use somewhere.
class decorateExclaimation implements strategydecorator{
    public function showBrand($car)
    {
        $brand = $car->getBrand();
        $this->stringCount++;
        // the first ' ', allows for the next value of ! to be placed. there is a space in ''
        return str_replace(' ', '!', $brand);
    }
}
// this sub decorator class  thats just adds / after every word.
class decorateSlashes implements strategydecorator{
    public function showBrand($car){      
        $brand = $car->getBrand();
        // the count is for the string text
        $this->stringCount++;        
        // the first ' ', allows for the next value of / to be placed. there is a space in ''
        return str_replace(' ','/', $brand);
    }
}

// Starting the instaniation and outputs
// this is sent to the factory to be made but at the same time can be used to send to the strategy and decarotor!!
$car= carFactory::createCar('BMWs are to expensive!'); 

$strategyContextExlaim = new StringStrat('E');
$strategyContextSlash = new StringStrat('S');
echo ' Hello and welcome to one of the design patterns assignment.';
echo '<br>';
echo ' This has strategy and decorator since the straegy here is to change a string.';
echo '<br>';
echo " The array has a string that says BMW are to expensive! , so the strategy is just taking the string and editting it in different ways using a decorator.";
echo '<br>';
// this calls the exlaimation strat and decorator.
echo $strategyContextExlaim->showCarBrand($car); 
echo '<br>';
// This seperates the words with a slash in the decorator.
echo $strategyContextSlash->showCarBrand($car); 
echo '<br>';
?>
