<?php

namespace App\Filters;

use Illuminate\Http\Request;
use  App\Filters\ApiFilters;


class UsersFilter extends ApiFilters
{

    protected $safeParms = [
        "name" => ["eq"],
        "email" => ["eq"]
    ];


    protected $operatorMap = [
        "eq" => "=",
        "lt" => "<",
        "lte" => "<=",
        "gt" => ">",
        "lte" => ">="
    ];
}
