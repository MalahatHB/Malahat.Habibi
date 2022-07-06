<?php

namespace App\Tests\Entity;

use App\Entity\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase {

    public function testSetSender() {
        $message = new Message();
        $this->assertEquals("Test", $message->setMessage("Test"));
    }

    public function testSetMessage() {
        $message = new Message();
        $this->assertEquals("User_1", $message->setSender("User_1"));
    }
}
