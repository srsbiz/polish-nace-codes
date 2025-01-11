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

    public function testItDoesNotSupportMigrationToVersion()
    {
        $this->expectException(\InvalidArgumentException::class);
        Pkd::migrate('51.90.Z', Version::Pkd2007, Version::Pkd2004);
    }

    public function testItDoesNotSupportMigrationFromVersion()
    {
        $this->expectException(\InvalidArgumentException::class);
        Pkd::migrate('51.90.Z', Version::Pkd2004, Version::Pkd2025);
    }

    public function testItDoesNotSupportUnknownPkd()
    {
        $this->expectException(\InvalidArgumentException::class);
        $null = Pkd::migrate('00.00.X', Version::Pkd2007, Version::Pkd2025);
    }

    public function testItDoesReturnPossibleMigrationOptions()
    {
        $hasNotChanged = Pkd::migrate($pkdNotChanged = '01.11.Z', Version::Pkd2007, Version::Pkd2025);
        $this->assertEquals($pkdNotChanged, $hasNotChanged);

        $hasSubstitutes = Pkd::migrate('62.01.Z', Version::Pkd2007, Version::Pkd2025);
        $this->assertIsArray($hasSubstitutes);
        $this->assertCount(2, $hasSubstitutes);

        $migrateToPrevious = Pkd::migrate('62.20.A', Version::Pkd2025, Version::Pkd2007);
        $this->assertIsArray($migrateToPrevious);
        $this->assertCount(1, $migrateToPrevious);
    }
}
