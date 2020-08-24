<?php 
namespace Shiptheory\Models\Bee;

/**
 * Queen Bee class
 */
class Queen extends \Shiptheory\Models\BaseBee
{
    /**
     * Bee Name
     * 
     * @var string 
     */
    public $name = 'Queen';

    /**
     * Property used to set a bee dead
     * 
     * @var string 
     */
    public $dead = false;

    /**
     * Property used to store the health level
     * 
     * @var int 
     */
    protected $health = 100;  

     /**
     * Health floating point
     * 
     * @var string
     */
    protected $health_point = 20; 
}