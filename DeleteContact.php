
<?php

	$inData = getRequestInfo();
	
	$id = $inData["id"];
	$userId = $inData["userId"];

	$conn = new mysqli("localhost", "root", "Current-Root-Password", "COP4331"); 	
	if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$stmt = $conn->prepare("DELETE FROM Contacts WHERE id=? AND userId=?");
		$stmt->bind_param("ii", $id, $userId);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		returnWithError("Contact Deleted");
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
