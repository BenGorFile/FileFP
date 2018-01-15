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

namespace BenGorFile\Infrastructure\Domain\Model\File;

use BenGorFile\Domain\Model\File\FileName;

const inMemoryHas = '\BenGorFile\Infrastructure\Domain\Model\File\inMemoryHas';

function inMemoryHas(FileName $name, array $files) : array
{
    return array_filter($files, function (array $file) use ($name) {
        return array_search($name, $file, true);
    });
}

const inMemoryWrite = '\BenGorFile\Infrastructure\Domain\Model\File\inMemoryWrite';

function inMemoryWrite(array $file, array $files) : array
{
    return isset($file['name'])
        ? inMemoryHas($file['name'], $files)
            ? $files
            : array_merge($files, $file)
        : $files;
}
