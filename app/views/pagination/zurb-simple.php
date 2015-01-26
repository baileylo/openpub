<?php
$presenter = new Baileylo\BlogApp\Pagination\Presenter\Presenter($paginator);
$trans = $environment->getTranslator();
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <div class="row hidden-for-small-down">
        <div class="columns large-6 medium-6">
            <?= $presenter->getPrevious($trans->trans('pagination.previous-homepage')); ?>
        </div>
        <div class="columns large-6 medium-6 text-right">
            <?= $presenter->getNext($trans->trans('pagination.next-homepage')); ?>
        </div>
    </div>
    <div class="row visible-for-small-down">
        <div class="columns small-6">
            <?= $presenter->getPrevious($trans->trans('pagination.previous-homepage'), 'button expand'); ?>
        </div>
        <div class="columns small-6">
            <?= $presenter->getNext($trans->trans('pagination.next-homepage'), 'button expand'); ?>
        </div>
    </div>
<?php endif; ?>
