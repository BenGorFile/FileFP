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

use BenGorFile\Domain\Model\File\FileAlreadyExists;
use BenGorFile\Domain\Model\File\FileId;
use BenGorFile\Domain\Model\File\FileMimeType;
use BenGorFile\Domain\Model\File\FileName;
use function BenGorFile\Domain\Model\File\upload;

function uploadFile(callable $persistence) : callable
{
    function guardFileExists(callable $persistence, FileId $id) : void
    {
        if (null !== $persistence($id)) {
            throw new FileAlreadyExists();
        }
    }

    function guardFileDoesNotExistInFilesystem(callable $persistence, FileName $name) : void
    {
        if (true === $persistence($name)) {
            throw new FileAlreadyExists();
        }
    }

    return function (UploadFileCommand $command) use ($persistence) : void {
        $id = new FileId($command->id);
        $name = new FileName($command->name);
        $mimeType = new FileMimeType($command->mimeType);
        $content = $command->uploadedFile;

        guardFileExists($persistence, $id);
        guardFileDoesNotExistInFilesystem($persistence, $name);

        $persistence([], upload($id, $name, $mimeType, $content));
    };
}
