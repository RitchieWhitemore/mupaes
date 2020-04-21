<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HiddenTrait
 * @package App\traits
 *
 * @method HiddenTrait notHidden()
 */
trait HiddenTrait
{
    public static function getHiddenArray()
    {
        return [
            self::HIDDEN_NO => 'Нет',
            self::HIDDEN_YES => 'Да'
        ];
    }

    public function getHiddenValue()
    {
        return \Arr::get(self::getHiddenArray(), $this->getAttribute('hidden'));
    }

    public function scopeNotHidden(Builder $query)
    {
        return $query->where('hidden', self::HIDDEN_NO);
    }
}
