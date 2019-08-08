<?php


namespace Hpolthof\Laravel\EloquentUuid\Tests\Unit;


use Hpolthof\Laravel\EloquentUuid\Tests\TestCase;
use Hpolthof\Laravel\EloquentUuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class UuidTraitTest extends TestCase
{
    public function test_it_converts_uuid_to_bytes()
    {
        $model = new class extends Model {
            use Uuid;

            protected function uuidColumns(): array
            {
                return ['uuid'];
            }

            public function rawAttributes()
            {
                return $this->attributes;
            }
        };

        $this->assertInstanceOf(Model::class, $model);

        $model->test = $this->uuid4();
        $model->uuid = $this->uuid4();

        $this->assertEquals(16, strlen($model->rawAttributes()['uuid']), 'UUID should be 16 chars long internally.');
        $this->assertEquals(36, strlen($model->rawAttributes()['test']), 'String UUID should be 36 chars long internally.');
        $this->assertEquals(strlen($model->test), strlen($model->uuid), 'Usable results of UUIDs should be 36 chars long.');

    }

    protected function uuid4(): string
    {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }
}