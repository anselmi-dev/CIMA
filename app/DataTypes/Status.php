<?php

namespace App\DataTypes;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Status
{
    const PENDING = 'pending';

	const PROGRESS = 'progress';

	const CANCELLED = 'cancelled';

	const COMPLETED = 'completed';

    /**
     * Initialise the Price datatype.
     *
     * @param  mixed  $value
     */
    public function __construct(
		public Model $model,
        public $value,
    ) {
		if (!in_array($value, ['pending', 'progress', 'cancelled', 'completed'])) {
			throw new Exception('Invalid status value.');
		}
    }

    /**
     * Getter for methods/properties.
     *
     * @param  string  $name
     * @return void
     */
    public function __get($name)
    {
        if (method_exists($this, $name)) {
            return $this->{$name}();
        }
    }

    /**
     * Cast class as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * Format the status value.
     *
     * @return string
     */
    public function label (): string
    {
        return match ($this->value) {
            'pending' => 'Pendiente',
            'progress' => 'En Progreso',
            'completed' => 'Completado',
            'cancelled' => 'Cancelado',
            default => 'Desconocido',
        };
    }

	/**
     *
     * @return string
     */
    public function color (): string
    {
		return match ($this->value) {
			self::PENDING => 'gray',
			self::PROGRESS => 'warning',
			self::COMPLETED => 'success',
			self::CANCELLED => 'danger',
			default => 'secondary'
		};
	}

	public function available (): bool
	{
		return match ($this->value) {
			self::PENDING => true,
			self::CANCELLED => true,
			default => false
		};
	}

    /**
     *
     * @return bool
     */
    public function is_pending (): bool
    {
        return $this->value == self::PENDING;
    }

    /**
     *
     * @return bool
     */
    public function is_progress (): bool
    {
        return $this->value == self::PROGRESS;
    }

    /**
     *
     * @return bool
     */
    public function is_completed (): bool
    {
        return $this->value == self::COMPLETED;
    }

    /**
     *
     * @return bool
     */
    public function is_cancelled (): bool
    {
        return $this->value == self::CANCELLED;
    }
}
