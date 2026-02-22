<?php

// 6. usort() - Custom sorting
$students = [
    ['name' => 'John', 'grade' => 85],
    ['name' => 'Alice', 'grade' => 92],
    ['name' => 'Bob', 'grade' => 78]
];

echo "<pre>";
print_r($students);
// Sort by grade descending
usort($students, function($a, $b) {
    return $b['grade'] <=> $a['grade'];
});
print_r($students);


