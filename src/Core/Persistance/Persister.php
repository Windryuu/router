<?php

namespace App\Core\Persistance;

use ReflectionClass;
use ReflectionException;

class Persister{

    public function persist($entity){
        $reflectionEntity = new ReflectionClass($entity);

        $baseSql = "Insert Into ".$reflectionEntity->getShortName()."(";

        $i=1;
        foreach($reflectionEntity->getProperties() as $property) {
            if($i === count($reflectionEntity->getProperties())){
                $baseSql.=$property->getName();
            } else {
                $baseSql.= $property->getName() . ",";
            }
            $i++;
        }
        $baseSql.=') VALUES(';

        $a =1;
        foreach($reflectionEntity->getProperties() as $property) {
            if ($a === count($reflectionEntity->getProperties())){
                $baseSql.= call_user_func([$entity,'get'.ucfirst($property->getName())]);
            } else {
                $baseSql.= call_user_func([$entity,'get'.ucfirst($property->getName())]) . ",";
            }
            $a++;
        }
            
        $baseSql.= ')';
        dump($baseSql);
        dd($reflectionEntity->getProperties());
        }
    }

