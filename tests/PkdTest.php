<?php

/*
 * This file is part of the PolishNaceCodes package.
 *
 * (c) Radosław Kowalewski <git@srsbiz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;
use SrsBiz\PolishNaceCodes\Pkd;
use SrsBiz\PolishNaceCodes\Version;

class PkdTest extends TestCase
{
    public function testItThrowsExceptionOnInvalidPkd()
    {
        $this->expectException(\InvalidArgumentException::class);
        Pkd::getDescription('XX.XX.X');
    }

    public function testItReturnsDescription()
    {
        $description = Pkd::getDescription('51.90.Z', Version::Pkd2004);
        $this->assertEquals('Pozostała sprzedaż hurtowa', $description);
    }

    public function testItChecksIfPkdIsValidInRevision()
    {
        $this->assertTrue(Pkd::isValid('51.90.Z', Version::Pkd2004));
        $this->assertFalse(Pkd::isValid('51.90.Z', Version::Pkd2007));
    }
}
