<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('private/download/{hash}/{num}/{name}.download', function ($hash, $num, $name) {
    $default_path = '/ac60e92a11e14ff3c3b1b161768a8d11f0b74413/6c8e6c9c47286b1e409706ddffc485a9/173edc42';
    $hashTable = [
        '9b42b6dc8fe4bcf0c44e89f52bf214f41ebddce7' => $default_path.'/drawn',
        '32ee117b4abfed8750c1f2ded8af243141ec371e' => $default_path.'/ps',
        'ad8798bc01b920e86156214f5641a41dcd2a4845' => $default_path.'/private',
        '9755fbd901d7db59bfdfe540a7dfd7785e18f0ef' => $default_path.'/minecraft',
        '5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107' => $default_path.'/pack',
        'd813f39e4b7c133bbc7687abe3933db92c8ef979' => $default_path.'/preview',
        '62cc4a3a5688853b88e13d1a32f9daeff809aa5b' => $default_path.'/styles'
    ];
    if (isset($_GET['token']) && isset($_GET['hash']) && isset($_GET['id'])) {
        $token = $_GET['token'];
        $user = DB::table('users')->where('token', $token)->first();
        $id = $_GET['id'];
        $createdLink = 'https://'.$_SERVER['HTTP_HOST'].strtok($_SERVER['REQUEST_URI'], '?');
        if (isset($user->id)) {
            $query = DB::table('caseitems')->where(['id' => $id])->first();
            if (isset($query->id)) {
                $query2 = DB::table('casewins')->where(['uid' => $user->id, 'cid' => $query->cid])->first();
                if (isset($query2->id)) {
                        if (isset($hashTable[$hash])) {
                            $downloadPath = $hashTable[$hash].'/'.$name.'.rar';
                            $file = $_SERVER['DOCUMENT_ROOT'].$downloadPath;
                            if (!file_exists($file)) {
                                $downloadPath = $hashTable[$hash].'/'.$name.'.zip';
                                $file = $_SERVER['DOCUMENT_ROOT'].$downloadPath;
                            }
                            if (file_exists($file)) {
                                header('Content-Description: File Transfer');
                                header('Content-Type: application/octet-stream');
                                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                                header('Expires: 0');
                                header('Cache-Control: must-revalidate');
                                header('Pragma: public');
                                header('Content-Length: ' . filesize($file));
                                readfile($file);
                                exit;
                            } else {
                                return json_encode(['error' => 'Такого файла не существует!']);
                            }
                        } else {
                            return json_encode(['error' => 5]);
                        }
                } else {
                    return json_encode(['error' => 'Ошибка #3: Вы не выигрывали эту вещь. Если вы считаете, что это ошибка, то сообщите нам о ней.']);
                }
            } else {
                return json_encode(['error' => 'Ошибка #2: Вещь не найдена. Если вы считаете, что это ошибка, то сообщите нам о ней.']);
            }
        } else {
            return json_encode(['error' => 'Ошибка #1: Игрок не найден. Если вы считаете, что это ошибка, то сообщите нам о ней.']);
        }
    } else {
        return json_encode(['error' => 'Ошибка #0: Пустые данные. Если вы считаете, что это ошибка, то сообщите нам о ней.']);
    }
});