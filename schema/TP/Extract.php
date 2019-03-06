<?php 

$data = [
  'name' => 'Jean',
  'age'  => 34,
  'job'  => 'Developer'
];

extract($data);
echo $name;

# Equivaut a ceci:

# Mexanism of function extract()
foreach ($data as $key => $value)
{
	 $$key = $value; // $.'name' = 'Jean';
}

echo $name;


public function test($ageParam = null)
{
	global $age;
	echo $age . ' | '. $ageParam;
}

test();