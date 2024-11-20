<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify - Product Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: lavender;
        }
        h1, h2 {
            font-family: Verdana, sans-serif;
        }
        .card {
            display: flex;
            flex-direction: row; /* Align content horizontally */
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            width: 80%; /* Lessen the width to 80% of the container */
            margin: 0 auto; /* Center the card horizontally */
        }
        .card-img-top {
            width: 100%; /* Image takes full width */
            max-width: 400px; /* Max width of the image */
            height: auto; /* Maintain aspect ratio */
            object-fit: cover;
            margin-right: 20px;
        }
        .card-body {
            flex-grow: 1; /* Allow body content to take remaining space */
        }
        .btn-group {
            margin-top: 20px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .card {
                flex-direction: column; /* Stack the image and body on smaller screens */
                text-align: center; /* Center text for better readability */
            }

            .card-img-top {
                margin-bottom: 20px; /* Add space below the image */
                max-width: 100%; /* Make sure the image fits in the screen */
            }

            .card-body {
                text-align: left; /* Align body text to the left on smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <!-- Image Section -->
            <img src="{{ $product->photo ? Storage::url($product->photo) : asset('images/placeholder.png') }}" 
                 alt="{{ $product->product_name }}" class="card-img-top">
            
            <!-- Product Details Section -->
            <div class="card-body">
                <h3><u>Product Details</u></h3>
                <h4>{{ $product->product_name }}</h4>
                <p><strong>Category:</strong> {{ $product->category }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> ₱{{ number_format($product->price, 2) }}</p>

                <div class="btn-group" role="group">
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm">Modify</a>

                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        &nbsp;&nbsp;<button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>

                    &nbsp;&nbsp;&nbsp;<a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
