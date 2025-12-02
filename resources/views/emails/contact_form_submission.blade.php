<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        Website Enquiry
    </title>
</head>
<body>
    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <tr>
            <th align="left">Name</th>
            <td>{{ $data['name'] }}</td>
        </tr>
        <tr>
            <th align="left">Email</th>
            <td>{{ $data['email'] }}</td>
        </tr>
        <tr>
            <th align="left">Phone</th>
            <td>{{ $data['phone'] }}</td>
        </tr>
        <tr>
            <th align="left">Message</th>
            <td>{{ $data['message'] }}</td>
        </tr>
    </table>
</body>
</html>