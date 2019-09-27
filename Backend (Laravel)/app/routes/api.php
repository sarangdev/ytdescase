<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Basic;
use Pusher as Pusher;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('test3905jw39tesng/checkwins', function () {
    $res = DB::table('casewins')->get();
    foreach ($res as $index => $value) {
        $item = DB::table('caseitems')->where('id', $value->itemid)->first();
        if (!isset($item->id)) {
            DB::delete('delete from casewins where id = ?', [$value->id]);
        }
    }
});

Route::post('getcases', function () {
    $db = DB::table('cases')->where('enabled', 1)->orderby('amount', 'desc')->get();
    $design = [];
    $accounts = [];
    $free = [];
    $partners = [];
    $fc = [];
    foreach ($db as $item) {
        if ($item->cat == 1) {
            $design[] = $item;
        }
        if ($item->cat == 2) {
            $accounts[] = $item;
        }
        if ($item->cat == 3) {
            $free[] = $item;
        }
        if ($item->cat == 4) {
            $partners[] = $item;
        }
        if ($item->cat == 5) {
            $fc[] = $item;
        }
    }
    DB::disconnect();
    return json_encode(['design' => $design, 'accounts' => $accounts, 'free' => $free, 'partners' => $partners, 'fc' => $fc]);
});

Route::post('getcase/{id}/{open}', function ($id, $open = false) {
    if ($open == 'true') {
        if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
            die(json_encode(['error' => 'Token error!']));
        } else {
            $user = $_SERVER['HTTP_X_TOKEN'];
        }
    }
        
    $id = (int)$id;
    $db = DB::table('cases')->where('id', $id)->first();
    if (!is_null($db)) {
        $caseItems = DB::table('caseitems')->select('id', 'cid', 'title', 'img', 'chance', 'amount')->orderBy('amount', 'desc')->where('cid', $id)->get();
        $db->items = $caseItems;
        DB::disconnect();
        return json_encode($db);
    } else {
        return json_encode(['error' => 'Case not found']);
    }
});

Route::post('getlastopened/{id}', function ($id) {
    $id = (int)$id;
    $db = DB::table('lastwins')->where('cid', $id)->orderBy('id')->limit(3)->get();
    $all = [];
    foreach($db as $index => $win) {
        $user = DB::table('users')->where('id', $win->uid)->first();
        $item = DB::table('caseitems')->select('id', 'cid', 'title', 'img', 'chance', 'amount')->where(['cid' => $win->cid, 'id' => $win->win])->first();
        $case = DB::table('cases')->where(['id' => $id])->first();
        DB::disconnect();
       array_push($all, [ 'params' => $win, 'user' => [ 'username' => $user->id ], 'case' => $case, 'item' => $item ]);
    }
    return $all;
});

Route::post('r/genRandomItemByCaseId/{id}', function ($id) {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    // Генерируем рандомный предмет из кейса, снимаем мани и выдаем
    $id = (int)$id; // Так, на всякий.
    if (isset($user) && $id != null):
        $user = DB::table('users')->where('token', $user)->first(); // Получем экземлпяр юзера из базы
        $query1 = DB::table('buyedcases')->where(['uid' => $user->id, 'cid' => $id])->limit(1)->first();
        if (!isset($query1->id))
            return json_encode(['error' => 'У вас нет ключа!']);
        function getItem($data) {
            $randArray = array();
          
            foreach ($data as $value) {
              for ($i = 0; $i < $value->chance; $i++) { 
                $randArray[] = $value;
              }
            }
            return $randArray[mt_rand(0, count($randArray) - 1)];
        }
        $case = DB::table('cases')->where('id', $id)->first(); // Получаем экземпляр кейса из базы
        $caseItems = DB::table('caseitems')->select('id', 'cid', 'title', 'img', 'chance', 'amount')->where('cid', $id)->get(); // Получаем экземлпяр всех вещей из кейса

        // ADD CUSTOM RANDOM
        $items = [ getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems), 
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems),getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems), 
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems),getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems), 
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems), getItem($caseItems), getItem($caseItems), getItem($caseItems),
        getItem($caseItems),getItem($caseItems) ];
        $count = count($items);
        $rr = array_rand($items);
        $winElem = $items[$rr];
        $widthOneElement = 122; // width one case element in pixels
        $offset = 0 - ($widthOneElement*$rr-270);


        DB::insert('insert into lastwins (cid, win, uid) values (?, ?, ?)', [$id, $winElem->id, $user->id]);
        DB::delete('delete from buyedcases where id = ?', [$query1->id]);
        DB::disconnect();
        if ($case->amount == 0) {
            Cache::put($user->id.'_'.$case->id.'_free_avail', json_encode([ 'res' => false, 'time' => time() ]), 86400);
        }
        return json_encode(['res' => $winElem, 'items' => $items, 'offset' => $offset, 'message' => 'Вы выиграли "'.$winElem->title.'" из кейса "'.$case->title.'"!']);
    else:
        return json_encode(['error' => 'Ошибка #53539. Сообщите администратору']);
    endif;
});

