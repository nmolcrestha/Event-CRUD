<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $table = 'events';

    protected $guarded = [];

    protected $casts = ['start_date' => 'date', 'end_date' => 'date', ];

    protected $fillable =['title', 'description', 'start_date', 'end_date'];

    // protected $attributes = ['status', 'end_date_edit', 'start_date_edit'];

    protected $appends = ['status', 'end_date_edit', 'start_date_edit'];

    public function getStatusAttribute(){
        if($this->start_date->format('Y-m-d') > date('Y-m-d') and $this->end_date->format('Y-m-d') > date('Y-m-d')){
            return 'upcoming';
        }elseif($this->start_date->format('Y-m-d') <= date('Y-m-d') and $this->end_date->format('Y-m-d') >= date('Y-m-d')){
            return 'running';
        }else{
            return 'ended';
        }
    }

    public function getStatusColorAttribute(){
        return [
            'running' => 'green',
            'ended' => 'red'
        ][$this->status] ?? 'indigo';
    }

    public function getStartDateEditAttribute(){
        return $this->start_date->format('m/d/Y');
    }

    public function setStartDateEditAttribute($value){
        $this->start_date = Carbon::parse($value);
    }

    public function getEndDateEditAttribute(){
        return $this->end_date->format('m/d/Y');
    }

    public function setEndDateEditAttribute($value){
        $this->end_date = Carbon::parse($value);
    }
    
}
