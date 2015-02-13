<?php
$presenter = new Baileylo\BlogApp\Pagination\Presenter\FullPresenter($paginator);
?>

<?php if ($paginator->hasPages()): ?>
    <ul class="pagination">
        <?php echo $presenter->render(); ?>
    </ul>
<?php endif; ?>
