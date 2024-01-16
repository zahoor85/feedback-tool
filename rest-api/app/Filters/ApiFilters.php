<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilters
{

    protected $safeParms = [
         

    ];

    protected $columnMap = [
       
    ];

    protected $operatorMap = [
        
    ];

    public function transform(Request $request)
    {

        $eloQuery = [];
        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);
            if (!isset($query)) {
                continue;
            }

            $columnName = $this->columnMap[$parm] ?? $parm;

            foreach($operators as $operator){

                if(isset($query[$operator])){

                    $eloQuery[] = [$columnName, $this->operatorMap[$operator], $query[$operator]];

                }
            }
        }
        return $eloQuery;
    }
}