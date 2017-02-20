<?php

/**
 * Created by PhpStorm.
 * User: mpijierro
 * Date: 20/02/17
 * Time: 23:45
 */

namespace MPijierro\Identity\tests;

use MPijierro\Identity\Identity;

class IdentityTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var Identity
     */
    private $identity;


    public function setUp()
    {
        $this->identity = new Identity();
    }


    public function test_valid_cif()
    {
        $this->assertTrue($this->identity->isValidCif('Q6887124C'));
        $this->assertTrue($this->identity->isValidCif('J51062271'));
    }


    public function test_invalid_cif()
    {
        $this->assertFalse($this->identity->isValidCif('Q6887124'));
        $this->assertFalse($this->identity->isValidCif('Q6887123C'));
        $this->assertFalse($this->identity->isValidCif('6887123C'));
        $this->assertFalse($this->identity->isValidCif(''));
        $this->assertFalse($this->identity->isValidCif('AAAAAAAAAAAAAAA'));
        $this->assertFalse($this->identity->isValidCif(null));

    }


    public function test_valid_nif()
    {
        $this->assertTrue($this->identity->isValidNif('21361012S'));
        $this->assertTrue($this->identity->isValidNif('64160547T'));
    }


    public function test_invalid_nif()
    {
        $this->assertFalse($this->identity->isValidNif('21361012'));
        $this->assertFalse($this->identity->isValidNif('1361012S'));
        $this->assertFalse($this->identity->isValidNif('12345678F'));
        $this->assertFalse($this->identity->isValidNif(''));
        $this->assertFalse($this->identity->isValidNif(null));
    }

}