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

namespace BenGorFile\Application;

use function BenGorFile\Domain\Model\File\apply;
use BenGorFile\Domain\Model\File\FileId;
use BenGorFile\Domain\Model\File\FileMimeType;
use BenGorFile\Domain\Model\File\FileName;
use function BenGorFile\Domain\Model\File\upload;

function uploadFile(callable $persistence) : callable
{
    return function (UploadFileCommand $command) use ($persistence) : array {
        return $persistence(
            apply(
                [],
                upload(
                    new FileId($command->id),
                    new FileName($command->name),
                    new FileMimeType($command->mimeType),
                    $command->uploadedFile
                )
            )
        );
    };
}
