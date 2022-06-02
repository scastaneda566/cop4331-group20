<?php
	$inData = getRequestInfo();
	
	$FirstName = $inData["FirstName"];
	$LastName = $inData["LastName"];
	$userId = $inData["userId"];
	$Phone = $inData["Phone"];
	$Email = $inData["Email"];

	$conn = new mysqli("localhost", "root", "Current-Root-Password", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		//$stmt = $conn->prepare("INSERT into Contacts (UserId,FirstName,LastName,Phone, Email) VALUES(?,?,?,?,?)");
		//$stmt->bind_param("sssss", $userId, $FirstName, $LastName, $Phone, $Email);
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