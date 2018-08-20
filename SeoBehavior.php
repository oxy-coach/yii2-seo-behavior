<?php
namespace oxycoach\seobehavior;

use Yii;
use \yii\db\ActiveRecord;
use yii\base\Behavior;

class SeoBehavior extends Behavior
{

    public $nameAttribute;
    public $slugAttribute = null;
    public $transliterationFunction = 'oxycoach\seobehavior\TranslitHelper::createSlug';
    public $seoAttributes = [];

    /**
     * Events
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
        ];
    }

    /**
     * Invoked before updating
     */
    public function beforeUpdate()
    {
        $this->checkSeoAttributes();
    }

    /**
     * Invoked before inserting data to db
     */
    public function beforeInsert()
    {
        $this->checkSeoAttributes();
    }

    /**
     * Slug and seo attributes generating
     */
    private function checkSeoAttributes()
    {
        $model = $this->owner;
        $transliterationFunction = $this->transliterationFunction;

        // if slug field is empty, filling one with generated slug
        if ($slugAttribute && $model->{$this->slugAttribute} == null) {
            $model->{$this->slugAttribute} = $transliterationFunction($model->{$this->nameAttribute});
        }

        // if some seo field is empty, filling it with name field data
        foreach ($this->seoAttributes as $seoAttribute) {
            if ($model->{$seoAttribute} == null){
                $model->{$seoAttribute} = $model->{$this->nameAttribute};
            }
        }
    }
}
