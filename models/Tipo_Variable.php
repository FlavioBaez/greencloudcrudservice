<?php

class Tipo_Variable extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'tipo_variable';
    protected $primaryKey = 'idtipo_variable';

    //desactivar created_at updated_at
    public $timestamps = false;
}
?>