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

function upload(FileId $id, FileName $name, FileMimeType $mimeType, string $content) : array
{
    function guardMimeTypeSupports(FileMimeType $mimeType) : void
    {
        if (!in_array($mimeType->mimeType(), FileMimeType::mimeTypes(), true)) {
            throw new FileMimeTypeIsNotSupported();
        }
    }

    return fileWasUploaded($id, $name, $mimeType, $content);
}

function apply(array $state, array ...$events) : array
{
    foreach ($events as $event) {
        switch ($event['name']) {
            case 'file_was_uploaded':
                $state = array_merge($state, call_user_func($event['payload']));
                break;
        }
    }

    return $state;
}
