<?php


namespace Hpolthof\Laravel\EloquentUuid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

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
//    public function getAttributeValue($key)
//    {
//        $value = parent::getAttributeValue($key);
//
//        // Check if the call is coming from a Relationship, cause then
//        // we'd like to submit the raw binary code.
//        if (Collection::make(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))
//                ->where('class', '!=', null)
//                ->filter(function ($item) {
//                    $rc = new \ReflectionClass($item['class']);
//                    return $rc->isSubclassOf(Relation::class);
//                })
//                ->count() > 0) {
//            return $value;
//        }
//
//        if ($this->hasUuid($key)) {
//            $value = \Ramsey\Uuid\Uuid::fromBytes($value)->toString();
//        }
//
//        return $value;
//    }

    /**
     * Try to set a uuid and continue with the regular flow.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
//    public function setAttribute($key, $value)
//    {
//        if ($this->hasUuid($key)) {
//            $value = \Ramsey\Uuid\Uuid::fromString($value)->getBytes();
//        }
//
//        return parent::setAttribute($key, $value);
//    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return Builder|static
     */
//    public function newEloquentBuilder($query)
//    {
//        return new Builder($query);
//    }

    public function hasUuid($key)
    {
        return array_search($key, $this->uuidColumns()) !== false;
    }

//    public function attributesToArray()
//    {
//        $attributes = parent::attributesToArray();
//
//        foreach ($this->uuidColumns() as $field) {
//            $attributes[$field] = $this->{$field};
//        }
//
//        $attributes = array_map(function ($value) {
//            if ($value instanceof Model) {
//                return $value->toArray();
//            }
//        }, $attributes);
//
//        return $attributes;
//    }

}