Route::post('r/acceptItem', function () {
        if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
            die(json_encode(['error' => 'Token error!']));
        } else {
            $user = $_SERVER['HTTP_X_TOKEN'];
        }

    $db = DB::table('users')->where('token', $user)->first();
    if (isset($_POST['data'])) {
        $data = json_decode(base64_decode($_POST['data']));
        $item = DB::table('caseitems')->where('id', $data->id)->first();
        if (isset($data->id) && isset($item->id)) {
            // $last = json_decode(Cache::get($db->id.'_lastCaseItem'));
                DB::insert('insert into casewins (uid, cid, itemid) values (?, ?, ?)', [$db->id, $item->cid, $item->id]);
            //    Cache::forget($db->id.'_lastCaseItem');
                return ['result' => 'ok'];
        } else {
            return json_encode(['error' => 'Ошибка #34883. Сообщите администратору']);
        }
    } else {
        return json_encode(['error' => 'Ошибка #348483. Сообщите администратору']);
    }
});

Route::post('r/soldItem/{cid}/{itemid}', function ($cid, $itemid) {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    $cid = (int)$cid;
    $itemid = (int)$itemid;
    if (isset($_POST['data'])) {
        $data = json_decode(base64_decode($_POST['data']));
        // $last = json_decode(Cache::get($user->id.'_lastCaseItem'));
        if (isset($data->id) && $data->id == $itemid) {
            $case = DB::table('cases')->where('id', $cid)->first();
            $caseitem = DB::table('caseitems')->where('id', $itemid)->first();
            $user = DB::table('users')->where('token', $user)->first();
            // $casewin = DB::table('casewins')->where(['cid' => $cid, 'itemid' => $itemid, 'uid' => $user->id])->first();
            $lastwins = DB::table('lastwins')->where(['cid' => $cid, 'win' => $itemid, 'uid' => $user->id])->first();
            // DB::delete('delete from casewins where id = ?', [$casewin->id]);
            DB::update('update users set balance = ? where id = ?', [$user->balance+$caseitem->amount, $user->id]);
            DB::disconnect();
            return json_encode(['result' => true, 'bal' => $user->balance+$caseitem->amount, 'message' => 'Вы успешно продали "'.$caseitem->title.'" за '.$caseitem->amount.' руб!']);
        } else {
            DB::disconnect();
            return json_encode(['error' => 'Вы не выигрывали эту вещь!']);
        }
    } else {
        return json_encode(['error' => 'Data error']);
    }
});

Route::post('login', function () {
    $email = strip_tags(trim($_POST['email']));
    $pass = $_POST['password'];
    $notifyText = 'Вы успешно вошли в аккаунт';
    if ($email != null || $pass != null) {
        $pass = hash('sha256', $pass); // Зашифрованная строка
        $query = DB::table('users')->where(['email' => $email, 'token' => $pass])->first();
        if (isset($query->id)) {
            // Аккаунт существует, данные совпадают
            if (DB::update('update users set last_ip = ?, lastLogin_date = ? where id = ?', [$_SERVER['REMOTE_ADDR'], date('Y-m-d H:i:s'), $query->id])) {
                DB::disconnect();
                return json_encode(['token' => $query->token, 'message' => $notifyText]);
            } else {
                return json_encode(['error' => 'Ошибка обновления данных!']);
            }
        } else {
            return json_encode(['error' => 'Неверный логин или пароль!']);
        }
    } else {
        return json_encode(['error' => 'Поля не могут быть пустыми!']);
    }
    return json_encode(['token' => 'aefqwege90jwhg9je']);
});

