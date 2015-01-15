<?php
$presenter = new Baileylo\BlogApp\Pagination\Presenter\Presenter($paginator);
$trans = $environment->getTranslator();
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <div class="row">
        <div class="columns large-6">
            <?= $presenter->getPrevious($trans->trans('pagination.previous-homepage')); ?>
        </div>
        <div class="columns large-6 text-right">
            <?= $presenter->getNext($trans->trans('pagination.next-homepage')); ?>
        </div>
    </div>
<?php endif; ?>
