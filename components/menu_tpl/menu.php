<div class="panel panel-default">
    <div class="panel-heading">
        <?php if (isset($category['children'])): ?>
            <li>

            <a style="color: #696763; font-family: 'Roboto', sans-serif; font-size: 14px; text-decoration: none; text-transform: uppercase; margin-left: -40px;"
               href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']])?>">
                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                <?= $category['name'] ?>
            </a>

        <?php else:?>
            <li>
                <a style="color: #696763;font-family: 'Roboto', sans-serif; font-size: 14px; text-decoration: none; text-transform: uppercase; margin-left: -40px;" href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']])?>"><?= $category['name'] ?></a>
            </li>
        <?php endif;?>

        <?php if (isset($category['children'])): ?>
            <ul>
                <?= $this->getMenuHtml($category['children'], true) ?>
            </ul>
            </li>
        <?php endif;?>
    </div>
</div>