Route::post('socialLogin', function () {
    $notifyText = 'Вы успешно вошли в аккаунт';
    $notifyText1 = 'Вы успешно создали аккаунт';
    $app_id = 7035278;
    $secret_key = 'KEY';
    $data = json_decode(file_get_contents('php://input'));
    if (isset($data->sid)/* && isset($data->recaptcha)*/) {
            $uid = $data->mid;
            $fname = strip_tags(trim($data->user->first_name));
            $lname = strip_tags(trim($data->user->last_name));
            $avatar = null;
            $ip = getIp();
            $date = date('Y-m-d H:i:s');
        /*    $recaptcha = $data->recaptcha;
            // Проверка капчи
            
            $array = array(
                'secret'   => '6Ley5qoUAAAAAP__OYGE8VVWnCplfA_J5noUbTAv',
                'response' => $recaptcha
            );
            
            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $array); 
            
            // Или предать массив строкой: 
            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $captcha = json_decode(curl_exec($ch));
            curl_close($ch);    */
        //    if ($captcha->score <= 0.5) {
        //        return json_encode(['error' => 'Запрос не прошёл проверку.']);
        //    } else {   
            // Сборка хэша
            $hash = $data->secret; // Полученный

            // Собираем кастомный хэш
            $createdHash = sha1('(UID:'.(int)$data->mid.';TIME='.(int)$data->expire.';SECRET='.sha1($secret_key).';APPID='.$app_id.')');

            if ($hash == $createdHash) { // всё окей
                $socialToken = hash('sha256', $uid.md5($uid).sha1($uid).$uid); // Собираем токен
                $query = DB::table('users')->where(['email' => $uid, 'token' => $socialToken])->first();
                if (isset($query->id)) { // Такой юзер есть, входим
                    if (DB::update('update users set last_ip = ?, lastLogin_date = ?, fname = ?, lname = ? where id = ?', [getIp(), date('Y-m-d H:i:s'), $fname, $lname, $query->id])) {
                        DB::disconnect();
                        return json_encode(['token' => $socialToken, 'message' => $notifyText]);
                    } else {
                        return json_encode(['error' => 'Ошибка обновления данных!']);
                    }
                } else { // Такого юзера нет, создаем
                    $insert = DB::table('users')->insertGetId(['email' => $uid, 'last_ip' => $ip, 'token' => $socialToken, 'lastLogin_date' => $date, 'fname' => $fname, 'lname' => $lname, 'regdate' => date('d.m.Y H:i:s')]);
                    if ($insert) {
                        DB::disconnect();
                        return json_encode(['token' => $socialToken]);
                    } else {
                        return json_encode(['error' => 'Ошибка сохранения данных']);
                    }
                }
            } else { // ничего не окей
                return json_encode(['error' => 'Ошибка токена']);
            }
        //    }
    } else {
        return json_encode(['error' => 'Ошибка данных']);
    }
});
function getIp() {
    $ipaddress = '';
    if (isset($_SERVER['X_HTTP_REAL_IP']))
        $ipaddress = $_SERVER['X_HTTP_REAL_IP'];
    else if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function checkFaking ($user)
{
    $payments = DB::table('payments')->where('uid', $user->id)->get();
    if ($user->balance > 10000 && count($payments) < 2) {
    //  DB::update('update users set balance = 300 where id = ?', [$user->id]);
        return true;
    } else {
        return false;
    }
}

Route::post('getuserdata', function () {
    
    $ip = getIp();
    $onl = json_decode(Cache::get('onlineList'), false);
    if ($onl == null) {
        Cache::put('onlineList', json_encode([$ip]), 120);
    } else if (!in_array($ip, $onl)) {
        array_push($onl, $ip);
        Cache::put('onlineList', json_encode($onl), 120);
    }
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    $db = DB::table('users')->where('token', $user)->first();


    $items = DB::table('casewins')->where('uid', $db->id)->get();
    $item = [];
    foreach ($items as $index => $value) {
        array_push($item, [ 'winid' => $value->id, 'case' => DB::table('cases')->where('id', $value->cid)->first(), 'item' => DB::table('caseitems')->select('id', 'resUrl', 'cid', 'title', 'img', 'chance', 'amount')->where('id', $value->itemid)->first(), 'date' => $value->date ]);
    }
    DB::disconnect();
    $db->wins = $item;
    return json_encode($db);
});

Route::post('adminka/3e85s9aa24/checkWin', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    $db = DB::table('users')->where('token', $user)->first();
    if (isset($db->id) && $db->admin == 1 && isset($_POST['uid']) && isset($_POST['cid']) && isset($_POST['itemid'])) {
        $uid = (int)$_POST['uid'];
        $cid = (int)$_POST['cid'];
        $itemid = (int)$_POST['itemid'];
        $res = DB::table('users')->where('id', $uid)->first();
        if (isset($res->id)) {
            $win = DB::table('casewins')->where('uid', $uid)->where('cid', $cid)->where('itemid', $itemid)->first();
            if (isset($win->id)) {
                return ['error' => '<span style="color: #56fb42;">Этот игрок выиграл эту вещь!</span>'];
            } else {
                return ['error' => '<span style="color: #ff6c6c;">Нет выигрыша!</span>'];
            }
        } else {
            return ['error' => '<span style="color: #ff6c6c;">Игрок не найден!</span>'];
        }
    } else {
        return ['error' => '<span style="color: #ff6c6c;">You are not admin!</span>'];
    }
});

