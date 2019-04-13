<?php
/**
 * Created by PhpStorm.
 * User: bohdan
 * Date: 02.04.2019
 * Time: 16:44
 */
namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Category;

class MenuWidget extends Widget
{
    public $tpl;
    public $data;
    public $tree;
    public $menuHTML;

    public function init()
    {
        parent::init();

        if ($this->tpl === null) {
            $this->tpl = 'menu';
        }

        $this->tpl .= '.php ';
    }

    public function run()
    {
        // get cache
        $menu = Yii::$app->cache->get('menu');
        if ($menu) return $menu;

        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHTML = $this->WrapTemplate($this->getMenuHtml($this->tree));

        // set cache
        Yii::$app->cache->set('menu', $this->menuHTML, 60);

        return $this->menuHTML;
    }

    protected function getTree()
    {
        $tree = [];

        foreach ($this->data as $id=>&$node) {

            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $this->data[$node['parent_id']]['children'][$node['id']] = &$node;
            }
        }

        return $tree;
    }

    protected function getMenuHtml($tree, $onlyHref = false)
    {
        $str = '';

        if ($onlyHref == true) {
            foreach ($tree as $category) {
                $str .= $this->MenuHrefTemplate($category);
            }
        }

        if ($onlyHref == false) {
            foreach ($tree as $category) {
                $str .= $this->MenuTemplate($category);
            }
        }

        return $str;
    }

    protected function MenuHrefTemplate($category)
    {
        ob_start();
        include __DIR__ . '/menu_tpl/' . 'href_template.php';

        return ob_get_clean();
    }

    protected function MenuTemplate($category)
    {
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;

        return ob_get_clean();
    }

    protected function WrapTemplate($template)
    {
        ob_start();
        include __DIR__ . '/menu_tpl/' . 'menu_wrap.php';

        return ob_get_clean();
    }
}