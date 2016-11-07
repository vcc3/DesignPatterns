<?php
//Victor Carlos Cornejo
//IS218 Designn Patterns
//Mini Program #4 Adapter/Decorator/Strategy

class IceCream{
    public $flavor;   
    public $other;
    
    public function __construct($flavor,$other){
      $this->flavor= $flavor;
      $this->other= $other;     
    }
  public function getFlavor(){
      return $this->flavor;
    } 
    public function getOther(){
      return $this->other;
    }
}
//Start of Adapter class
//Adapter class shows the get flavor and other for the string inputted.
  class icecreamAdapter{
   private $icecream;
     function __construct(IceCream $cream) {
        $this->icecream = $cream;
    }
     function getAll() {
         return $this->icecream->getFlavor().' to bad.We still have some :'.$this->icecream->getOther();
    }
  }
// End of Adapter Pattern


//Start of Strategy 

class IceStrategy{
    // sets strategy to null so nothing is by default.
    private $strategy = null;
    public function __construct($stratType)
    {
    switch ($stratType) {
       // CASE  VB for vanilla bean
       case "VB":
         $this->strategy = new decorateVanillaBean();
       break;
       // CASE CD is for cookie dough
       case "CD":
         $this->strategy = new decorateCookieDough();
       break;
      }
    }
    public function showFlavorType($icream)
    {
        return $this->strategy->showFlavor($icream);
    }
}
// End of startegy cases
// Decorator portion starts
interface strategydecorator{
  public function showFlavor($icream);
}
//replacing chocolate to another flavor
class decorateVanillaBean implements strategydecorator{
    public function showFlavor($icream){
        $flavor = $icream->getFlavor();
       
        // the first 'chocolate ', allows for the next value of vanillabean to be placed. 
        return str_replace('Chocolate','Vanilla Bean', $flavor);
    }
}
// replacing chocolate with cookie dough 
class decorateCookieDough implements strategydecorator{
    public function showFlavor($icream){       
        $flavor = $icream->getFlavor();    
        // the first 'chocolate ', allows for the next value of cookiedough to be placed. 
        return str_replace('Chocolate','Cookie Dough', $flavor);
    }
}

// Starting the instaniation and outputs
// this is sent to the factory to be made but at the same time can be used to send to the strategy and decorator!!
$icecream= new IceCream('Chocolate has melted...','Rocky Road'); 
$icAdapter= new icecreamAdapter($icecream);

$strategyContextVanillaBean = new IceStrategy('VB');
$strategyContextCookieDough = new IceStrategy('CD');
echo ' Hello and welcome to Jims Ice Cream Shop';
echo '<br>';
echo ' Whats that? Oh, choices are currently Chocolate,Vanilla Bean and Cookie Doughfor todays specials.';
echo '<br>';
echo 'Uh oh... looks like..';
echo '<br>';

// this calls melted chocolate into vanilla bean
echo $strategyContextVanillaBean->showFlavorType($icecream); 
echo '<br>';
// This calls melted chocolate to cookie dough
echo $strategyContextCookieDough->showFlavorType($icecream); 
echo '<br>';
echo ($icAdapter->getAll()); 



?>