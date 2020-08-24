<?php

namespace Shiptheory\Models;

/**
 * 
 */
class BaseBee
{

    /**
     * Minimum damage value
     * 
     * @var int 
     */
    const MIN_DAMAGE_VALUE = 0;
    
    /**
     * Maximum damage value
     * 
     * @var int  
     */
    const MAX_DAMAGE_VALUE = 100;

    /**
     * Bee Name
     * 
     * @var string 
     */
    public $name;

    /**
     * Property used to set a bee dead
     * 
     * @var string 
     */
    public $dead;
    
    /**
     * Property used to store the health level
     * 
     * @var int 
     */
    protected $health;
    
    /**
     * Health floating point
     * 
     * @var string
     */
    protected $health_point;     
    

    /**
     * Apply damage to any bee value between 0 and 100
     * 
     * @param int $value 
     * @return int
     */
    public function damage(int $value) 
    {
        // only apply damage for the bees alive
        if(!$this->isDead()) {

            // only apply damage if the value is between 0 and 100
            if($value >= self::MIN_DAMAGE_VALUE && $value <= self::MAX_DAMAGE_VALUE){
                
                // calculcate the new health value and 
                // if it has negative then value set to 0
                $new_health = $this->health - $value;
                $this->health = max($new_health, 0);
                
                if($this->health < $this->health_point) {
                    $this->setDead();
                }
            }
        }

        return $this->health;
    }
    
    /**
     * Check if dead
     *  
     * @return boolean
     */
    public function isDead()
    {
        return (bool) $this->dead;
    }

    /**
     * Set dead 
     *  
     */
    public function setDead()
    {
        $this->dead = true;
    }

    /**
     * Get the name
     *  
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get Health Value
     *  
     * @return int
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Get Health Floating Point
     *  
     * @return int
     */
    public function getHealthFloatingPoint()
    {
        return $this->health_point;
    }

    



}