<?php

class Sector extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'sector';
    protected $primaryKey = 'idsector';

    //desactivar created_at updated_at
    public $timestamps = false;
}
?>