Route::post('adminka/3e85s9aa24/getItem', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    $db = DB::table('users')->where('token', $user)->first();
    if (isset($db->id) && $db->admin == 1 && isset($_POST['itemid'])) {
        $itemid = (int)$_POST['itemid'];
        $res = DB::table('caseitems')->where('id', $itemid)->first();
        if (isset($res->id)) {
            $case = DB::table('cases')->where('id', $res->cid)->first();
            if (isset($case->id)) {
                return json_encode(['result' => 'Вещь: '.$res->title.'<br>
                                    Кейс: '.$case->title.'<br>
                                    ID кейса: '.$case->id.'<br>
                                    Стоимость кейса: '.$case->amount.'₽<br>
                                    Стоимость вещи: '.$res->amount.'₽']);
            }
        }
    }
});

Route::post('adminka/3e85s9aa24/getUserInfo', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    $db = DB::table('users')->where('token', $user)->first();
    if (isset($db->id) && $db->admin == 1 && isset($_POST['uid'])) {
        $uid = (int)$_POST['uid'];
        $res = DB::table('users')->where('id', $uid)->first();
        if (isset($res->id)) {
            $payments = count(DB::table('payments')->where('uid', $uid)->get());
            $cases = count(DB::table('lastwins')->where('uid', $uid)->get());
            $ifAdmin = ($res->admin == 1) ? "Да" : "Нет";
                return json_encode(['result' => 'ID игрока: '.$uid.'<br>
                                    Имя Фамилия: '.$res->fname.' '.$res->lname.'<br>
                                    IP: '.$res->last_ip.'<br>
                                    Дата регистрации: '.$res->regdate.'<br>
                                    Платежей совершено: '.$payments.'<br>
                                    Кейсов открыто: '.$cases.'<br>
                                    Дата последней авторизации: '.$res->lastLogin_date.'<br>
                                    Баланс: '.$res->balance.'₽<br>
                                    Является админом: '.$ifAdmin.'<br>
                                    Привилегия: '.$res->priv.' (0 - нет, 1 - вип, 2 - премиум, 3 - лайн)<br>
                                    ВК: <a href="https://vk.com/id'.$res->email.'" target="_blank">'.$res->email.' (клик)</a><br>']);
        }
    }
});


Route::post('adminka/3e85s9aa24/giveMoney', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    $db = DB::table('users')->where('token', $user)->first();
    if (isset($db->id) && $db->admin == 1 && isset($_POST['uid']) && isset($_POST['bal'])) {
        $uid = (int)$_POST['uid'];
        $bal = (int)$_POST['bal'];
        $res = DB::table('users')->where('id', $uid)->first();
        if (isset($res->id)) {
            if (DB::update('update users set balance = ? where id = ?', [$res->balance+$bal, $res->id])) {
                return ['error' => '<span style="color: #56fb42;">Деньги успешно выданы!</span>'];
            } else {
                return ['error' => '<span style="color: #ff6c6c;">Ошибка выдачи!</span>'];
            }
        } else {
            return ['error' => '<span style="color: #ff6c6c;">Игрок не найден!</span>'];
        }
    } else {
        return ['error' => '<span style="color: #ff6c6c;">You are not admin!</span>'];
    }
});

Route::post('getResAccount', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    $db = DB::table('users')->where('token', $user)->first();
    $id = (int)$_POST['winid'];
    $win = DB::table('casewins')->where('id', $id)->where('uid', $db->id)->first();
    $res = DB::table('caseitems')->where('cid', $win->cid)->where('id', $win->itemid)->first();
    if (isset($win->id) && isset($res->id)) {
        if ($win->data != null) {
            return [ 'result' => $win->data ];
        } else {
            if ($res->resUrl == 'mcmail') {
                // get account
                $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/app/storage/userdata/mcmail.dat');
                $file = explode("\n", $file);
                $arr = [];
                foreach ($file as $i => $v) {
                    if ($v != '' && $v != "\n") {
                        $v1 = explode(' ', $v);
                        if (isset($v1[1]) && isset($v1[2])):
                            $arr[] = 'Ник: '.$v1[0]."<br>Почта: ".$v1[1]."<br>Пароль: ".$v1[2]; else:
                            $arr[] = $v;
                        endif;
                    }
                }
                $arr = array_filter($arr);
                $data = $arr[array_rand($arr)];
                DB::update('update casewins set data = ? where id = ?', [$data, $id]);
                return [ 'result' => $data ];
            } elseif ($res->resUrl == 'mc') {
                // get account
                $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/app/storage/userdata/mc.dat');
                $file = explode("\n", $file);
                $arr = [];
                foreach ($file as $i => $v) {
                    if ($v != '' && $v != "\n") {
                        $arr[] = $v;
                    }
                }
                $arr = array_filter($arr);
                $data = $arr[array_rand($arr)];
                DB::update('update casewins set data = ? where id = ?', [$data, $id]);
                return [ 'result' => $data ];
            } elseif ($res->resUrl == 'mvp') {
                // get account
                $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/app/storage/userdata/mvp.dat');
                $file = explode("\n", $file);
                $arr = [];
                foreach ($file as $i => $v) {
                    if ($v != '' && $v != "\n") {
                        $v1 = explode(' ', $v);
                        if (isset($v1[1]) && isset($v1[2])):
                            $arr[] = 'Ник: '.$v1[0]."<br>Почта: ".$v1[1]."<br>Пароль: ".$v1[2]; else:
                            $arr[] = $v;
                        endif;
                    }
                }
                $arr = array_filter($arr);
                $data = $arr[array_rand($arr)];
                DB::update('update casewins set data = ? where id = ?', [$data, $id]);
                return [ 'result' => $data ];
            } elseif ($res->resUrl == 'mcfull') {
                // get account
                $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/app/storage/userdata/mcfull.dat');
                $file = explode("\n", $file);
                $arr = [];
                foreach ($file as $i => $v) {
                    if ($v != '' && $v != "\n") {
                        $arr[] = $v;
                    }
                }
                $arr = array_filter($arr);
                $data = $arr[array_rand($arr)];
                DB::update('update casewins set data = ? where id = ?', [$data, $id]);
                return [ 'result' => $data ];
            } elseif ($res->resUrl == 'mcrand') {
                // get account
                $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/app/storage/userdata/mcrand.dat');
                $file = explode("\n", $file);
                $arr = [];
                foreach ($file as $i => $v) {
                    if ($v != '' && $v != "\n") {
                        $arr[] = $v;
                    }
                }
                $arr = array_filter($arr);
                $data = $arr[array_rand($arr)];
                DB::update('update casewins set data = ? where id = ?', [$data, $id]);
                return [ 'result' => $data ];
            }
        }
    }
});

