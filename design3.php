<?php
//victor Carlos Cornejo
//IS218 Desinn Patterns
//Mini Program #3 Builder/Observer/Adapter
  
//Starting Observer
 
  abstract class Observer  {
    abstract function update(Subject $playeronline);  
  }
  abstract class Subject{
    abstract function add(Observer $observed);
    abstract function remove(Observer $observed);
    abstract function notify();
   }
  
// added comments 
 class PlayerObserve extends Observer{
   public function __construct(){
   }
   public function update(Subject $player){
     echo ('New player entering:');
      echo'<br>';
     echo(' Player found:showing serialized information. '.$player->getPlayer());
      echo'<br>';
     echo('Player now in world.');
     }
  }
  class PlayerSubject extends Subject {
    private $favPlayer = null;
    private $observing =array();  
    
    function __construct(){
    }
    function add(Observer $observed){
      $this->observing[] = $observed;
    }
     function remove(Observer $observed){
       foreach($this->observing as $exists => $person){
         if($person == $observed){
           unset($this->observing[$exists]); 
         }
       }
     }
     function notify(){
       foreach($this->observing as $via){
         $via->update($this);
       }  
     }
     function updatePlayer($newplayer){
       $this->newperson =$newplayer;
       $this->notify();
     }
     function getPlayer(){
       return $this->newperson;
     }
    }    

 //Ending Observer 
  //Builder Portion
    class  Player{
    public $name;
    public $job;
    public $gender;
    }
    
   interface buildPlayer{
    public function setName();
    public function setJob();
    public function setGender();
    public function getPlayer();

   }
    //builder for elf
    class ElfMalePlayer implements buildPlayer{
    
      private $player;
   
        public function __construct(){
        $this->player= new Player();
       
        }
        //set name
        public function setName(){
       $this->player->name ="Legolas";
      
      }  
      //set elf as male
      public function setGender(){
       $this->player->gender ="Male";
      
      }    
      //set him as archer
      public function setJob(){
      $this->player->job ="Archer";
      }
     public function getPlayer(){
      return $this->player;
      }
    }

    //end elf player build
    //start builder for elf
    class ElfFemalePlayer implements buildPlayer{
    
      private $player;
        public function __construct(){
        $this->player= new Player();
        
        }
        public function setName(){
       $this->player->name ="Elvina";
      
      }  
      //set elf as female
      public function setGender(){
        $this->player->gender ="Female";
        
      }    
      //set her as archer
      public function setJob(){
      $this->player->job ="Healer";
      }
      public function getPlayer(){
      return $this->player;
      }
    }
    //end elf player build
    //Start director class
    class PlayerDirector{
      public  function build(buildPlayer $build){
        $build->setName();
        $build->setJob();
        $build->setGender();
       
        
        return $build->getPlayer();
      }
     } 
     //end director class
      //skyrim class for settings on where the world loaded players
    class Skyrim{
     public $location;
     public $weather;
     public $time;

    public function __construct($location,$weather,$time)
    {
     $this->location=$location;
     $this->weather =$weather;
     $this->time    =$time;
    }
  public function getLocation()
    {
      return $this->location;
    } 
    public function getWeather()
    {
      return $this->weather;
    }
    public function getTime()
    {
      return $this->time;
    }
}
//Start of Adapter class
//Adapter class shows the get flavor and other for the string inputted.
  class skyrimAdapter{
   private $elderscroll;
     function __construct(Skyrim $world) {
        $this->elderscroll = $world;
    }
     function getAll() {
         return 'Spawned in '.$this->elderscroll->getLocation().'. The weather seems to be '.$this->elderscroll->getWeather().' ,and it is now '.$this->elderscroll->getTime();
    }

  }
// End of Adapter Pattern
     
     //Instantiating some things
     //for builder section        
     $directs = new PlayerDirector();    
     $elfmale = new ElfMalePlayer();
     $elffemale= new ElfFemalePlayer();     
     // for observer section
     $subject= new PlayerSubject();
     $observe = new PlayerObserve();     
     //adapter section
     $skyrim = new Skyrim('WhiteRun','Snowing','21:00');
     $SkyAdapt= new skyrimAdapter($skyrim);
     
     
     
     
    
    // OUTPUTS
        //
    echo ' Now created a: ';// male
    $Elfman = $directs->build($elfmale);
    $maleinfo =serialize($Elfman);// turn object into serialization
   print_r($Elfman);
    echo'<br>';
 
    echo '<br>';
    echo ' Now created a: ';// female
    $Elfwoman = $directs->build($elffemale);
    $femaleinfo =serialize($Elfwoman);    
    print_r($Elfwoman);
    echo'<br>';
    echo ' Welcome to the New World server.';
    echo '<br>';
    echo 'Finding players.........';
    echo '<br>';
    echo '<br>';
    
   // observer part
   $subject->add($observe);
   $subject->updatePlayer($maleinfo);// take serialized info to output 
   echo ($SkyAdapt->getAll());
   echo '<br>';
   $subject->updatePlayer($femaleinfo);// take serialized info to output
   echo ($SkyAdapt->getAll());
   $subject->remove($observe);
    
 

?>
