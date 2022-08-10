<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Membership Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<form name="applyForm" method="post" enctype="multipart/form-data" onsubmit="return form_check(this)" action="form_send.php">
		<input type="hidden" name="mode" value="send">

		<h2 class="text-center" style="padding:30px;"><b>Membership Form</b></h2>

		<div class="mb-4">
			<label for="firstName" class="form-label">First Name *</label>
			<input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required="required">
		</div>

		<div class="mb-4">
			<label for="lastName" class="form-label">Last Name *</label>
			<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required="required">
		</div>

		<div class="mb-4">
			<label for="phoneNumber" class="form-label">Phone Number</label>
			<input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number">
		</div>

		<div class="mb-4">
			<label for="emailAddress" class="form-label">Email Address</label>
			<input type="text" class="form-control" id="emailAddress" name="emailAddress" placeholder="Enter your email address">
		</div>

		<div class="mb-4">
			<label for="Address" class="form-label">Address</label>
			<input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
		</div>

		<div class="mb-4">
			<label for="applyFile" class="form-label">한인회 신청서 파일</label>
			<input type="file" class="form-control" id="applyFile" name="applyFile1" placeholder="Select a file">
		</div>

		<div class="mb-4">
			<label for="emailAddress" class="form-label">Your Signature *</label>
			<canvas style="border:1px solid #aaa"></canvas><br>
			<span onclick="signaturePad.clear();">Clear</span>
			<input type="hidden" id="signImage" name="signImage" value="">
		</div>

		<div class="mb-4">
			<center><button type="submit" class="btn btn-primary">신청서 제출</button></center>
		</div>

		&nbsp;<br>

	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

	<script>
		const canvas = document.querySelector("canvas");
		const signaturePad = new SignaturePad(canvas);
		signaturePad.clear();

		function form_check(frm) {
			if(signaturePad.isEmpty()) {
				alert("Enter your signature");
				return false;
			} else {
				var signData = signaturePad.toDataURL();
				$("#signImage").val(signData);
			}

			if(!confirm('Would you like to submit the membership form ?')) return;
			applyForm.submit();
		}
	</script>
</body>
</html>