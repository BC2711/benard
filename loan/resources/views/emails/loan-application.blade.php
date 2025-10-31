<!-- resources/views/emails/loan-application.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>New Application</title>
</head>

<body>
    <h2>New Loan Application</h2>
    <p><strong>Name:</strong> {{ $data['fullname'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] ?? 'N/A' }}</p>
    <p><strong>Company:</strong> {{ $data['company'] ?? 'N/A' }}</p>
    <p><strong>Business Type:</strong> {{ ucwords(str_replace('-', ' ', $data['businessType'])) }}</p>
    <p><strong>Loan Amount:</strong> {{ strtoupper($data['loanAmount']) }}</p>
    <p><strong>Purpose:</strong> {{ ucwords(str_replace('-', ' ', $data['loanPurpose'])) }}</p>
    <p><strong>Message:</strong> {{ $data['message'] ?? 'None' }}</p>
</body>

</html>
