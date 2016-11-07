<?php
//victor Carlos Cornejo
//IS218 Design Patterns
//Mini Program #5 Singleton


//Singleton Start
    class Blockbuster{
    
      private $genre ='Horror';
      private $title ='The Cabin in the Woods';
      private static $movie =null;
      private static $isRentedOut= FALSE;
      
      private function __construct(){
      }
      
      static function rentedMovie(){
        if(False == self::$isRentedOut){
          if(null ==self::$movie){
            self::$movie = new Blockbuster();
           }
           self::$isRentedOut= True;
           return self::$movie;
           }
           else{
           return null;
           }
        } 
      
        function returnedMovie(Blockbuster $returnedmovie){
        // telling the systme that a returned movie is not rented out right now
        self::$isRentedOut =FALSE;
        }
        function getGenre(){
          return $this->genre;
        }
        function getTitle(){
          return $this->title;
        }
         function getAll(){
          return $this->getTitle().' a movie of the '.$this->getGenre().' genre.';
        }
      }  

      class Customer{
        private $movierented;
        private $hasmovie =FALSE;
        
        function __construct(){
        }
        
        function getGenreTitle(){
          if(TRUE ==$this->hasmovie){
            return $this->movierented->getAll();
            }
            else{
            return "Error: movie has been Rented Out.";
            }
          }    
        function RentMovie(){
          //calls back to the blcokbuster class and sees th einfo insid efor checked out and whatnot
          $this->movierented = Blockbuster::rentedMovie();
          if ($this->movierented == NULL) {
              $this->hasmovie = FALSE;
          } 
          else {
            $this->hasmovie = TRUE;
          }
        }


    function returnMovie() {
      $this->movierented->returnMovie($this->movierented);
    }
   }
// end of Singleton 
//client class
class Client{
    public $client;   
   
    
    public function __construct($client)
    {
      $this->client= $client;
       
    }
    public function getClient()
    {
      return $this->client;
    } 
    
    public function getAll() {
         return  $this->client->getClient();
    }
}
class clientStrategy{
    // sets strategy to null so nothing is by default.
    private $strategy = null;
    public function __construct($stratType)
    {
    switch ($stratType) {
       // CASE for mkaing client jim
       case "J":
         $this->strategy = new decorateJim();
       break;
       // CASE for making client tim
       case "T":
         $this->strategy = new decorateTim();
       break;
      }
    }
    public function showClientType($customer)
    {
        return $this->strategy->showClient($customer);
    }
}
// End of startegy cases
// Decorator portion starts
interface strategydecorator
{
  public function showClient($customer);
}
//replacing chocolate to another flavor
class decorateTim implements strategydecorator
{
    public function showClient($customer)
    {
        $client = $customer->getClient();
    
        return str_replace('customer1','Tim Serano', $client);
    }
}
// replacing chocolate with cookie dough 
class decorateJim implements strategydecorator
{
    public function showClient($customer)
    {       
        $client = $customer->getClient();    
     
        return str_replace('customer1','Jimmy Delgrosso', $client);
    }
}
//First we are going to create two customers.
//We have Tim and Jim looking to get the same movie.
$cust1 = new Client('customer1');
$strategyContextTim = new clientStrategy('T');
$strategyContextJim = new clientStrategy('J');
echo 'One of the two cusomter that just came is '.$strategyContextTim->showClientType($cust1); 
echo '<br>';
echo 'The other customer I saw come in was also '.$strategyContextJim->showClientType($cust1);
echo '<hr>';
//Output Section for the rest of singleton.
//Patrons who are trying to get the  movie.
$movieRenter1= new Customer();
$movieRenter2= new Customer();
//Start of renting.
$movieRenter1->RentMovie();
echo ('Jimmy Delgrosso would like to rent a movie.');
echo '<br>';
echo ('Jimmy has choosen:');
echo '<br>';
echo ($movieRenter1->getGenreTitle());
echo '<br>';
echo 'Jim: Thanks Ive been dying to see this movie.';
echo '<br>';
//patron 2 now wants the movie after patron 1 has taken it.
$movieRenter2->RentMovie();
echo('Patron Tim Serano would like to checkout Cabin in the Woods.');
echo '<br>';
echo('Blockbuster POS: Movie was taken out by Jimmy.Sorry.');
echo '<br>';
echo ($movieRenter2->getGenreTitle());





?>
