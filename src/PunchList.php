<?php

namespace FNVi\Punches;
use FNVi\Punches\Collections\Punches;
use FNVi\Punches\Schemas\Punch;
use FNVi\Mongo\Tools\Aggregate;
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
        return $this->collection->getPunches($query += ["status.name"=>['$ne'=>"closed"]]);
    }
    
    public function getClosedPunches(array $query = []){
        return $this->collection->getPunches($query += ["status.name"=>"closed"]);
    }
    
    public function getRejectedPunches(array $query = []){
        return $this->collection->getPunches($query += ["status.name"=>"rejected"]);
    }    
    
    public function getAcceptedPunches(array $query = []){
        return $this->collection->getPunches($query += ["status.name" => "accepted"]);
    }
    
    public function getPunchesWithStatus($status){
        if($status === "open"){
            $status = ['$ne'=>"closed"];
        }
        return $this->getPunches(["status.name" => $status]);
    }
    
    public function getPunches(array $query = []){
        return $this->collection->find($this->query += $query);
    }
    
    public function groupPunchesByStatus(array $statuses = []){
        $aggregate = new Aggregate($this->collection);
        if(count($statuses)){
            $aggregate->match(["status.name"=>['$in'=>$statuses]]);
        }
        return $this->collection->aggregate($aggregate->groupBy('$status')->sort(["_id.order"=>1])->getPipeline());
    }
}
