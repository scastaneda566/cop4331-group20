<?php
	$inData = getRequestInfo();
	$userId = $inData["userId"];
	
	$newFirstName = $inData["newFirstName"];
	$newLastName = $inData["newLastName"];
	$newPhone = $inData["newPhone"];
	$newEmail = $inData["newEmail"];

	$conn = new mysqli("localhost", "root", "Current-Root-Password", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("UPDATE Contacts SET FirstName=?, LastName=?, Phone=?, Email=? WHERE ID=?");
		$stmt->bind_param("ssssi", $newFirstName, $newLastName, $newPhone, $newEmail, $userId);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		returnWithError("");
	}

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
?>