Route::post('caseAvailable/{id}', function ($id) {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    $db = DB::table('users')->where('token', $user)->first();
    if (checkFaking($db) == true) {
        die(json_encode(['error' => '<b>Система проверки:</b> Открытие было отменено, т.к. мы обнаружили злоупотребление шансом.<br>Вы пополняли счёт менее двух раз, и при этом у вас на балансе больше 10.000 рублей.']));   
    }
    $db2 = DB::table('buyedcases')->where(['uid' => $db->id, 'cid' => $id])->first();
    $case = DB::table('cases')->where('id', $id)->first();
    DB::disconnect();
    if (isset($case->id)) {
        if ($case->amount == 0) {
            $avail = json_decode(Cache::get($db->id.'_'.$case->id.'_free_avail'));
            if (isset($avail->time)) {
                if (date('H', time()-$avail->time) >= 24) {
                    Cache::put($db->id.'_'.$case->id.'_free_avail', false, -5);
                }
            } else {
                $avail = 'no';
            }
        } else {
            $avail = 'no';
        }
    if (isset($db2->id) && $avail == 'no') {
        return json_encode(['available' => true]);
    } else if (isset($db2->id) && $avail != 'no' && $avail->res == true) {
        return json_encode(['available' => true]);
    } else if (isset($db2->id) && $avail != 'no' && $avail->res == false) {
        return json_encode(['available' => false]);
    } else {
        return json_encode(['available' => true]);
    }
    }
});

Route::post('caseBuyed/{id}', function ($id) {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    $db = DB::table('users')->where('token', $user)->first();
    $query = DB::table('buyedcases')->where(['uid' => $db->id, 'cid' => $id])->get();
    $num = count($query);
    DB::disconnect();
    if (isset($query[0])){
        return json_encode(['buyed' => true, 'num' => $num]);
    } else {
        return json_encode(['buyed' => false]);
    }
});

