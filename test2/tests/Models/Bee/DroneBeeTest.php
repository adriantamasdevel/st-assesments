<?php

namespace Shiptheory\Models\Tests;

use Shiptheory\Models\Bee;
use PHPUnit\Framework\TestCase;

/**
 * Drone Bee Test Class
 */
class DroneBeeTest extends TestCase
{
    /**
     * A drone bee should have 100 initial health.
     */
    public function testGetInitialHealth(): void
    {
        $health = 100;
        $bee = new Bee\Drone();
        $this->assertEquals($bee->getHealth(), $health);
    }

    /**
     * A drone should have 50 health floating point.
     */
    public function testGetHealthFloatingPoint(): void
    {
        $health_fp = 50;
        $bee = new Bee\Drone();
        $this->assertEquals($bee->getHealthFloatingPoint(), $health_fp);
    }

    /**
     * Test if damage value is applied correctly
     */
    public function testGetDamage(): void
    {
        // test with values inside the range (0-100)
        $initialHealthValue = 100;
        $damageValue = 20;
        $healthValueAfterDamage = $initialHealthValue - $damageValue;

        $bee = new Bee\Drone();
        $bee->damage($damageValue);
        $this->assertEquals($bee->getHealth(), $healthValueAfterDamage);
    }


   /**
     * Test if damage value is applied correctly
     */
    public function testGetDamageWithValuesOutsideTheRange(): void
    {

        //test with values outside the range
        $initialHealthValue = 100;
        $damageValue = -20;

        $bee = new Bee\Drone();
        $bee->damage($damageValue);

        // the damage should not be applied and the health value should stay the same
        $this->assertEquals($bee->getHealth(), $initialHealthValue);
    }


    /**
     * Test if damage value is applied correctly
     * The damage should not be applied after death
     */
    public function testGetDamageWillNotBeAppliedIfAlreadyDead(): void
    {
        $damageValue = 20;
        $healthValueAfterDamage = 40;

        $bee = new Bee\Drone();

        for ($i = 0; $i<8; $i++) {
            $bee->damage($damageValue);
        }

        $this->assertEquals($bee->getHealth(), $healthValueAfterDamage);
    }

    /**
     * A drone bee have the name "Drone".
     */
    public function testGetName(): void
    {
        $name = 'Drone';
        $bee = new Bee\Drone();
        $this->assertEquals($bee->getName(), $name);
    }



    /**
     * Test we can lose life with a big damage.
     */
    public function testDeath(): void
    {
        $bee = new Bee\Drone();

        if ($bee->isDead() !== true) {
            $bee->damage(90);
        }

        $this->assertTrue($bee->isDead());
    }

    /**
     * Test we're not dead yet.
     */
    public function testAlive(): void
    {
        $bee = new Bee\Drone();
        $bee->damage(20);

        $this->assertFalse($bee->isDead());
    }
}