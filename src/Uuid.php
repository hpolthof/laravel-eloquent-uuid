<?php


namespace Hpolthof\Laravel\EloquentUuid;


trait Uuid
{
    public static function bootUuid()
    {
        self::creating(function (self $model) {
            if ($model->hasUuid($model->getKeyName())) {
                $model->{$model->getKeyName()} = \Ramsey\Uuid\Uuid::uuid4()->toString();
            }
        });
    }

    public function initializeUuid()
    {
        if ($this->hasUuid($this->getKeyName())) {
            $this->casts[$this->getKeyName()] = 'string';
            $this->incrementing = false;
        }
    }

    /**
     * The attributes that should be UUIDs
     *
     * @return array
     */
    protected function uuidColumns(): array
    {
        return [];
    }


    /**
     * Get an attribute value and convert uuid to string if required.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        $value = parent::getAttributeValue($key);

        if ($this->hasUuid($key)) {
            $value = \Ramsey\Uuid\Uuid::fromBytes($value)->toString();
        }

        return $value;
    }

    /**
     * Try to set a uuid and continue with the regular flow.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if ($this->hasUuid($key)) {
            $value = \Ramsey\Uuid\Uuid::fromString($value)->getBytes();
        }

        return parent::setAttribute($key, $value);
    }

    protected function hasUuid($key)
    {
        return array_search($key, $this->uuidColumns()) !== false;
    }
}