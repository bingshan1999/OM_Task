<?php 
class Amount{
    public $input_amount;
    public $pence_amount = 0;

    public function __construct($input){
        $this->input_amount = $input;
    }
    
    public function getPence(){
      # check for invalid characters 
      # 1) any characters except 'p','.','£' and digits
      # 2) more than one '.' or '£'
      if ((!preg_match('/[^pP0-9\.\£]+/', $this->input_amount)) && (preg_match_all('/[\.]/',$this->input_amount) < 2) && (preg_match_all('/[\£]/u',$this->input_amount) < 2)){

        # condition for treating input as pound
        # 1) input starts with one '£' sign and followed by at least 1 digit
        # 2) input contains one decimal point with a whole number (e.g., 1.5, 10.)
        if (preg_match('/^\£{1}\d+|\d+\.{1}/u', $this->input_amount)){
          # get the digits and convert to pence
          if (preg_match_all('/\d+(?:\.\d+)?/', $this->input_amount, $matches)){
            $this->pence_amount = ceil((float)$matches[0][0] * 100);
          }
        }else{
          # condition for treating input as pence
          # 1) there are no '£' sign nor decimals, but there is at least one digit
          if (preg_match_all('/\d+/', $this->input_amount, $matches)){
            $this->pence_amount = (float)$matches[0][0];
          }
        }
      }
  
    }
}    
?>