Route::post('buyCase/{id}', function ($id) {
    function declOfNum($number, $titles)
    {
        $cases = array (2, 0, 1, 1, 1, 2);
        $format = $titles[ ($number%100 > 4 && $number %100 < 20) ? 2 : $cases[min($number%10, 5)] ];
        return sprintf($format, $number);
    }

    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
    $num = (int)json_decode(file_get_contents('php://input'))->num;
    $db = DB::table('users')->where('token', $user)->first();
    $case = DB::table('cases')->where('id', $id)->first();
    $amount = $case->amount*$num;
    if ($db->balance < $amount) {
        DB::disconnect();
        return json_encode(['error' => 'Недостаточно средств на балансе!']);
    } else if ($num > 50) {
        DB::disconnect();
        return json_encode(['error' => 'Оу, я смотрю вы мажор.. но, к сожалению, максимальное количество кейсов для покупки - 50 штук. :\\']);
    } else if ($num < 1) {
        DB::disconnect();
        return json_encode(['error' => 'Кейс может быть целым, он не 0, и не -1, и не 0.1, и даже не 0.2, представляешь? :)']);
    } else {
        $nnn = 0;
        while ($nnn < $num) {
            $nnn++;
            DB::insert('insert into buyedcases (uid, cid) values (?, ?)', [$db->id, $id]);
        }
        DB::update('update users set balance = ? where id = ?', [$db->balance-$amount, $db->id]);
        DB::disconnect();
        return json_encode(['bal' => $db->balance-$amount, 'message' => 'Вы успешно купили '.declOfNum($nnn, ['%d кейс', '%d кейса', '%d кейсов'])]);
    }
});

Route::post('getstat', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }
        $db = DB::table('users')->where('token', $user)->first();
        $lastOpen = DB::table('lastwins')->where('uid', $db->id)->get();
        $lastOpen = count($lastOpen);
        $reg = date_diff(new DateTime(), new DateTime($db->regdate))->days;
        return json_encode(['open' => $lastOpen, 'reg' => $reg]);
});

Route::get('getstat', function () {
    session_save_path($_SERVER['DOCUMENT_ROOT']."/app/sessions");
    session_start();
    define("MAX_IDLE_TIME", 3);
        if ($directory_handle = opendir(session_save_path())) {
            $count = 0;
            while (false !== ($file = readdir($directory_handle))) {
                if ($file != '.' && $file != '..') {
                    if (time()- filemtime(session_save_path() . '' . $file) < MAX_IDLE_TIME * 60) {
                        $count++;
                    }
                }
                closedir($directory_handle);
                return $count;
            }
            } else { 
                return false; 
            }
});

Route::get('stat/addtostat', function () {
    $ip = new Basic();
    $ip = $ip->getIP();
    $stat = Redis::get('onlineStat');
    if ($stat) {
        $stat = json_decode($stat, true);
        foreach ($stat as $index) {
            die($index);
        }
        if (in_array($ip, $stat)) {
            echo 0;
        } else {
            array_push($stat, [ 'ip' => $ip, 'time' => time() ]);
            $stat2 = json_encode($stat);
            Redis::set('onlineStat', $stat2);
            echo 1;
        }
    } else {
        $stat1 = [];
        array_push($stat1, [ 'ip' => $ip, 'time' => time() ]);
        Redis::set('onlineStat', json_encode($stat1));
        echo 2;
    }
});

Route::post('otherCases/{id}', function ($id) {
    if ($id) {
        $db = DB::table('cases')->orderByRaw("RAND()")->where('id', '!=', $id)->limit(3)->get();
        return $db;
    }
});

Route::post('mine/getRandom', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }

    $userData = DB::table('users')->where('token', $user)->first();
    $caseItems = DB::table('caseitems')->select('id', 'cid', 'title', 'img', 'chance', 'amount')->whereNotIn('amount', function($q){
        $q->select('amount')->from('caseitems')->where('amount', 0);
    })->get()->toArray(); // Получаем экземлпяр всех вещей из кейса

    if (isset($userData->id)) {
        //array_push($caseItems, (object)[ 'amount' => 0, 'chance' => 200, 'cid' => 0, 'id' => 0, 'img' => 0, 'title' => null ]);
        
        $item = $caseItems[array_rand($caseItems)];
        Cache::put($userData->id.'_mine_lastItem', json_encode([ 'cid' => $item->cid, 'item' => $item->id ]));
        $two = (object)[ 'amount' => 0, 'chance' => 200, 'cid' => 0, 'id' => 0, 'img' => 0, 'title' => null ];
        $itemMassive = [$item, $item, $item, $two, $two, $two];
        shuffle($itemMassive);

        return base64_encode(json_encode($itemMassive));
    }
});

Route::post('mine/acceptItem', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }

    $userData = DB::table('users')->where('token', $user)->first();
    if (isset($userData->id)) {
        $last = json_decode(Cache::get($userData->id.'_mine_lastItem'));
        if ($last != NULL && isset($last->cid)) {
            DB::insert('insert into casewins (uid, cid, itemid) values (?, ?, ?)', [$userData->id, $last->cid, $last->item]);
            Cache::forget($userData->id.'_mine_lastItem');
            return ['result' => 'ok'];
        }
    }
});

