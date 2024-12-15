<?php

/*
 * This file is part of the PolishNaceCodes package.
 *
 * (c) Radosław Kowalewski <git@srsbiz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SrsBiz\PolishNaceCodes;

enum Version: string
{
    case Pkd2004 = Pkd2004::class;
    case Pkd2007 = Pkd2007::class;
    case Pkd2025 = Pkd2025::class;
}
