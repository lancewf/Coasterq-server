<?php



class FuzzySet
{
	// -------------------------------------------------------------------------
	//  Private Data
	// -------------------------------------------------------------------------
	   
	const MIN_VALUE = -9999999999999999999999;
	const MAX_VALUE = 9999999999999999999999;
	
    private $minimumZeroValueX;
    
    private $maximumZeroValueX;
    
    private $oneValueX;
   
	// -------------------------------------------------------------------------
	// Constructor$this->
	// -------------------------------------------------------------------------

   /**
    * Create a fuzzy set with minZeroValueX1 at min maximumZeroValueX1 at max
    * and oneValueX1 at one on the graph below
    * 
    * M 1|
    * e  |      _-|-_
    * M  |    _-  |  -_
    * B  |  _-    |    -_
    * E 0|________________
    * R  |min    one   max  : value
    * 
    */
   public function FuzzySet($minZeroValueX1 = 25200, $maximumZeroValueX1 = 75600,
         $oneValueX1 = 50400)
   {
      $this->minimumZeroValueX = $minZeroValueX1;
      $this->maximumZeroValueX = $maximumZeroValueX1;
      $this->oneValueX = $oneValueX1;
   }
   	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------

     /**
   * This method finds the membership value from the 
   * 
   * M 1|
   * e  |      _-|-_
   * M  |    _-  |  -_
   * B  |  _-    |    -_
   * E 0|________________
   * R  |min    one   max  : value
   * 
   * @param crispValue The X value
   * @return the membership value a double between 0 and 1. 
   */
   public function getMemberValue($crispValue)
   {
      if ($crispValue == $this->oneValueX)
      {
         $membershipValue = 1;
      }
      else if ($crispValue > $this->oneValueX && 
	  	$crispValue <= $this->maximumZeroValueX)
      {
         $membershipValue = $this->maximumMemberValue($crispValue);
      }
      else if ($crispValue < $this->oneValueX && 
	  	$crispValue >= $this->minimumZeroValueX)
      {
         $membershipValue = $this->minimumMemberValue($crispValue);
      }
      else
      { //crispValue > maximumZeroValueX || crispValue < minimumZeroValueX
         $membershipValue = 0;
      }
	  
	  return $this->applyIndeedHedgeFunction($membershipValue);
   }
   
	// -------------------------------------------------------------------------
	// #region Private Members
	// -------------------------------------------------------------------------
	
	/**
	 * Some what Hedge function. 
	 * 
	 * @return 
	 * @param object $membershipValue
	 */
	private function applySomeWhatHedgeFunction($membershipValue)
	{
		return pow($membershipValue, 0.5);
	}
	
	/**
	 * Indeed Hedge function. 
	 * 
	 * @return 
	 * @param object $membershipValue
	 */
	private function applyIndeedHedgeFunction($membershipValue)
	{
		if($membershipValue <= 0.5)
		{
			return 2 * pow($membershipValue, 2);
		}
		else
		{
			return 1 - 2 * pow((1 - $membershipValue), 2);
		}
	}
	   
   /**
    * This method finds the membership value on the Left side of the one Value
    * 
    * M 1|
    * e  |      _-|-_
    * M  |    _-  |  -_
    * B  |  _-    |    -_
    * E 0|________________
    * R  |min    one   max  : value
    * 
    * @param crispValue The X value
    * @return the membership value
    */
   private function minimumMemberValue($crispValue)
   {
      $slope;
      $y_intercept;

      if ($this->minimumZeroValueX == FuzzySet::MIN_VALUE)
      {
         return 1;
      }
            // rise   /                run
      $slope = (0 - 1) / ($this->minimumZeroValueX - $this->oneValueX);
      
      
      $y_intercept = (-1) * $slope * $this->minimumZeroValueX;

      return $slope * $crispValue + $y_intercept;
   }

   /**
    * This method finds the membership value on the right side of the one Value
    * 
    * M 1|
    * e  |      _-|-_
    * M  |    _-  |  -_
    * B  |  _-    |    -_
    * E 0|________________
    * R  |min    one   max  : value
    * @param crispValue The X value
    * @return the membership value
    */
   private function maximumMemberValue($crispValue)
   {
      $slope;
      $y_intercept;

      if ($this->maximumZeroValueX == FuzzySet::MAX_VALUE)
      {
         return 1;
      }

      $slope = 1 / ($this->oneValueX - $this->maximumZeroValueX);
      $y_intercept = (-1) * $slope * $this->maximumZeroValueX;

      return $slope * $crispValue + $y_intercept;
   }
}

?>