<?php

declare(strict_types=1);

namespace App\Controller\Test;

use PHPUnit\Framework\TestCase;
use App\Controller\Yatzy\GameDice;

class YatzyDiceTest extends TestCase
{
    /**
     * Yatzy GameDice class uses DiceTrait
     */
    private object $dice;

    protected function setUp(): void
    {
        $this->dice = new GameDice();
    }

    /**
     * Test to roll dices
     */
    public function testRollGameDice()
    {
        $res = $this->dice->roll();
        $this->assertIsNumeric($res);
    }

    /**
     * Test that result equals whats rolled
     */
    public function testGetLastRollGameDice()
    {
        $rolled = $this->dice->roll();
        $res = $this->dice->getLastRoll();
        $this->assertEquals($res, $rolled);
    }
}
