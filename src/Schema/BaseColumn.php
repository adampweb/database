<?php
/* ===========================================================================
 * Copyright 2018 Zindex Software
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================================ */

namespace Opis\Database\Schema;

class BaseColumn
{
    protected string $name;
    protected ?string $type;
    protected array $properties = [];

    public function __construct(string $name, string $type = null)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function set(string $name, mixed $value): static
    {
        $this->properties[$name] = $value;
        return $this;
    }

    public function has(string $name): bool
    {
        return isset($this->properties[$name]);
    }

    public function get(string $name, mixed $default = null): mixed
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : $default;
    }

    public function size(string $value): static
    {
        $value = strtolower($value);

        if (!in_array($value, ['tiny', 'small', 'normal', 'medium', 'big'])) {
            return $this;
        }

        return $this->set('size', $value);
    }

    public function notNull(): static
    {
        return $this->set('nullable', false);
    }

    public function description(string $comment): static
    {
        return $this->set('description', $comment);
    }

    public function defaultValue($value): static
    {
        return $this->set('default', $value);
    }

    public function unsigned(bool $value = true): static
    {
        return $this->set('unsigned', $value);
    }

    public function length($value): static
    {
        return $this->set('length', $value);
    }
}
