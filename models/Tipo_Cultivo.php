<?php

class Tipo_Cultivo extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'tipo_cultivo';
    protected $primaryKey = 'idtipo_cultivo';

    //desactivar created_at updated_at
    public $timestamps = false;
}
?>