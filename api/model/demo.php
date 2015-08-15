<?php

 (include_once('pdo_connection.php')) or die('Cound include pdo_connection.php');

echo 'Test PDO Connection';

try {
	$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (Exception $e) {
	$error = $e->getMessage();
}

if ($db) {
	echo "<p>Connection successfuly</p>";	
} elseif (isset($error)) {
	echo '<p>error set: <tt><pre>' . var_dump($error) . '</pre></tt></p>';
} else {
	echo "<p> error wasnt set </p>";	
}

try {
	$sql = 'SELECT COUNT(*) FROM comment_status';
	$count = $db->query($sql);
	$numrows = $count-> fetchColumn();
} catch (Exception $e) {
	$error = $e->getMessage();
}

echo "<p> Total results found are $numrows </p>";

try {
	$sql = 'SELECT * FROM comment_status';
	$result = $db->query($sql);
	$all = $result->fetchAll(PDO::FETCH_ASSOC);
//	echo json_encode($all);
	echo '<pre>';
	print_r($all);
	echo '</pre>';
} catch (Exception $e) {
	$error = $e->getMessage();
}