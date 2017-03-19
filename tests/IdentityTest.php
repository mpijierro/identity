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
        $this->assertEquals('000Q6887124C', $this->identity->sanitize('000q6887124C    '));
    }

    public function test_valid_cif()
    {
        $this->assertTrue($this->identity->isValidCif('Q6887124C'));
        $this->assertTrue($this->identity->isValidCif('J51062271'));
        $this->assertTrue($this->identity->isValidCif('D9990690A'));
        $this->assertTrue($this->identity->isValidCif('N8796829C'));
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
        $this->assertTrue($this->identity->isValidNif('08861617Q'));
    }

    public function test_invalid_nif()
    {
        $this->assertFalse($this->identity->isValidNif('21361012'));
        $this->assertFalse($this->identity->isValidNif('1361012S'));
        $this->assertFalse($this->identity->isValidNif('12345678F'));
        $this->assertFalse($this->identity->isValidNif('008861617Q'));
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


    public function test_valid_iban()
    {
        $this->assertTrue($this->identity->isValidIban('ES9100490013112991609374'));
        $this->assertTrue($this->identity->isValidIban('ES09 2038-0626-0160-0002-5280'));
        $this->assertTrue($this->identity->isValidIban('ES 58 0075 0204 9406 0081 1004'));
        $this->assertTrue($this->identity->isValidIban('ES98 – 3190 – 0974 – 34 - 4255071823'));
        $this->assertTrue($this->identity->isValidIban('ES31-2080-5155-9730-4000-0250'));
        $this->assertTrue($this->identity->isValidIban('ES94 2095 5381 1910 6117 3539'));
    }


    public function test_invalid_iban()
    {

        $this->assertFalse($this->identity->isValidIban('ES9100490013112991609374a'));
        $this->assertFalse($this->identity->isValidIban('9100490013112991609374a'));
        $this->assertFalse($this->identity->isValidIban('9100490013112991609374a'));
        $this->assertFalse($this->identity->isValidIban(''));
        $this->assertFalse($this->identity->isValidIban(null));

    }

}