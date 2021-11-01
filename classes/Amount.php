<?php 
class Amount{
    public $input_amount;
    public $pence_amount = 0;
    public $note_array = [200,100,50,20,10,5,2,1];
    public $note_count = [];
    public $output = "";

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
            $this->pence_amount = round((float)$matches[0][0] * 100);
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

    public function calculateMinNote(){
        $value = $this->pence_amount;
        for ($j=0; $j<count($this->note_array); $j++){
          array_push($this->note_count, floor($value/$this->note_array[$j]));
          $value %= $this->note_array[$j];
          if ($value == 0) break;
        }
  
    }

    public function toString(){
        if ($this->pence_amount == 0) return;
        for($x=0; $x<count($this->note_count); $x++){
          //set pound sign or p sign according to the note value
          if ($this->note_count[$x]==0) continue;
          if ($this->note_array[$x]%100 == 0){
            $this->output .= "£" . $this->note_array[$x]/100 . "X" . $this->note_count[$x] . ", ";
          }else{
            $this->output .= $this->note_array[$x] . "pX" . $this->note_count[$x] . ", ";
          }
          
        }
    }

    public function cal(){
        $this->getPence();
        $this->calculateMinNote();
        $this->toString();
        return $this->output;
    }
}    
?>