
<h1>Array Sorting (14 functions)</h1>
<pre>
sort() - Sort arrays in ascending order
rsort() - Sort in descending order
    - key will be lost after in both index and associative array's and new index will be applied

asort() - Sort associative arrays in ascending order by value
arsort() - Sort associative arrays in descending order by value
    - key association is maintained

ksort() - Sort associative arrays in ascending order by key
krsort() - Sort associative arrays in descending order by key

natsort() - Sort using natural order algorithm
natcasesort() - Sort using case-insensitive natural order
usort() - Sort by values using user-defined comparison function
uasort() - Sort by values with user-defined comparison (maintains keys)
uksort() - Sort by keys using user-defined comparison
array_multisort() - Sort multiple or multi-dimensional arrays
shuffle() - Randomly shuffle array elements
array_reverse() - Return array in reverse order
</pre>

<?php
// Numbers
$numbers = [45, 12, 8, 23, 3=>56, 3, 91, 34, 17, 42];

// Strings
$fruits = ['orange', 'ap'=>'apple', 'Banana', 'grape', 'Watermelon', 'kiwi', 'Mango'];
$fruits_case = array(
    "Orange1", "orange2", "Orange3", "orange20"
);

// Mixed case strings
$names = ['john', 'Alice', 'bob', 'Carol', 'david', 'Eve', 'frank'];

// Decimal numbers
$prices = [12.99, 5.50, 23.75, 8.25, 19.99, 4.95, 15.00];

// Negative numbers
$temperatures = [23, -5, 12, -8, 0, 15, -3, 7, -12, 9];
echo "<pre>";
print_r($fruits_case);
rsort($fruits_case,SORT_NATURAL | SORT_FLAG_CASE);
print_r($fruits_case);


// 3. asort() - Sort associative array by values
$studentGrades = ['John' => 85, 'Alice' => 92, 'Bob' => 78, 'Carol' => 88];
echo "asort() based on value";echo "<br />";
asort($studentGrades);
print_r($studentGrades);
echo "<br />";
echo "ksort() based on key ";echo "<br />";
ksort($studentGrades);
print_r($studentGrades);









