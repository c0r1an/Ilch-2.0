<?php
$cats = $this->get('cats');
$articleMapper = new \Modules\Article\Mappers\Article();
?>

<?php if ($cats != ''): ?>
    <ul class="list-group">
        <?php foreach($cats as $cat): ?>
            <li class="list-group-item">
                <span class="badge"><?=count($articleMapper->getArticlesByCats($cat->getId())) ?></span>
                <a href="<?=$this->getUrl(array('controller' => 'cats', 'action' => 'show', 'id' => $cat->getId()))?>"><?=$cat->getName() ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <?=$this->getTrans('noCats') ?>
<?php endif; ?>