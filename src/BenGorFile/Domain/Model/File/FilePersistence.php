<?php

/*
 * This file is part of the BenGorFile package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BenGorFile\Domain\Model\File;

function save(array $mechanisms, array $files) : callable
{
    return function (array $file) use ($mechanisms, $files) : array {
        return array_unique(
            array_map(function (callable $mechanism) use ($file, $files) : array {
                return call_user_func($mechanism, $file, $files);
            }, $mechanisms),
            SORT_REGULAR
        );
    };
}
