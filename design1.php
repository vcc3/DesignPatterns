<?php
//Victor Carlos Cornejo
//IS218 Design Patterns
//Mini Program #1   decorator/strategy/bridge
// Program is for making a person for a couple,  then taking name and editting toegter as if they were getting married.

  

  
// Bridge Portion containing a strategy inside

abstract class BridgeNames{
    private $grooms;
    private $brides;
    private $combined;
    function __construct($mans, $womans, $order){
      $this->grooms =$mans;
      $this->brides =$womans;
     //starting quick strategy for the order either choice 1,2,or 3. Using if and else if
      if( '1' ==$order){
        $this->combined= new Married();
        }
       else{
        $this->combined= new Engaged();
        }
      }
      function showGroom(){
        return $this->combined->showGroom($this->grooms);
      }
     function showBride(){
        return $this->combined->showBride($this->brides);
      }
    }
    //end strategy portion and main bridge part.
    //Starting extended bridge
    class bridgingGroom extends BridgeNames{
      //Out put male names first then females.
      function showMaleFirst(){
        return 'Introducing Mr. '. $this->showGroom().' and Mrs. '.$this->showBride();
      }
     }   
     //The vice versa of the previous class.
    class bridgingBride extends BridgeNames{
      
      function showFemaleFirst(){
        return 'Introducing Mrs. '. $this->showBride().' and Mr. '.$this->showGroom();
      }
     }
     //end of Bridges
     //Starting the Decorators
     abstract class RelationshipStatus{
       abstract function showGroom($man);
       abstract function showBride($womans);
     } 
    class Married extends RelationshipStatus{
      function showGroom($man){
          return str_replace('Luke Hook','Ginger Puff ',$man);
        }
        function showBride($woman){
          return str_replace('Sam Smith','Shmam Shmitty ',$woman);
        }
    }
 
    class Engaged extends RelationshipStatus{
      function showGroom($man){
        return str_replace('Luke Hook','Luke Edward Hook',$man);
        // return str_replace('Chocolate','Vanilla Bean', $flavor);
        }
        function showBride($woman){
          return str_replace('Sam Smith','Samantha Dunae Smith',$woman);
        }
    }
    //End of Decorators
    
    
// Outputs
//Engaged outputs
echo ' Before marriage, things get are serious and the Bride wants to use the proper full names.';
echo '<br>';
echo '<br>';
$couple= new bridgingGroom('Luke Hook','Sam Smith','2');
echo '<br>';
echo ($couple->showMaleFirst());
echo '<br>';
$couple= new bridgingBride('Luke Hook','Sam Smith','2');
echo ($couple->showFemaleFirst());
echo '<br>';
echo '<br>';
echo'<hr>';
// Married outputs
echo ' After marriage, things get less serious now that the wedding has passed.';
echo'<br>';
echo'<br>';
$couple= new bridgingGroom('Luke Hook','Sam Smith','1');
echo ($couple->showMaleFirst());
echo '<br>';
$couple= new bridgingBride('Luke Hook','Sam Smith','1');
echo ($couple->showFemaleFirst());
echo '<br>';
echo '<br>';



?>
    
    
    
    
    
    
    
    
    
    
    
 



