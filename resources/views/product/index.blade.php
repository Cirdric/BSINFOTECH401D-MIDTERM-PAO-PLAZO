<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify | Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: lavender;
        }
        h2, h3 {
            font-family: verdana;
        }
        .card {
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-height: 350px; 
        }

        .card-title {
            font-weight: bold;
        }

        .card-text {
            font-size: 0.9rem;
            max-height: 70px;
            overflow: hidden; 
            text-overflow: ellipsis; 
            white-space: nowrap; 
        }

        .card img {
            max-height: 200px;
            object-fit: cover;
        }

        .blurred {
            filter: blur(5px);
            pointer-events: none; 
        }
        .action-buttons {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .action-buttons button,
        .action-buttons a {
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- <h2 class="mb-4 text-center">Shopify - Your Everyday Needs</h2> -->
        <h3 class="mb-4 text-center">List of Products | ADMIN PANEL</h3> 
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('product.create') }}" class="btn btn-light">+ New Product</a>
        </div>

        <?php if (session('success')): ?>
            <div class="alert alert-success"><?= htmlspecialchars(session('success')) ?></div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($product as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <img src="{{ $product->photo ? Storage::url($product->photo) : asset('images/placeholder.png') }}" 
                                 alt="{{ $product->product_name }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product->product_name) ?></h5>
                                <p class="card-text">
                                    <strong>Category:</strong> <?= htmlspecialchars($product->category) ?><br>
                                    <strong>Price:</strong> ₱{{ number_format($product->price, 2) }}<br>
                                    <?= htmlspecialchars($product->description) ?>
                                </p>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm">Modify</a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.card').forEach(function(card) {
                card.addEventListener('click', function() {
                    const cardContent = this.querySelector('.card-content');
                    const actionButtons = this.querySelector('.action-buttons');

                    if (actionButtons.style.display === 'none' || actionButtons.style.display === '') {
                        cardContent.classList.add('blurred'); 
                        actionButtons.style.display = 'flex'; 
                    } else {
                        cardContent.classList.remove('blurred'); 
                        actionButtons.style.display = 'none'; 
                    }
                });
            });
        });
    </script>
</body>
</html>
