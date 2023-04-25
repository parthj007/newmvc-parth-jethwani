<?php

// $data = [
//     ['category' => 1, 'attribute' => 1, 'option' => 1],
//     ['category' => 1, 'attribute' => 1, 'option' => 2],
//     ['category' => 1, 'attribute' => 2, 'option' => 3],
//     ['category' => 1, 'attribute' => 2, 'option' => 4],
//     ['category' => 2, 'attribute' => 3, 'option' => 5],
//     ['category' => 2, 'attribute' => 3, 'option' => 6],
//     ['category' => 2, 'attribute' => 4, 'option' => 7],
//     ['category' => 2, 'attribute' => 4, 'option' => 8]
// ];

// $newArr = [];
// foreach ($data as $item) {
//     $category = $item['category'];
//     $attribute = $item['attribute'];
//     $option = $item['option'];


//     $newArr[$category][$attribute][$option] = $option;
// }

// echo "<pre>";
// print_r($newArr);




// --------------------------------------------------------------------------------------------------------------------------




// $data = [
//     1 => [1 => [1 => 1, 2 => 2], 2 => [3 => 3, 4 => 4]],
//     2 => [3 => [5 => 5, 6 => 6], 4 => [7 => 7, 8 => 8]]
// ];

// echo "<pre>";
// $final = [];
// foreach ($data as $category => $catArr) {
//     foreach ($catArr as $attribute => $attArr) {
//         foreach ($attArr as $key => $val) {
//             $newArr['category'] = $category;
//             $newArr['attribute'] = $attribute;
//             $newArr['option'] = $val;
//             array_push($final, $newArr);
//         }
//     }
// }
// print_r($final);



// --------------------------------------------------------------------------------------------------------------------------




$data = [
    ['category' => 1, 'categoryname' => 'c1', 'attribute' => 1, 'attributename' => 'a1', 'option' => 1, 'optionname' => 'o1'],
    ['category' => 1, 'categoryname' => 'c1', 'attribute' => 1, 'attributename' => 'a1', 'option' => 2, 'optionname' => 'o2'],
    ['category' => 1, 'categoryname' => 'c1', 'attribute' => 2, 'attributename' => 'a2', 'option' => 3, 'optionname' => 'o3'],
    ['category' => 1, 'categoryname' => 'c1', 'attribute' => 2, 'attributename' => 'a2', 'option' => 4, 'optionname' => 'o4'],
    ['category' => 2, 'categoryname' => 'c2', 'attribute' => 3, 'attributename' => 'a3', 'option' => 5, 'optionname' => 'o5'],
    ['category' => 2, 'categoryname' => 'c2', 'attribute' => 3, 'attributename' => 'a3', 'option' => 6, 'optionname' => 'o6'],
    ['category' => 2, 'categoryname' => 'c2', 'attribute' => 4, 'attributename' => 'a4', 'option' => 7, 'optionname' => 'o7'],
    ['category' => 2, 'categoryname' => 'c2', 'attribute' => 4, 'attributename' => 'a4', 'option' => 8, 'optionname' => 'o8'],
];

// $newArr = [
//     'category' => [
//         $category = [
//             'name' => $categoryname,
//             'attribute' => [
//                 $attribute => [
//                     'name' => $attributename,
//                     'option' => [
//                         $option = [
//                             'name' => $optionname
//                         ]
//                     ]
//                 ]
//             ]
//         ]
//     ]
// ];

// foreach ($data as $subdata) {
//     $category = $subdata['category'];
//     $categoryname = $subdata['categoryname'];
//     $attribute = $subdata['attribute'];
//     $attributename = $subdata['attributename'];
//     $option = $subdata['option'];
//     $optionname = $subdata['optionname'];

//     $newArr['category'][$category]['name'] = $categoryname;
//     $newArr['category'][$category]['attribute'][$attribute]['name'] = $attributename;
//     $newArr['category'][$category]['attribute'][$attribute]['option'][$option]['name'] = $optionname;
// }

// echo "<pre>";
// print_r($newArr);

// ----------------------------------------------------------------------------------------------------------------------

// $data = [
//     1 => [1 => [1 => 1, 2 => 2], 2 => [3 => 3, 4 => 4]],
//     2 => [3 => [5 => 5, 6 => 6], 4 => [7 => 7, 8 => 8]]
// ];

// echo "<pre>";
// $final = [];
// foreach ($data as $category => $catArr) {
//     foreach ($catArr as $attribute => $attArr) {
//         foreach ($attArr as $key => $val) {
//             $newArr['category'] = $category;
//             $newArr['attribute'] = $attribute;
//             $newArr['option'] = $val;
//             array_push($final, $newArr);
//         }
//     }
// }
// print_r($final);





// ----------------------------------------------------------------------------------------------------------------------


// $data = array
// (
//     "category" => array
//     (
//         [1] => array
//         (
//             "name" => "c1",
//             "attribute" => array
//             (
//                 [1] => array
//                 (
//                     "name" => "a1",
//                     "option" => array
//                     (
//                         [1] => array
//                         (
//                             "name" => "o1"
//                         ),

//                         [2] => array
//                         (
//                             "name" => "o2"
//                         )
//                     )
//                 ),
//                 [2] => array
//                 (
//                     "name" => "a2",
//                     "option" => array
//                     (
//                         [3] => array
//                         (
//                             "name" => "o3"
//                         ),
//                         [4] => array
//                         (
//                             "name" => "o4"
//                         )
//                     )
//                 )
//             )
//         ),
//         [2] => array
//         (
//             "name" => "c2",
//             "attribute" => array
//             (
//                 [3] => array
//                 (
//                     "name" => "a3",
//                     "option" => array
//                     (
//                         [5] => array
//                         (
//                             "name" => "o5"
//                         ),
//                         [6] => array
//                         (
//                             "name" => "o6"
//                         )
//                     )
//                 ),
//                 [4] => array
//                 (
//                     "name" => "a4",
//                     "option" => array
//                     (
//                         [7] => array
//                         (
//                             "name" => "o7"
//                         ),
//                         [8] => array
//                         (
//                             "name" => "o8"
//                         )
//                     )
//                 )
//             )
//         )
//     )
// );


$data = [
    ['category' => 1, 'attribute' => 1, 'option' => 1],
    ['category' => 1, 'attribute' => 1, 'option' => 2],
    ['category' => 1, 'attribute' => 2, 'option' => 3],
    ['category' => 1, 'attribute' => 2, 'option' => 4],
    ['category' => 2, 'attribute' => 3, 'option' => 5],
    ['category' => 2, 'attribute' => 3, 'option' => 6],
    ['category' => 2, 'attribute' => 4, 'option' => 7],
    ['category' => 2, 'attribute' => 4, 'option' => 8]
];


?>