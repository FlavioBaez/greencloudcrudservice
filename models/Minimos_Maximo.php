<?php

class Minimos_Maximo extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'minimos_maximos';
    protected $primaryKey = 'idminimos_maximos_sector';

    //desactivar created_at updated_at
    public $timestamps = false;
}
?>