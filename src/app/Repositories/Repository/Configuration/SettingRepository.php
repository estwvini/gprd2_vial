<?php

namespace App\Repositories\Repository\Configuration;

use App\Models\System\Setting;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\ModelException;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class SettingRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Setting::class;
    }

    /**
     * @param $key
     * @return mixed
     */
    function findByKey($key)
    {
        return $this->model->where('key', $key)->first();
    }

    /**
     * Update entity from array of data
     *
     * @param $value
     * @param $key
     * @return mixed
     */
    public function updateValueFromKey($value, $key)
    {
        $setting =  $this->model->where('key', $key)->first();
        $setting->value = $value;
        $setting->save();

        return $setting->fresh();
    }

    /**
     * Update entity from array of data
     *
     * @param array $data
     * @param null $entity
     * @return mixed
     * @throws ModelException
     */
    public function updateFromArray(array $data, $entity)
    {
        if (!$entity instanceof Model)
            throw new ModelException($this->model());

        $entity->key = $data['key'];

        $entity->description = $data['description'];

        $entity->value = json_decode($data['value'], true);

        $entity->save();

        return $entity->fresh();
    }

    /**
     * Update UI from array of data
     *
     * @param array $data
     * @param null $entity
     * @return mixed
     * @throws ModelException
     */
    public function updateUIFromArray(array $data, $entity)
    {
        if (!$entity instanceof Model)
            throw new ModelException($this->model());

        if ($entity->key == 'ui_menu_styles') {

            if (isset($data['color']))
                $value['color']  = $data['color'];

            if (isset($data['text_color']))
                $value['text_color']  = $data['text_color'];

            if (isset($data['active_color']))
                $value['active_color']  = $data['active_color'];

        } elseif ($entity->key == 'ui_project_labels') {

            if (isset($data['system_name']))
                $value['system_name']  = $data['system_name'];

            if (isset($data['system_slogan']))
                $value['system_slogan']  = $data['system_slogan'];

            if (isset($data['footer']))
                $value['footer']  = $data['footer'];

        } elseif ($entity->key == 'ui_logos') {

            $value = $entity->value;
            $path = env('IMAGES_PATH');

            if (isset($data['login_logo'])) {
                $logo = $data['login_logo'];

                $fileName = time() . '.' . $logo->getClientOriginalExtension();
                Image::make($logo->getRealPath())->resize(500, 500)->save($path . $fileName);

                $value['login_logo']  = 'images/images/' . $fileName;
            }

            if (isset($data['menu_logo'])) {
                $logo = $data['menu_logo'];

                $fileName = time() . '.' . $logo->getClientOriginalExtension();
                Image::make($logo->getRealPath())->resize(128, 128)->save($path . $fileName);

                $value['menu_logo']  = 'images/images/' . $fileName;
            }
        }

        $entity->value = $value;

        $entity->save();

        return $entity->fresh();
    }
}
