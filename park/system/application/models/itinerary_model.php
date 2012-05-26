<?php
class Itinerary_model extends Model
{
   public function Itinerary_model()
   {
      parent::Model();

      require_once('persistence/Itinerary.php');
      require_once('persistence/ItineraryRide.php');
	  require_once('persistence/GenericUser.php');
   }

   public function getItineraryRides($user)
   {
      $itinerary = $this->_getItinerary($user);

      return $itinerary->getItineraryRides();
   }

   public function getItineraryRidesSortedByPriority($user)
   {
      $itinerary = $this->_getItinerary($user);
      $criteria = new Criteria();
      $criteria->addAscendingOrderByColumn(ItineraryRidePeer::PRIORITY);
      return $itinerary->getItineraryRides($criteria);
   }

   public function addItineraryRide($user, $rideToAdd, $priority)
   {
      $itinerary = $this->_getItinerary($user);

      if(!$this->_isRideInItinerary($itinerary, $rideToAdd))
      {
         $newItineraryRide = new ItineraryRide();
         $newItineraryRide->setRide($rideToAdd);

         $itinerary->addItineraryRide($newItineraryRide);

         $newItineraryRide->setPriority($priority);
         $newItineraryRide->save();
         $itinerary->save();
      }
   }
   
   public function clearAll()
   {
		ItineraryPeer::doDeleteAll();
		ItineraryRidePeer::doDeleteAll();
   }
   
   public function addNewItineraryRide($user, $rideToAdd)
   {
      $itinerary = $this->_getItinerary($user);

      if(!$this->_isRideInItinerary($itinerary, $rideToAdd))
      {
         $priority = $itinerary->countItineraryRides();
         $priority++;

         $newItineraryRide = new ItineraryRide();
         $newItineraryRide->setRide($rideToAdd);

         $itinerary->addItineraryRide($newItineraryRide);

         $newItineraryRide->setPriority($priority);
         $newItineraryRide->save();
         $itinerary->save();
      }
   }
   
   // --------------------------------------------------------
   // Private Members
   // --------------------------------------------------------

   private function _isRideInItinerary($itinerary, $rideToAdd)
   {
      foreach($itinerary->getItineraryRides() as $itineraryRide)
      {
         if($itineraryRide->getRideId() == $rideToAdd->getId())
         {
            return true;
         }
      }

      return false;
   }

   private function _getItinerary($user)
   {
      $itinerary = $user->getItinerarys();

      return $itinerary[0];
   }
}
?>