Route::post('mine/buy', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }

    $userData = DB::table('users')->where('token', $user)->first();
    if ($userData->balance >= 50) {
        DB::update('update users set balance = ? where token = ?', [$userData->balance-50, $user]);
        Cache::put($userData->id.'_mine_available', true);
        return json_encode(['result' => 1, 'bal' => $userData->balance-50]);
    } else {
        return json_encode(['result' => 0]);
    }
});

Route::post('mine/getBuy', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null || $_SERVER['HTTP_X_TOKEN'] == 'undefined') {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }

    $userData = DB::table('users')->where('token', $user)->first();
    $r = Cache::get($userData->id.'_mine_available');
    if ($r == null)
        $r = false;
    return json_encode(['result' => $r]);
});

Route::post('mine/bomb', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null) {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }

    $userData = DB::table('users')->where('token', $user)->first();
    if (Cache::get($userData->id.'_mine_available') == true):
        Cache::put($userData->id.'_mine_available', false);
        return json_encode(['result' => true]);
    endif;
});

Route::post('mine/sold', function () {
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null) {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }

    $userData = DB::table('users')->where('token', $user)->first();
    if (Cache::get($userData->id.'_mine_available') == true):
            $last = json_decode(Cache::get($userData->id.'_mine_lastItem'));
            if ($last != null && isset($last->cid)) {
                $item = DB::table('caseitems')->where('id', $last->item)->where('cid', $last->cid)->first();
                if (isset($item->id)) {
                    Cache::put($userData->id.'_mine_available', false);
                    DB::update('update users set balance = ? where id = ?', [$userData->balance+$item->amount, $userData->id]);
                    return json_encode(['result' => 'ok', 'bal' => $userData->balance+$item->amount]);
                } else {
                    return['error' => '2'];
                }
            } else {
                return ['error' => '1'];
            }
        else:
            return ['error' => '0'];
        endif;
});

Route::post('payments/create', function () {
    $am = (int)$_POST['sum'];
    $promocode = trim($_POST['promocode']);
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null) {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }

    $userData = DB::table('users')->where('token', $user)->first();
    
    if ($promocode != '') {
        $promo = DB::table('promocodes')->where('code', $promocode)->first();
        $promotwo = DB::table('activatedPromocodes')->where('codeid', $promo->id)->where('uid', $userData->id)->first();
        $datetime1 = new DateTime("now");
        $datetime2 = new DateTime($promo->expire);
        $interval = $datetime1->diff($datetime2);
        if ($promo->active == 1 && $interval->format('%R%S') > 0 && !isset($promotwo->id)) {
            $am2 = $am;
            $am = $am-$promo->amount;
            $prom = ' с промокодом '.$promocode;
            DB::insert('insert into activatedPromocodes (codeid, uid) values (?, ?)', [$promo->id, $userData->id]);
        } else {
            return json_encode(['errorText' => 'Ошибка промокода']);
        }
    } else {
        $am2 = $am;
        $prom = '';
    }

    $cur = 'RUB';
    $dataSet = [
        'ik_co_id' => 'CO_ID',
        'ik_pm_no' => md5($userData->token.$userData->id.random_bytes(16)),
        'ik_am' => $am,
        'ik_cur' => $cur,
        'ik_desc' => 'Пополнение счета'.$prom,
        'ik_exp' => date('Y-m-d', strtotime('+1 day')),
        'ik_x_token' => base64_encode($userData->token),
        'ik_x_sum' => base64_encode($am2),
        'ik_x_promocode' => $promocode
    ];

    $key = "СЕКРЕТНЫЙ КЛЮЧ"; //В данном случае используется "Секретный ключ"
    ksort($dataSet, SORT_STRING); // сортируем по ключам в алфавитном порядке элементы массива
    array_push($dataSet, $key); // добавляем в конец массива "секретный ключ"
    $signString = implode(':', $dataSet); // конкатенируем значения через символ ":"
    $sign = base64_encode(md5($signString, true));
    $dataSet['ik_sign'] = $sign;
    //unset($dataSet['0']);

    
    return json_encode(['promocode' => $promocode, 'paymentUrl' => 'https://sci.interkassa.com/?'.http_build_query($dataSet)]);
});

