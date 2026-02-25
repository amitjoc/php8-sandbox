<h1>Bubble Sort</h1>
<?php

/**
 * @author Er. Amit Joshi
 *
 * Algorithm: Sorting
 * Algorithm Name: Bubble Sort
 *
 * Numbers to be sort by Bubble Sort either in increasing or decreasing order
 *
 * Best Input case: n<50
 *
 * Complexity:
 * Best Case:
 * Average Case:
 * Worst Case:
 *
 */
$numbers = [45, 12, 8, 23, 56, 3, 91, 34, 17, 42];
$sorted_numbers = [3, 8, 12, 17, 23, 34, 42, 45, 56, 91];

function bubbleSort(array $numbers): array
{
    $length = count($numbers);
    $swaped = false ;
    $totalLoopCount = $innerLoopCount = $outerLoopCount = $swapCount = 0;
    for ($i=0; $i<($length-1); $i++)
    {
        $swaped = false;
        for ($j = 0; $j <($length-$i-1) ; $j++)
        {
            if( $numbers[$j] > $numbers[$j+1])
            {
               $temp = $numbers[$j+1];
               $numbers[$j+1] = $numbers[$j];
               $numbers[$j] = $temp;
               $swaped = true;
               $swapCount++;
            }
            $innerLoopCount++;
        }
        $outerLoopCount++;
        if (!$swaped) {break;}
    }
    return [$numbers,'swapingCount'=>$swapCount,'outerLoopCount'=>$outerLoopCount,'innerLoopCount'=>$innerLoopCount,'totalLoopCount'=>($innerLoopCount+$outerLoopCount)];
}
echo "<pre>";
print_r(bubbleSort($sorted_numbers));
print_r(bubbleSort($numbers));
