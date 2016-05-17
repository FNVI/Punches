<?php

namespace FNVi\Punches\Collections;
use FNVi\Mongo\Collection;
use MongoDB\BSON\ObjectID;
use FNVi\Punches\Schemas\Punch;

/**
 * Description of Punches
 *
 * @author Joe Wheatley <joew@fnvi.co.uk>
 */
class Punches extends Collection{
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * @param string $id
     * @return Punch
     */
    public function getPunch($id){
        return $this->findOne(["_id"=>new ObjectID($id)]);
    }
    
    public function getOpenPunches() {
        return $this->find(["open"=>true]);
    }
}
