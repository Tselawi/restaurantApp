<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function saleDetails(){
        return $this->hasmany(saleDetail::class); // {$this} means the class Sale and we should linked with sale details cuz on sale has many sale details
    }
}
