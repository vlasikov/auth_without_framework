<?php
class Home extends Controller
{
    private $pathSite;
    /**
     * Конструктор
     */
    public function __construct()
    {
        session_start();
        // получить корень сайта
        $this->pathSite = $_SERVER['DOCUMENT_ROOT'];
    }

    /**
     * Контроллер главной страницы
     */
    public function index()
    {
        if (isset($_SESSION["name"])){
            $this->view('home/index', ['file' => 'profile.php']);
        }else{
            $this->view('home/index');
        }
    }

    /**
     * Контроллер языка интерфейса
     */
    public function lang()
    {
        if ($_POST['lang'] == "ru"){
            $_SESSION["lang"] = "ru";
        }else{
            unset($_SESSION["lang"]);
        }
        echo true;
    }

    /**
     * Контроллер страницы регистрации
     */
    public function register()
    {
        $fileName = time();
        $fileNameFull = '';
        $noErr = true;
        $errors = [];
        $user = $this->model('User');
        if (isset($_POST['password'])) {
            if ($_POST['password'] != $_POST['password_confirmation']) {
                $errors['password'] = 'The password confirmation does not match.';
                $noErr = false;
            }
            if ($user->count('username', $_POST['name'])) {
                $errors['name'] = 'Name busy.';
                $noErr = false;
            }
            if ($user->count('email', $_POST['email'])) {
                $errors['email'] = 'Email busy.';
                $noErr = false;
            }
            $res = $this->loadFile($fileName);
            if (!($res['errors'] == '')) {
                $errors['file'] = $res['errors'];
                $noErr = false;
            }
            $fileNameFull = $res['fileName'];
        } else {
            $noErr = false;
        }

        if ($noErr) {
            $res = $user->add($_POST, $fileNameFull);
            $this->auth($user);
            // $this->view('home/index', ['file' => 'register.php', 'errors' => $errors, 'old' => $_POST]);
        } else {
            $this->view('home/index', ['file' => 'register.php', 'errors' => $errors, 'old' => $_POST]);
        }
    }

    /**
     * Загрузка файла с изображением
     * @return array
     */
    private function loadFile($fileName)
    {
        $result = ['fileName'=>'', 'errors'=>''];
        //Получаем последний компонеет имени загруженного файла
        $name_of_uploaded_file = basename($_FILES['uploaded_file']['name']);
        // например, index.php

        //получаем расширение файла (без точки)
        $type_of_uploaded_file = substr($name_of_uploaded_file,
            // позиция вхождения точки + 1
            strrpos($name_of_uploaded_file, '.') + 1);
        $size_of_uploaded_file = $_FILES["uploaded_file"]["size"] / 1024;
        //размер в KBs

        //Настройки
        $max_allowed_file_size = 100; // размер в  KB
        $allowed_extensions = array("jpg", "jpeg", "gif", "bmp");
        //Проверки
        if ($size_of_uploaded_file > $max_allowed_file_size) {
            $result['errors'] .= "\n Размер файла должен быть меньше $max_allowed_file_size kB";
            return $result;
        }
        //------ Проверяем расширение файла -----
        $allowed_ext = false;
        for ($i = 0; $i < sizeof($allowed_extensions); $i++) {
            // сравниваем строки, если = 0, то строки идентичны (без учета регистра)
            if (strcasecmp($allowed_extensions[$i], $type_of_uploaded_file) == 0) {
                $allowed_ext = true;
            }
        }
        if (!$allowed_ext) {
            $result['errors'] .= "\n Расширение файла не соответствует требуемому. " .
            "Поддерживаются следующие расширения: " . implode(',', $allowed_extensions);
            return $result;
        }

        $upload_folder = $this->pathSite."/public/images/";
        //копируем  временный файл в папку  uploads
        $fileNameFull = $fileName . "." . $type_of_uploaded_file;
        $result['fileName'] = $fileNameFull;
        $path_of_uploaded_file = $upload_folder . $fileNameFull;
        $tmp_path = $_FILES["uploaded_file"]["tmp_name"];

        // был ли загружен файл при помощи HTTP POST
        if (is_uploaded_file($tmp_path)) {
            // получить корень сайта
            // если файл не скопирован, создаем ошибку
            if (!copy($tmp_path, $path_of_uploaded_file)) {
                $result['errors'] .= '\n error while copying the uploaded file';
                return $result;
            }
        }

        return $result;
    }

    /**
     * Контроллер для страницы login
     */
    public function login()
    {
        $errors = '';
        $user = $this->model('User');
        if (isset($_POST['email'])) {
            // если почта есть в базе
            if ($user->count('email', $_POST['email'])) {
                if ($user->count('psw', md5($_POST['password']))) {
                    // пароль совпал
                    $this->auth($user);
                    return;
                } else {
                    $errors = 'incorrect password';
                }
            } else {
                $errors = 'incorrect email';
            }
        }

        $this->view('home/index', ['file' => 'login.php', 'errors' => $errors]);
    }

    /**
     * авторизация пользователя
     */
    private function auth($user){
        //Записываем в сессию логин пользователя
        $u = $user->find($_POST['email']);
        $_SESSION["name"] = $u['username'];
        $_SESSION["email"] = $u['email'];
        $_SESSION["file"] = $u['file'];
        $_SESSION["timestamp"] = $u['timestamp'];

        // $this->view('home/index');
        $this->index();
    }

    /**
     * Выход из авторизации
     */
    public function logout()
    {
        session_unset();
        session_destroy();
        $this->index();
    }
}
