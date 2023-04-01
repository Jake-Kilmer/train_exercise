<?php
//Jake Kilmer php test.
class Train {
    public $Cars = array();
    public function addFront($newCar) {
        try {
            if (sizeof($this->Cars) >= 30) {
                throw new Exception("30 train cars is the limit.");
            }
            array_unshift($this->Cars, $newCar);
        } catch (\Exception $th) {
            echo $th -> getMessage();
        }
    }
    public function addBack($newCar) {
        try {
            if (sizeof($this->Cars) >= 30) {
                throw new Exception("30 train cars is the limit. \n");
            }
            array_push($this->Cars, $newCar);
        } catch (\Exception $th) {
            echo $th -> getMessage();
        }
    }
    public function removeFront() {
        try {
            if (sizeof($this->Cars) == 0) {
                throw new Exception("There are no more train cars to remove. \n");
            }
            array_shift($this->Cars);
        } catch (\Exception $th) {
            echo $th -> getMessage();
        }
    }
    public function removeBack() {
        try {
            if (sizeof($this->Cars) == 0) {
                throw new Exception("There are no more train cars to remove. \n");
            }
            array_pop($this->Cars);
        } catch (\Exception $th) {
            echo $th -> getMessage();
        }
    }
    public function totalCars() {
        $hasOtherTypes = false;
        $typeRegular = 0;
        $typeCargo = 0;
        $typePassenger = 0;
        $typeEngine = 0;
        foreach($this->Cars as $item) {
            if ($item->trainType == "Regular") {
                $typeRegular++;
            }
            if ($item->trainType == "Cargo") {
                $typeCargo++;
                $hasOtherTypes = true;
            }
            else if ($item->trainType == "Passenger") {
                $typePassenger++;
                $hasOtherTypes = true;
            }
            else if ($item->trainType == "Engine") {
                $typeEngine++;
                $hasOtherTypes = true;
            }
        }
        if ($hasOtherTypes === true) {
            echo "\n" . "Total Cars: " . sizeof($this->Cars) . "\n";
            if ($typeRegular > 0){
                echo "Regular: " . $typeRegular . "\n";
            } 
            if ($typeCargo > 0){
                echo "Cargo: " . $typeCargo . "\n";
            } 
            if ($typePassenger > 0){
                echo "Passenger: " . $typePassenger . "\n";
            } 
            if ($typeEngine > 0){
                echo "Engine: " . $typeEngine . "\n";
            }
            echo "\n \n";
        }
        else {
            echo "\n" . "Total Cars: " . sizeof($this->Cars) . "\n \n";
        }
    }
    public function showTrain() {
        $count = 0;
        echo "\n \n";
        echo "---- \n";
        echo "/  | Train\n";
        echo "---- \n";
        if (isset($this->Cars)) {
            $count = 1;
            foreach ($this->Cars as $car) {
                echo $count . ".[" . $car->trainType . "]-";
                $count++;
            }
        }
        echo "\n";
        echo "---- \n";
        echo "/__|\n";
        echo "\n \n";
    }
    // public function cargoCars() {
    //     $totalCargoCars = 0;
    //     $totalCargoCars = array_reduce($this->Cars, function ($carry, $item) {
    //         if ($item->trainType == "Cargo") {
    //             $carry += $item;
    //         }
    //         return $carry;
    //     });
    //     if (!$totalCargoCars) {$totalCargoCars = 0;}
    //     echo "\n \n" . "Cargo Cars: " . $totalCargoCars . "\n \n \n";
    // }
    // public function passengerCars() {
    //     $totalPassengerCars = array_reduce($this->Cars, function ($carry, $item) {
    //         if ($item->trainType == "Passenger") {
    //             $carry += $item;
    //         }
    //         return $carry;
    //     });
    //     if (!$totalPassengerCars) {$totalPassengerCars = 0;}
    //     echo "\n \n" . "Passenger Cars: " . $totalPassengerCars . "\n \n \n";
    // }
    // public function engineCars() {
    //     $totalEngineCars = 0;
    //     $totalEngineCars = array_reduce($this->Cars, function ($carry, $item) {
    //         if ($item->trainType == "Engine") {
    //             $carry += $item;
    //         }
    //         return $carry;
    //     });
    //     if (!$totalEngineCars) {$totalEngineCars = 0;}
    //     echo "\n \n" . "Engine Cars: " . $totalEngineCars . "\n \n \n";
    // }
    public function totalCarsWeight($carry, $item) {
        $carry += $item -> weight;
        return $carry;
    }
    public function totalWeight() {
        $newTrainWeight = array_reduce($this->Cars, array($this, "totalCarsWeight"));
        if (!$newTrainWeight){$newTrainWeight = 0;}
        echo "\n \n" . $newTrainWeight . "\n \n" ;  
    }
}
class TrainCar {
    public $weight = 0;
    public $trainType;
    public function __construct($trainType = "Regular") {
        $this->trainType = $trainType;
    }
    public function setWeight($weight) {
        try {
            if (!is_numeric($weight)) {
                throw new Exception("That is not a number. Please enter a numbrer.");
            }
            $this -> weight = $weight;
        } catch (\Execption $th) {
            echo $th -> getMessage();
        }
    }
    public function getWeight() {
        echo $this -> weight;
    }
}
class CargoTrainCar extends TrainCar {
    public $trainType = "Cargo";
}
class PassengerTrainCar extends TrainCar {
    public $trainType = "Passenger";
}
class EngineTrainCar {
    public $trainType = "Engine";
}
echo PHP_EOL;