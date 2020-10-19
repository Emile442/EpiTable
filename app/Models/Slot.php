<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = ['start_at', 'end_at'];

    protected $dates = ['start_at', 'end_at'];

    public function getCanBeBookAttribute()
    {
        $limitTime = Carbon::createFromFormat('H:i', $this->start_at->format('H:i'))->subMinutes(10);
        return !(Carbon::now()->greaterThan($limitTime));
    }
}
