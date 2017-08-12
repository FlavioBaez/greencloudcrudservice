<?php

class Invernadero extends Illuminate\Database\Eloquent\Model
{
protected $table ='invernadero';
protected $primaryKey = 'idinvernadero';

//desactivar created_at updated_at
public $timestamps =false; 

}
?>