Route::post('payment/callback', function () {
    $amount = $_POST['ik_am'];
    $token = base64_decode($_POST['ik_x_token']);
    $sign = $_POST['ik_sign'];
    $sum = base64_decode($_POST['ik_x_sum']);
    $key = "СЕКРЕТНЫЙ КЛЮЧ";
    $promocode = $_POST['ik_x_promocode'];
    $dataSet = [
        'ik_co_id' => $_POST['ik_co_id'],
        'ik_pm_no' => $_POST['ik_pm_no'],
        'ik_am' => $amount,
        'ik_cur' => $_POST['ik_cur'],
        'ik_desc' => 'Пополнение счета',
        'ik_exp' => date('Y-m-d', strtotime('+1 day')),
        'ik_x_token' => base64_encode($token),
        'ik_x_sum' => $_POST['ik_x_sum'],
        'ik_sign' => $_POST['ik_sign'],
        'ik_x_promocode' => $promocode
    ];
    unset($dataSet['ik_sign']);
    ksort($dataSet, SORT_STRING); // сортируем по ключам в алфавитном порядке элементы массива
    array_push($dataSet, $key); // добавляем в конец массива "секретный ключ"
    $signString = implode(':', $dataSet); // конкатенируем значения через символ ":"
    $sign = base64_encode(md5($signString, true));
    $dataSet['ik_sign'] = $sign;
    if ($amount && $token && $sum) {
            if ($sign == $dataSet['ik_sign']) {
                $user = DB::table('users')->where('token', $token)->first();
                if (isset($user->id)) {
                
                    // ДЛЯ АКЦИИ
                    if ($sum >= 100) {
                        $summa = $user->balance+$sum+50;
                        $xsum = base64_decode($_POST['ik_x_sum'])+50;
                    } else {
                        $summa = $user->balance+$sum;
                        $xsum = base64_decode($_POST['ik_x_sum']);
                    }

                    if (DB::insert('insert into payments (amount, payAmount, uid) values (?, ?, ?)', [$xsum, $amount, $user->id])
                        && DB::update('update users set balance = ? where token = ?', [$summa, $token])) {
                        die('success');
                    } else {
                        die('error');
                    }
                } else {
                    die('uid not found');
                }
            } else {
                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/payment.txt', 'sign error: '.$sign.' != '.$dataSet['ik_sign'], FILE_APPEND);
                die('sign error');
            }
    } else {
        die('act error');
    }
});

Route::post('payments/checkPromocode', function () {
    if (!isset($_POST['promocode']) || !isset($_POST['amount'])) return;
    if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null) {
        die(json_encode(['error' => 'Token error!']));
    } else {
        $user = $_SERVER['HTTP_X_TOKEN'];
    }

    $userData = DB::table('users')->where('token', $user)->first();


    $promocode = trim($_POST['promocode']);
    $amount = (int)$_POST['amount'];
    if ($promocode != '') {
        $res = DB::table('promocodes')->where('code', $promocode)->first();
        if (isset($res->id)) {
            $promotwo = DB::table('activatedPromocodes')->where('codeid', $res->id)->where('uid', $userData->id)->first();
            $datetime1 = new DateTime("now");
            $datetime2 = new DateTime($res->expire);
            $interval = $datetime1->diff($datetime2);
            if ($res->active == 1 && $interval->format('%R%S') > 0 && !isset($promotwo->id)) {
                if ($res->amount >= $amount) {
                    return json_encode(['result' => 0, 'errorText' => 'Сумма скидки превышает сумму платежа.']);
                } else {
                    return json_encode(['result' => 1]);
                }
            } else {
                return json_encode(['result' => 0, 'errorText' => 'Промокод недоступен']);
            }
        } else {
            return json_encode(['result' => 0, 'errorText' => 'Промокод не существует']);
        }
    }
});

Route::post('getLastWins', function () {
   return $arr;
});

Route::post('analytic', function () {
    $wins = DB::table('lastwins')->orderBy('date', 'desc')->limit(8)->get();
    $arr = [];
    foreach($wins as $item) {
        $u = DB::table('users')->where('id', $item->uid)->first();
        $item = DB::table('caseitems')->where('id', $item->win)->where('cid', $item->cid)->first();
        $arr[] = [ 'user' => $u->fname, 'img' => $item->img, 'name' => $item->title ];
    }
    $opened = count(DB::table('lastwins')->get());
    $users = count(DB::table('users')->get());
    
    if (Cache::get('onlineList') == NULL) {
        Cache::put('onlineList', json_encode([getIp()]), 120);
    }
    $onl = json_decode(Cache::get('onlineList'), false);
    $top = DB::table('users')->select('id', 'fname', 'balance', 'lname')->where('id', '<>', '2')->where('id', '<>', '3')->orderBy('balance', 'desc')->limit(3)->get();
    return [ 'opened' => $opened, 'online' => count($onl), 'last' => $arr, 'users' => $users, 'topusers' => $top ];
});

Route::get('r/notify', 'Notify@get');