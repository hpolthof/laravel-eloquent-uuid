<?php


namespace Hpolthof\Laravel\EloquentUuid;


class Builder extends \Illuminate\Database\Eloquent\Builder
{
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        if ($this->model->hasUuid($column)) {
            $value = $this->uuidBinaryValue($value);
        }

        return parent::where($column, $operator, $value, $boolean);
    }

    protected function uuidBinaryValue($value)
    {
        if ($value === null) {
            return $value;
        }

        if (strlen($value) === 36) {
            return \Ramsey\Uuid\Uuid::fromString($value)->getBytes();
        }

        if (strlen($value) === 16) {
            return $value;
        }

        throw new \Exception("No valid UUID was provided.");
    }
}