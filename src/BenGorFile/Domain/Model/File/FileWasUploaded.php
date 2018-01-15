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

function fileWasUploaded(FileId $id, FileName $name, FileMimeType $mimeType, string $content) : array
{
    return [
        'name'    => 'file_was_uploaded',
        'payload' => function () use ($id, $name, $mimeType, $content) {
            return [
                'id'          => $id,
                'name'        => $name,
                'mime_type'   => $mimeType,
                'content'     => $content,
                'occurred_on' => (new \DateTimeImmutable('now', new \DateTimeZone('UTC')))->getTimestamp(),
            ];
        },
    ];
}
