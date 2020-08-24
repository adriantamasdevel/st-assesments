<?php

namespace Shiptheory\Models\Tests;

use Shiptheory\Models\Bee;
use PHPUnit\Framework\TestCase;

/**
 * Worker Bee Test Class
 */
class WorkerBeeTest extends TestCase
{
    /**
     * A worker bee should have 100 initial health.
     */
    public function testGetInitialHealth(): void
    {
        $health = 100;
        $bee = new Bee\Worker();
        $this->assertEquals($bee->getHealth(), $health);
    }

    /**
     * A worker should have 70 health floating point.
     */
    public function testGetHealthFloatingPoint(): void
    {
        $health_fp = 70;
        $bee = new Bee\Worker();
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

        $bee = new Bee\Worker();
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

        $bee = new Bee\Worker();
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
        $damageValue = 30;
        $healthValueAfterDamage = 40;

        $bee = new Bee\Worker();

        for ($i = 0; $i<8; $i++) {
            $bee->damage($damageValue);
        }

        $this->assertEquals($bee->getHealth(), $healthValueAfterDamage);
    }

    /**
     * A worker bee have the name "Worker".
     */
    public function testGetName(): void
    {
        $name = 'Worker';
        $bee = new Bee\Worker();
        $this->assertEquals($bee->getName(), $name);
    }



    /**
     * Test we can lose life with a big damage.
     */
    public function testDeath(): void
    {
        $bee = new Bee\Worker();

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
        $bee = new Bee\Worker();
        $bee->damage(20);

        $this->assertFalse($bee->isDead());
    }
}