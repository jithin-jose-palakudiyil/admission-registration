<?php

namespace Modules\Web\Entities;

use Illuminate\Database\Eloquent\Model;

class AssignColleges extends Model
{
    protected $table = "pivot_assign_colleges";
    protected $fillable = [];
    protected $guarded = [ ];  


        
    public function GetColleges()
    {
        return $this->belongsTo(\Modules\Web\Entities\Colleges::class, 'college_id', 'id');
    }
}
