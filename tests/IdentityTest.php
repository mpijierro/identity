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


    public function test_sanitize()
    {
        $this->assertEquals('Q6887124C', $this->identity->sanitize('q6887124c'));
        $this->assertEquals('Q6887124C', $this->identity->sanitize('q6887124C    '));
        $this->assertEquals('Q6887124C', $this->identity->sanitize('000q6887124C    '));
    }

    public function test_valid_cif()
    {
        $this->assertTrue($this->identity->isValidCif('Q6887124C'));
        $this->assertTrue($this->identity->isValidCif('J51062271'));
        $this->assertTrue($this->identity->isValidCif('D9990690A'));
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
        $this->assertTrue($this->identity->isValidNif('48692083W'));
    }

    public function test_invalid_nif()
    {
        $this->assertFalse($this->identity->isValidNif('21361012'));
        $this->assertFalse($this->identity->isValidNif('1361012S'));
        $this->assertFalse($this->identity->isValidNif('12345678F'));
        $this->assertFalse($this->identity->isValidNif(''));
        $this->assertFalse($this->identity->isValidNif(null));
    }


    public function test_valid_nie()
    {
        $this->assertTrue($this->identity->isValidNie('X3212050P'));
        $this->assertTrue($this->identity->isValidNie('X2792997S'));
    }


    public function test_invalid_nie()
    {
        $this->assertFalse($this->identity->isValidNie('Z8930474'));
        $this->assertFalse($this->identity->isValidNie('8930474Q'));
        $this->assertFalse($this->identity->isValidNie('Z893999Q'));
        $this->assertFalse($this->identity->isValidNie(''));
        $this->assertFalse($this->identity->isValidNie(null));
    }

}