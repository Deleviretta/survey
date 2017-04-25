<?php

class Register {

   protected $data = array()  ;

   function __construct () { 
   }
      
   function _read () {
      $this->data['imie'] = $_POST['imie'] ;
      $this->data['nazwisko'] = $_POST['nazwisko'] ;
      $this->data['uczelnia'] = $_POST['uczelnia'] ;
      $this->data['email']  = $_POST['email'] ;
      $this->data['haslo'] = $_POST['haslo1'];
	
   }          

}
?>
