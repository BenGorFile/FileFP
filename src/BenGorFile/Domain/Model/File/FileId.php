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

class FileId
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id() : string
    {
        return $this->id;
    }

    public function equals(FileId $id) : bool
    {
        return $this->id() === $id->id();
    }

    public function __toString() : string
    {
        return (string) $this->id();
    }
}
