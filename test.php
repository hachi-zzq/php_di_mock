<?php
/**
 * Created by PhpStorm.
 * DateTime: 2018/9/13 22:15.
 *
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */
class User
{
    public function getIndex($field, $count, DataAdapter $dataAdapter)
    {
        return $dataAdapter->get();
    }
}

class DataAdapter
{
    public function get()
    {
        return 'user index';
    }
}

class App
{
    public static function run($instance, $method, $params = [])
    {
        if (!method_exists($instance, $method)) {
            throw new \Exception('');
        }

        $reflector = new ReflectionMethod($instance, $method);

        $newParams = [];

        foreach ($reflector->getParameters() as $key => $value) {
            $class = $value->getClass();

            if ($class) {
                $name = $class->getName();
                array_push($newParams, new $name());
            } else {
                if (count($params) > 0) {
                    $param = array_shift($params);
                } else {
                    throw new \Exception('error');
                }
                array_push($newParams, $param);
            }
        }

        echo call_user_func_array([$instance, $method], $newParams);
    }
}

App::run(new User(), 'getIndex', [12, 11]);
