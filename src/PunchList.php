<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FNVi\Punches;
use MongoDB\BSON\ObjectID;
/**
 * Description of PunchList
 *
 * @author Joe Wheatley <joew@fnvi.co.uk>
 */
class PunchList {
    
    /**
     *
     * @var Punches
     */
    private $collection;
    private $query = [];
    
    public function __construct($query = []) {
        $this->query = $query;
        $this->collection = new Punches();
    }
    
    public function raisePunch(){
        
    }
    
    public function acceptPunch(ObjectID $id){
        
    }
    
    public function closePunch(ObjectID $id){
        
    }
    
    public function acceptPunches(array $query){
        
    }
    
    public function closePunches(array $query){
        
    }
    
    public function getOpenPunches(array $query = []){
        return $this->collection->getPunches($query += ["status"=>['$ne'=>PunchStatus::closed]]);
    }
    
    public function getClosedPunches(array $query = []){
        return $this->collection->getPunches($query += ["status"=>PunchStatus::closed]);
    }
    
    public function getAcceptedPunches(array $query = []){
        return $this->collection->getPunches($query += ["status" => PunchStatus::accepted]);
    }
    
    public function getPunches(array $query = []){
        return $this->collection->find($this->query += $query);
    }
}
