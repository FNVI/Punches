<?php
namespace FNVi\Punches;
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
    protected $status;
    
    public function __construct($item, $user) {
        $this->item = $item;
        $this->raised = ["by"=>$user, "timestamp"=>$this->timestamp()];
        $this->status = "raised";
        parent::__construct("punches");
    }
    
    public function close($user){
        $this->closed = new Action($user);
        $this->status = "closed";
    }
    
    public function accept($user){
        $this->accepted = new Action($user);
        $this->status = "accepted";
    }
    
    public function reject($user){
        $this->rejected = new Action($user);
        $this->status = "rejected";
    }
}
