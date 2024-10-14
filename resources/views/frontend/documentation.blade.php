<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($setting->favicon) }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset($setting->favicon) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($setting->favicon) }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset($setting->favicon) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($setting->favicon) }}">
    <title>@yield('title') - {{ $setting->site_name }}</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">
    <title>Pickup Request API Documentation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        h2, h3 {
            margin-top: 20px;
        }
        p {
            margin-bottom: 10px;
        }
        code {
            background-color: #f8f8f8;
            padding: 2px 4px;
            border: 1px solid #ddd;
        }
        .response-example {
            background-color: #f8f8f8;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .d-flex{
            display: flex;
        }
        .justify-content-center{
            justify-content: center;
        }
        .img-thumb{
            width: 90px;
            height:auto;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center">
        <a href="{{route('home')}}"><img class="img-thumb" src="{{getThumbnail($setting->site_logo)}}"></a>
    </div>
    <hr>
    <h1>Pickup Request API Documentation</h1>

    <h2>Endpoint</h2>
    <p><strong>URL</strong>: <code>POST /pickup/request/submit</code></p>
    <p><strong>Description</strong>: Submit a pickup request for an order.</p>

    <h2>Authentication</h2>
    <p><strong>Required</strong>: Yes</p>
    <p><strong>Headers</strong>:</p>
    <pre><code>Authorization: Bearer YOUR_API_KEY
Content-Type: application/json</code></pre>

    <h2>Request Parameters</h2>
    <h3>api_keys (object, required): API authentication keys.</h3>
    <p>The API authentication keys required for accessing the service.</p>
    <ul>
        <li><code>merchant_id</code> (integer, required): Your merchant ID.</li>
        <li><code>public_key</code> (string, required): Your public key.</li>
        <li><code>secret_key</code> (string, required): Your secret key.</li>
        <li><code>redirect_url</code> (string, required): URL to redirect after request submission.</li>
    </ul>

    <h3>pickup_info (object, required): Pickup location information.</h3>
    <p>Details about the pickup location.</p>
    <ul>
        <li><code>pickup_name</code> (string, required): Individual/Company Name of the pickup location.</li>
        <li><code>pickup_contact_name</code> (string, required): Contact Name at the pickup location.</li>
        <li><code>pickup_address</code> (string, required): Address of the pickup location.</li>
        <li><code>pickup_street_address</code> (string, required): Street address of the pickup location.</li>
        <li><code>pickup_mobile</code> (string, required): Mobile number for the pickup contact.</li>
        <li><code>pickup_city</code> (string, required): City where pickup will take place.</li>
    </ul>

    <h3>delivery_info (object, required): Delivery location information.</h3>
    <p>Details about the delivery location.</p>
    <ul>
        <li><code>delivery_name</code> (string, required): Name of the recipient/Company at the delivery location.</li>
        <li><code>delivery_contact_name</code> (string, required): Contact name at the delivery location.</li>
        <li><code>delivery_address</code> (string, required): Address of the delivery location.</li>
        <li><code>delivery_mobile</code> (string, required): Mobile number for the delivery contact.</li>
        <li><code>delivery_city</code> (string, required): City where the delivery will be made.</li>
    </ul>

    <h3>product_info (object, required): Product information.</h3>
    <p>Details about the product and delivery.</p>
    <ul>
        <li><code>product_name</code> (string, required): Name of the product.</li>
        <li><code>quantity</code> (integer, required): Quantity of the product.</li>
        <li><code>weight</code> (integer, required): Weight of the product in KG and not more than {{ $weight }} KG.</li>
        <li><code>cod_amount</code> (integer, optional): Cash-on-delivery amount (if applicable).</li>
        <li><code>delivery_method</code> (string, required): Delivery method ({{ implode(', ',$delivery) }}).</li>
        <li><code>description</code> (string, required): Additional information about the request.</li>
    </ul>


    <h2>Finding Pickup and Delivery Cities</h2>
    <p>To find valid pickup and delivery cities, use the following API endpoint with a GET request:</p>
    <pre><code>GET /service-cities</code></pre>
    <p>This endpoint will provide a list of service cities that you can use when specifying <code>pickup_city</code> and <code>delivery_city</code> in your request.</p>

    <h2>Example Request with cURL</h2>
    <p>Here's an example of how to make a request using cURL:</p>
    <pre><code>curl -X POST -H "Authorization: Bearer YOUR_API_KEY" -H "Content-Type: application/json" -d '{
    "api_keys": {
        "merchant_id": 123,
        "public_key": "your_public_key",
        "secret_key": "your_secret_key",
        "redirect_url": "https://yourwebsite.com/redirect"
    },
    "pickup_info": {
        "pickup_name": "Indho Snacks Bar",
        "pickup_contact_name": "John Doe",
        "pickup_address": "123 Main St",
        "pickup_street_address": "Main Street",
        "pickup_mobile": "123-456-7890",
        "pickup_city": "City1"
    },
    "delivery_info": {
        "delivery_name": "Book",
        "delivery_contact_name": "Mokaddes Hosain",
        "delivery_address": "456 Elm St",
        "delivery_mobile": "01750-899448",
        "delivery_city": "City2"
    },
    "product_info": {
        "product_name": "Sample Product",
        "quantity": 10,
        "weight": 5,
        "cod_amount": 150,
        "delivery_method": "REGULAR",
        "description": "Urgent delivery required."
    }
}' https://dhereyedelivery.com/api/pickup/request/submit</code></pre>

    <h2>Response</h2>

    <h3>Success (HTTP Status 200)</h3>
    <pre class="response-example"><code>{
    "status": 1,
    "message": "Pickup request submitted successfully.",
    "data": {
        "pickup_request": {
            "tracking_number": "TRK12345"
        }
    }
}</code></pre>

    <h3>Validation Error (HTTP Status 400) <a href="https://dhereyedelivery.com/tracking">Tracking Delivery</a> </h3>
    <pre class="response-example"><code>{
    "status": 0,
    "message": "ValidationError",
    "data": {
        "error_message": "The given data was invalid."
    }
}</code></pre>

    <h3>Unauthorized (HTTP Status 401)</h3>
    <pre class="response-example"><code>{
    "status": 0,
    "message": "Error",
    "data": {
        "error_message": "Unauthorized"
    }
}</code></pre>

    <h3>Server Error (HTTP Status 500)</h3>
    <pre class="response-example"><code>{
    "status": 0,
    "message": "Error",
    "data": {
        "error_message": "Internal Server Error"
    }
}</code></pre>

    <h2>Conclusion</h2>
    <p>You can track your product with tracking id in url <a href="https://dhereyedelivery.com/tracking">https://dhereyedelivery.com/tracking</a>. This API allows you to submit pickup requests for orders efficiently. Make sure to provide valid and complete data in your requests to ensure successful pickup request submissions. If you encounter any issues or have questions, please contact our support team at <a href="mailto:support@example.com">support@example.com</a>.</p>
</div>
</body>
</html>
