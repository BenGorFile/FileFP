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
    return in_array($mimeType->mimeType(), FileMimeType::mimeTypes(), true)
        ? fileWasUploaded($id, $name, $mimeType, $content)
        : [];
}

function apply(array $file, array ...$events) : array
{
    foreach ($events as $event) {
        switch ($event['name']) {
            case 'file_was_uploaded':
                $file = array_merge($file, call_user_func($event['payload']));
                break;
        }
    }

    return $file;
}
