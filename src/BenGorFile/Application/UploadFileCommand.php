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

class UploadFileCommand
{
    public $id;
    public $name;
    public $uploadedFile;
    public $mimeType;

    public function __construct(string $id, string $name, string $uploadedFile, string $mimeType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->uploadedFile = $uploadedFile;
        $this->mimeType = $mimeType;
    }
}
