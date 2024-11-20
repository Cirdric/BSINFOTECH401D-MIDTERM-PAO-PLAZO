<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify - Modify Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: lavender;
        }
        h4 {
            font-family: Verdana, sans-serif;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            font-size: 1rem;
            padding: 12px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .current-photo {
            text-align: center;
            margin: 20px 0;
        }
        .current-photo img {
            max-width: 200px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
        }
        .button-group {
            display: flex;
            justify-content: space-between; 
            gap: 10px; 
            margin-top: 20px;
        }
        .btn {
            padding: 12px;
            font-size: 1.1rem;
            width: 48%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4 class="text-center mb-4">Modify Product Details</h4>

        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="product_name">Name</label>
                    <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="category">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $product->category) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-12">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required min="1">
                </div>
                <div class="form-group col-md-6">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <label for="current_photo" class="d-block font-weight-bold mb-2">Current Photo</label>
                    <div class="current-photo-wrapper">
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="Current Product Photo" class="img-fluid rounded shadow-sm" style="max-width: 250px; height: auto; border: 2px solid #ddd;">
                    </div>
                </div>
            </div>

            <div class="button-group">
                <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>
