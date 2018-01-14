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

use BenGorFile\Domain\Model\File\FileMimeTypeIsNotSupported;
use BenGorFile\Domain\Model\File\FileNameIsInvalid;
use Ramsey\Uuid\Uuid;

class UploadFileCommand
{
    public $id;
    public $name;
    public $uploadedFile;
    public $mimeType;

    public function __construct(string $name, string $uploadedFile, string $mimeType, string $id = null)
    {
        if (!$name) {
            throw new FileNameIsInvalid();
        }
        if (!$mimeType) {
            throw new FileMimeTypeIsNotSupported();
        }
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
        $this->name = $name;
        $this->uploadedFile = $uploadedFile;
        $this->mimeType = $mimeType;
    }
}
