<?php

class Usuario extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'user';
    protected $primaryKey = 'idusers';

    //desactivar created_at updated_at
    public $timestamps = false;
}
?>