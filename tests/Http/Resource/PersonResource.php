<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Tests\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use RedExplosion\Vermillion\Traits\JsonResource\WithReverseMigrations;
use RedExplosion\Vermillion\VersionedSet;

class PersonResource extends JsonResource
{
    use WithReverseMigrations;

    /**
     * @param $request
     * @return array|void
     */
    public function toLatestArray($request)
    {
        $person = $this->resource;
        assert($person instanceof Person);
        return [
            'display_name' => $person->name,
            'age' => $person->age,
            'nickname' => $person->nickName,
            'hobbies' => $this->when(isset($person->hobbies), fn () => $person->hobbies),
        ];
    }

    /**
     * @param VersionedSet $set
     * @return void
     */
    protected static function reverseMigrations(VersionedSet $set): void
    {
        $set->for('7', fn (array $v) => self::removeNickname($v))
            ->for('5', fn (array $v, PersonResource $res, $req) => self::showHobbiesEvenIfEmpty($v, $res))
            ->for('2', fn (array $v) => self::revertToName($v))
            ->for('1', fn (array $v, PersonResource $res, $req) => $res->useProtectedMethods($v));
    }


    private static function removeNickname($v)
    {
        unset($v['nickname']);
        return $v;
    }

    private static function showHobbiesEvenIfEmpty($v, self $resource)
    {
        $v['hobbies'] = $resource->hobbies ?? [];
        return $v;
    }

    private static function revertToName($v)
    {
        $v['name'] = $v['display_name'];
        unset($v['display_name']);
        return $v;
    }

    /**
     * @param array $v
     * @return array
     */
    protected function useProtectedMethods(array $v)
    {
        $v['always_true'] = $this->when(true, true);
        return $v;
    }
}
