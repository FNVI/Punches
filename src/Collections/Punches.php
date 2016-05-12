<?php

namespace FNVi\Punches;
use FNVi\Mongo\Collection;

/**
 * Description of Punches
 *
 * @author Joe Wheatley <joew@fnvi.co.uk>
 */
class Punches extends Collection{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getOpenPunches() {
        return $this->find(["open"=>true]);
    }
}
