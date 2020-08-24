<?php

namespace Shiptheory\Models\Tests;

use Shiptheory\Models\Bee;
use PHPUnit\Framework\TestCase;

/**
 * Queen Bee Test Class
 */
class QueenBeeTest extends TestCase
{
    /**
     * A queen bee should have 100 initial health.
     */
    public function testGetInitialHealth(): void
    {
        $health = 100;
        $bee = new Bee\Queen();
        $this->assertEquals($bee->getHealth(), $health);
    }

    /**
     * A queen should have 20 health floating point.
     */
    public function testGetHealthFloatingPoint(): void
    {
        $health_fp = 20;
        $bee = new Bee\Queen();
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

        $bee = new Bee\Queen();
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

        $bee = new Bee\Queen();
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
        $healthValueAfterDamage = 10;

        $bee = new Bee\Queen();

        for ($i = 0; $i<8; $i++) {
            $bee->damage($damageValue);
        }

        $this->assertEquals($bee->getHealth(), $healthValueAfterDamage);
    }

    /**
     * A queen bee have the name "Queen".
     */
    public function testGetName(): void
    {
        $name = 'Queen';
        $bee = new Bee\Queen();
        $this->assertEquals($bee->getName(), $name);
    }



    /**
     * Test we can lose life with a big damage.
     */
    public function testDeath(): void
    {
        $bee = new Bee\Queen();

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
        $bee = new Bee\Queen();
        $bee->damage(20);

        $this->assertFalse($bee->isDead());
    }
}