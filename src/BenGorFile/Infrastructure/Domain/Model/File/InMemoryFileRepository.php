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

function fileOfId(FileId $id, array $files) : array
{
    return array_filter($files, function (array $file) use ($id) {
        return array_search($id, $file, true);
    });
}

function persist(callable $event, array $files) : void
{

}

