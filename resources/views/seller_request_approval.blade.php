<!DOCTYPE html>
<html>
<head>
    <title>New Affiliate Application</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            text-align: left;
            background-color: #f4f4f4;
            width: 30%;
        }
    </style>
</head>
<body>
    <h2>New Affiliate Application Received</h2>
    <p>A new affiliate application has been submitted. Here are the details:</p>

    <table>
        <tr><th>First Name</th><td>{{ $first_name ?? '-' }}</td></tr>
        <tr><th>Last Name</th><td>{{ $last_name ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $email ?? '-' }}</td></tr>
        <tr><th>Company/Blog/Brand</th><td>{{ $company_name ?? '-' }}</td></tr>
        <tr><th>Phone</th><td>{{ $phone ?? '-' }}</td></tr>
        <tr><th>Address</th><td>{{ $address ?? '-' }}</td></tr>
        <tr><th>Zip Code</th><td>{{ $zip ?? '-' }}</td></tr>
        <tr><th>Country</th><td>{{ $country ?? '-' }}</td></tr>

        {{-- 🔹 Yeh wala part Affiliate Experience ke liye --}}
        <tr><th>Previous Affiliate Marketing Experience</th>
            <td>{{ $affiliate_experience ?? '-' }}</td>
        </tr>
        <tr><th>Experience Details (Years)</th>
            <td>{{ $experience_details1 ?? '-' }}</td>
        </tr>
        <tr><th>Experience Details (Products)</th>
            <td>{{ $experience_details2 ?? '-' }}</td>
        </tr>

        <tr><th>Why Join</th><td>{{ $why_join ?? '-' }}</td></tr>

        <tr><th>Social Media</th>
            <td>
                @if(!empty($social_media))
                    {{ is_array($social_media) ? implode(', ', $social_media) : $social_media }}
                @else
                    -
                @endif
            </td>
        </tr>

        <tr><th>Competing Brands</th><td>{{ $competing_brands ?? '-' }}</td></tr>
        <tr><th>Heard About Us</th><td>{{ $hear_about ?? '-' }}</td></tr>
        <tr><th>Payment Method</th><td>{{ $payment_method ?? '-' }}</td></tr>
        <tr><th>About Yourself</th><td>{{ $about_yourself ?? '-' }}</td></tr>
        <tr><th>Signature</th><td>{{ $signature ?? '-' }}</td></tr>
        <tr><th>Application Date</th><td>{{ $application_date ?? '-' }}</td></tr>
    </table>
</body>
</html>
