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
$numbers_100 = [847, 123, 456, 789, 234, 567, 890, 345, 678, 901,
    432, 765, 98, 876, 543, 210, 987, 654, 321, 111,
    222, 333, 444, 555, 666, 777, 888, 999, 112, 223,
    334, 445, 556, 667, 778, 889, 990, 101, 212, 323,
    434, 545, 656, 767, 878, 989, 191, 292, 393, 494,
    595, 696, 797, 898, 999, 100, 201, 302, 403, 504,
    605, 706, 807, 908, 19, 120, 221, 322, 423, 524,
    625, 726, 827, 928, 29, 130, 231, 332, 433, 534,
    635, 736, 837, 938, 39, 140, 241, 342, 443, 544,
    645, 746, 847, 948, 49, 150, 251, 352, 453, 554];

$numbers_1000 = [5678, 1234, 8901, 4567, 2345, 7890, 3456, 9012, 6789, 2345,
    7890, 3456, 9012, 5678, 1234, 8901, 4567, 2345, 7890, 3456,
    9012, 6789, 2345, 7890, 3456, 9012, 5678, 1234, 8901, 4567,
    2345, 7890, 3456, 9012, 6789, 2345, 7890, 3456, 9012, 5678,
    1234, 8901, 4567, 2345, 7890, 3456, 9012, 6789, 2345, 7890,
    3456, 9012, 5678, 1234, 8901, 4567, 2345, 7890, 3456, 9012,
    6789, 2345, 7890, 3456, 9012, 5678, 1234, 8901, 4567, 2345,
    7890, 3456, 9012, 6789, 2345, 7890, 3456, 9012, 5678, 1234,
    8901, 4567, 2345, 7890, 3456, 9012, 6789, 2345, 7890, 3456,
    9012, 5678, 1234, 8901, 4567, 2345, 7890, 3456, 9012, 6789];

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
//print_r(bubbleSort($sorted_numbers));
//print_r(bubbleSort($numbers));
//print_r(bubbleSort($numbers_100));
print_r(bubbleSort($numbers_1000));
