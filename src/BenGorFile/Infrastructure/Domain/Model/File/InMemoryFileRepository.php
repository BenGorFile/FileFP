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

use BenGorFile\Domain\Model\File\FileId;

const inMemoryFileOfId = '\BenGorFile\Infrastructure\Domain\Model\File\inMemoryFileOfId';

function inMemoryFileOfId(FileId $id, array $files) : array
{
    return array_filter($files, function (array $file) use ($id) {
        return array_search($id, $file, true);
    });
}

const inMemoryPersist = '\BenGorFile\Infrastructure\Domain\Model\File\inMemoryPersist';

function inMemoryPersist(array $file, array $files) : array
{
    return isset($file['id'])
        ? inMemoryFileOfId($file['id'], $files)
            ? $files
            : array_merge($files, $file)
        : $files;
}

