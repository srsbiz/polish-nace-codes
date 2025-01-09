<?php

/*
 * This file is part of the PolishNaceCodes package.
 *
 * (c) Radosław Kowalewski <git@srsbiz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SrsBiz\PolishNaceCodes;

final class Pkd
{
    public static function isValid(string $pkd, Version $version = Version::Pkd2025): bool
    {
        return isset($version->value::PKD[$pkd]);
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function getDescription(string $pkd, Version $version = Version::Pkd2025): string
    {
        if (!self::isValid($pkd, $version)) {
            throw new \InvalidArgumentException(
                \sprintf(
                    'Code "%s" does not exist in revision "%s"',
                    $pkd,
                    \basename($version->value)
                )
            );
        }
        return $version->value::PKD[$pkd];
    }

    /**
     * @return string|array String if given PKD was not changed or array of possible substitutes
     * @throws \RuntimeException
     */
    public static function migrate(string $pkd, Version $from = Version::Pkd2007, Version $to = Version::Pkd2025): string|array
    {
        if (
            !\defined("{$to->value}::MIGRATE")
            || !isset($to->value::MIGRATE[$from->value])
        ) {
            throw new \RuntimeException(
                \sprintf(
                    'Migration from "%s" to "%s" is not defined.',
                    \basename($from->value),
                    \basename($to->value),
                )
            );
        }
        return $to->value::MIGRATE[$from->value][$pkd] ?? $pkd;
    }
}
