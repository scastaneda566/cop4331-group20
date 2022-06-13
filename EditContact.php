<?php
	$inData = getRequestInfo();
	$userId = $inData["userId"];
	
	$Name = $inData["newName"];
	$Phone = $inData["newPhone"];
	$Email = $inData["newEmail"];

	$conn = new mysqli("localhost", "root", "Current-Root-Password", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("UPDATE Contacts ID SET Name = ?, Phone = ?, Email = ? WHERE ID = ? AND UserID = ?");
		$stmt->bind_param("sssii", $Name, $Phone, $Email, $inData["ID"], $userId);
		
		$stmt->execute();
		$stmt->close();
		$conn->close();
		returnWithError("Contact Edited");
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