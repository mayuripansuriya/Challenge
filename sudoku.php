<?php
 
class checkCompleteValidSudoku
{
    var $sudoku = array();
     
    // take inputs
    function populateSudoku($input)
    {
        $this->sudoku = $input;
    }
     
    function validate()
    {
        $checkNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];
         
        //check all rows for duplicate values
        // any duplicate value in any row will fail validation
        for($row = 0 ; $row < 9 ; $row++){
            $duplicateInRows = [];
            $duplicateInCols = [];
            for($col = 0 ; $col < 9 ; $col++){
                if(!in_array($this->sudoku[$row][$col], $checkNumbers))
                    return false;
                else {
                    if(!in_array($this->sudoku[$row][$col], $duplicateInRows)){
                        array_push($duplicateInRows, $this->sudoku[$row][$col]);
                    } else {
                         return false;
                    }
                    if(!in_array($this->sudoku[$col][$row], $duplicateInCols)){
                        array_push($duplicateInCols, $this->sudoku[$col][$row]);
                    } else {
                        return false;
                    }
                }
          
            }
            $boxNumbers = [];
        
            //check for correct 3 * 3 matrix
            $verticalStart = 3 * floor($row / 3);
            $verticalEnd = $verticalStart + 3;
            while($verticalStart < $verticalEnd) {
                $horizontalStart = 3 * ($row % 3);
                $horizontalEnd = $horizontalStart + 3;
                while($horizontalStart < $horizontalEnd) {
                    if(!in_array($this->sudoku[$verticalStart][$horizontalStart], $boxNumbers)){
                        array_push($boxNumbers, $this->sudoku[$verticalStart][$horizontalStart]);
                    } else {
                         return false;
                    }
                    $horizontalStart++;
                }
                $verticalStart++;
            }
        }       
        return true;
    }
}
 
 
$obj = new checkCompleteValidSudoku();

//we can also pass the input from commandline as well but as the matrix 
//is quite big I have used as a static matrix 
//define input
$input =  array(
    array(1, 8, 2, 5, 4, 3, 6, 9, 7), //1
    array(9, 6, 5, 1, 7, 8, 3, 4, 2), //2
    array(7, 4, 3, 9, 6, 2, 8, 1, 5), //3
    array(3, 7, 4, 8, 9, 6, 5, 2, 1), //4
    array(6, 2, 8, 4, 5, 1, 7, 3, 9), //5
    array(5, 1, 9, 2, 3, 7, 4, 6, 8), //6
    array(2, 9, 7, 6, 8, 4, 1, 5, 3), //7
    array(4, 3, 1, 7, 2, 5, 9, 8, 6), //8
    array(8, 5, 6, 3, 1, 9, 2, 7, 4), //9
);
 
// set input
$obj->populateSudoku($input);
 
// validate
echo "Given Sudoku ".($obj->validate() ? "is" : "is not")." a valid and complete Sudoku";
 
?>