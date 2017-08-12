<?php

class Variable extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'variable';
    protected $primaryKey = 'id_variable';

    //desactivar created_at updated_at
    public $timestamps = false;
}
?>