<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'table_id', 'table_place', 'slot_id', 'booked_for'];

    protected $dates = ['booked_for'];

    public function table() {
        return $this->belongsTo(Table::class);
    }

    public function slot() {
        return $this->belongsTo(Slot::class);
    }

    public function getCanBeDeleteAttribute()
    {
        $limitTime = Carbon::createFromFormat('d/m/Y H:i', $this->booked_for->format('d/m/Y') . ' ' . $this->slot->start_at->format('H:i'))->subMinutes(15);
        return !(Carbon::now()->greaterThan($limitTime));
    }
}
