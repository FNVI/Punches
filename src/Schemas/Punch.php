<?php
namespace FNVi\Punches\Schemas;
use FNVi\Punches\PunchStatus;
use FNVi\Mongo\Schema;
use FNVi\Mongo\Action;
/**
 * Description of Punch
 *
 * @author Joe Wheatley <joew@fnvi.co.uk>
 */
class Punch extends Schema{
    
    public $item;
    public $inspection;
    public $raised;
    public $closed;
    public $accepted;
    public $rejected;
    public $issue;
    public $status;
    
    public $collectionName = "punches";


    public function __construct($item, $user, $issue) {
        $this->item = $item;
        $this->raised = new Action($user);
        $this->issue = $issue;
        $this->status = [
                            "name"=>"raised",
                            "order"=>0
                        ];
        parent::__construct("punches");
    }
    
    public function close($user){
        $this->closed = new Action($user);
        $this->status = [
                            "name"=>"closed",
                            "order"=>3
                        ];
    }
    
    public function accept($user){
        $this->accepted = new Action($user);
        $this->status = [
                            "name"=>"accepted",
                            "order"=>1
                        ];
    }
    
    public function reject($user){
        $this->rejected = new Action($user);
        $this->status = [
                            "name"=>"rejected"
                        ];
    }
}
