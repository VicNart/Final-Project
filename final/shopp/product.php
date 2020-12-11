<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['PRODUCT_ID'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM product WHERE PRODUCT_ID = ?');
    $stmt->execute([$_GET['PRODUCT_ID']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist !');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>


<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="imgs/<?=$product['img']?>" width="500" height="500" alt="<?=$product['product_name']?>">
    <div>
        <h1 class="name"><?=$product['product_name']?></h1>
        <span class="price">
            &dollar;<?=$product['price_in_ghc']?>
            <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">&dollar;<?=$product['rrp']?></span>
            <?php endif; ?>
        </span>
        <form action="index.php?page=cart" method="POST">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['PRODUCT_ID']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product['desc']?>
        </div>
    </div>
</div>

<?=template_footer()?>